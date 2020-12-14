<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdImage;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAd;
use App\Jobs\ResizeImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'search']);
    }

    
    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index($category)
    {
        
        $category = Category::find($category);
        // $category = DB::table('categories')->where('name', $category)->get();
        // $categoryid = DB::table('categories')->where('id', $category)->get();
        
        if ($category != null) {
            $ads = $category->ads()
                    ->orderBy('created_at', 'desc')
                    ->where('is_accepted', true)
                    ->paginate(10);
        }
        else {
            $ads=Ad::orderBy('created_at', 'desc')->where('is_accepted', true)->paginate(10);
        }
        
        return view('ads.index', compact('ads'));
    }

    public function search(Request $request) {
        $q = $request->input('q');
        $sortby = $request->input('sortby');
        if ($sortby) {
            switch ($sortby) {
                case '1':
                    $ads = Ad::search($q)->get();
                    $ads = $ads->sortByDesc('id');
                break;
                case '2':
                    $ads = Ad::search($q)->get();
                    $ads = $ads->sortBy('id');
                break;  
                case '3':
                    $ads = Ad::search($q)->get();
                    $ads = $ads->sortByDesc('price');
                break; 
                case '4':
                    $ads = Ad::search($q)->get();
                    $ads = $ads->sortBy('price');
                break; 
            }
            
        }
        else {
            $ads = Ad::search($q)->get();
            $ads = $ads->sortByDesc('id');
        }

        return view ('ads.search', compact('q', 'ads', 'sortby'));
    }


    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {

        $uniqueSecret = $request-> old('uniqueSecret', base_convert(sha1(uniqid(mt_rand())), 16, 36));
        return view('ads.create', compact('uniqueSecret'));

    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(StoreAd $request)
    {
        $user=Auth::user();
        $a = $user->ads()->create(
            [
                'title'=>$request->title,
                'body'=>$request->body,
                'price'=>$request->price,
                'category_id'=>$request->category_id
                ]
            );
            
            //o si usa la forma qui sopra o questa di sotto, non cambia nulla
            //$user->ads()->create($request->validated());
            $uniqueSecret = $request->input('uniqueSecret');
            
            $images = session()->get("images.{$uniqueSecret}", []);
            $removedImages = session()->get("removedimages.{$uniqueSecret}", []);
            
            $images = array_diff($images, $removedImages);

            foreach ($images as $image) {
                $i = new AdImage();

                $fileName = basename($image);
                $newFileName = "public/ad/{$a->id}/{$fileName}";
                Storage::move($image, $newFileName);

                dispatch(new ResizeImage(
                    $newFileName,
                    400,
                    300
                ));

                $i->file = $newFileName;
                $i->ad_id = $a->id;

                $i->save();
            }

            File::deleteDirectory(storage_path("app/public/temp/{$uniqueSecret}"));

            return redirect()->back()->with('message', 'Bene, il tuo annuncio è stato inserito');
            
        }
        
        public function uploadImage(Request $request){

            $uniqueSecret = $request->input('uniqueSecret');

            $fileName = $request->file('file')->store("public/temp/{$uniqueSecret}");

            dispatch(new ResizeImage(
                $fileName,
                120,
                120
            ));

            session()->push("images.{$uniqueSecret}", $fileName);

            

            return response()->json(['id'=>$fileName]);
        }
    

        public function removeImage(Request $request) {
            $uniqueSecret = $request->input('uniqueSecret');

            $fileName = $request->input('id');

            session()->push("removedimages.{$uniqueSecret}", $fileName);

            Storage::delete($fileName);

            return response()->json('ok');
        }

        public function getImages(Request $request) {

            $uniqueSecret = $request->input('uniqueSecret');

            $images = session()->get("images.{$uniqueSecret}", []);
            $removedImages = session()->get("removedimages.{$uniqueSecret}", []);
            
            $images = array_diff($images, $removedImages);

            $data = [];

            foreach ($images as $image) {
                $data[] = [
                    'id' => $image,
                    'src' => AdImage::getUrlByFilePath($image, 120, 120)
                ];
            }

            return response()->json($data);

        }

        /**
        * Display the specified resource.
        *
        * @param  \App\Models\Ad  $ad
        * @return \Illuminate\Http\Response
        */
        public function show(Ad $ad)
        {
            return view('ads.show', compact('ad'));
        }
        
        /**
        * Show the form for editing the specified resource.
        *
        * @param  \App\Models\Ad  $ad
        * @return \Illuminate\Http\Response
        */
        public function edit(Ad $ad)
        {
            //
        }
        
        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \App\Models\Ad  $ad
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, Ad $ad)
        {
            //
        }
        
        /**
        * Remove the specified resource from storage.
        *
        * @param  \App\Models\Ad  $ad
        * @return \Illuminate\Http\Response
        */
        public function destroy(Ad $ad)
        {
            //
        }
    }
    