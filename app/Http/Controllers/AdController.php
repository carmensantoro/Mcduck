<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdImage;
use App\Models\Category;
use App\Jobs\ResizeImage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAd;
use Illuminate\Support\Facades\DB;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionRemoveFaces;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Jobs\GoogleVisionSafeSearchImage;

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
    public function index($category, Request $request)
    {
        $categoryid = $category;
        $categories = Category::find($category);
        // $category = DB::table('categories')->where('name', $category)->get();
        // $categoryid = DB::table('categories')->where('id', $category)->get();
       
        $sortby = $request->input('sortby');


        if ($categories != null) {        
            if ($sortby) {
                switch ($sortby) {
                    case '1':
                        $ads = $categories->ads()->orderBy('created_at', 'desc')->where('is_accepted', true)->paginate(10);
                        break;
                    case '2':
                        $ads = $categories->ads()->orderBy('created_at', 'asc')->where('is_accepted', true)->paginate(10);
                        break;  
                    case '3':
                        $ads = $categories->ads()->orderBy('price', 'desc')->where('is_accepted', true)->paginate(10);
                        break; 
                    case '4':
                        $ads = $categories->ads()->orderBy('price', 'asc')->where('is_accepted', true)->paginate(10);
                        break; 
                        }
                    }
                    else {
                        $ads = Ad::orderBy('created_at', 'desc')->where('is_accepted', true)->paginate(10);
                    }
        }
        else {
            if ($sortby) {
                switch ($sortby) {
                    case '1':
                        $ads = Ad::orderBy('created_at', 'desc')->where('is_accepted', true)->paginate(10);
                        break;
                    case '2':
                        $ads = Ad::orderBy('created_at', 'asc')->where('is_accepted', true)->paginate(10);
                        break;  
                    case '3':
                        $ads = Ad::orderBy('price', 'desc')->where('is_accepted', true)->paginate(10);
                        break; 
                    case '4':
                        $ads = Ad::orderBy('price', 'asc')->where('is_accepted', true)->paginate(10);
                        break; 
                        }
                    }
                    else {
                        $ads = Ad::orderBy('created_at', 'desc')->where('is_accepted', true)->paginate(10);
                    }
            }

        

        $adscount  =$ads->count();
        
        $user = Auth::user();
        $favorite=collect([]);       
        if ($user) {
            $favorite = $user->favorites->pluck('pivot');
        }
        
        
        return view('ads.index', compact('ads', 'sortby', 'categoryid', 'adscount', 'favorite'));
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

    public function personalAds(){
        $user = Auth::user();

            $ads = $user->ads->where('is_accepted', true)->all();

        return view('ads.personal', compact('ads'));
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


                $i->file = $newFileName;
                $i->ad_id = $a->id;

                $i->save();


                GoogleVisionSafeSearchImage::withChain([
                new GoogleVisionLabelImage($i->id),
                new GoogleVisionRemoveFaces($i->id),
                new ResizeImage($i->file, 300, 150),
                new ResizeImage($i->file, 400, 300)
                ])->dispatch($i->id);
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
        public function edit(Request $request, Ad $ad)
        {
            $uniqueSecret = $request-> old('uniqueSecret', base_convert(sha1(uniqid(mt_rand())), 16, 36));
            return view('ads.edit', compact('uniqueSecret', 'ad'));
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
            $user=Auth::user();
            $a = $ad->update(
                [
                    'title'=>$request->title,
                    'body'=>$request->body,
                    'price'=>$request->price,
                    'category_id'=>$request->category_id
                    ]
                );
                

                $uniqueSecret = $request->input('uniqueSecret');
                
                $images = session()->get("images.{$uniqueSecret}", []);
                $removedImages = session()->get("removedimages.{$uniqueSecret}", []);
                
                $images = array_diff($images, $removedImages);
    
                foreach ($images as $image) {
                    $i = new AdImage();
    
                    $fileName = basename($image);
                    $newFileName = "public/ad/{$ad->id}/{$fileName}";
                    Storage::move($image, $newFileName);
    
    
                    $i->file = $newFileName;
                    $i->ad_id = $ad->id;
    
                    $i->save();
    
    
                    GoogleVisionSafeSearchImage::withChain([
                    new GoogleVisionLabelImage($i->id),
                    new GoogleVisionRemoveFaces($i->id),
                    new ResizeImage($i->file, 300, 150),
                    new ResizeImage($i->file, 400, 300)
                    ])->dispatch($i->id);
                }
    
                File::deleteDirectory(storage_path("app/public/temp/{$uniqueSecret}"));
    
                return redirect(route('ads.show', compact('ad')))->with('message', 'Bene, il tuo annuncio è stato inserito');
        }
        
        /**
        * Remove the specified resource from storage.
        *
        * @param  \App\Models\Ad  $ad
        * @return \Illuminate\Http\Response
        */
        public function deleteImage(AdImage $image)
        {

            $image->delete();
            return response()->json("$image");
            //return redirect()->back();
        }

        public function destroy(Ad $ad)
        {
 
            $ad->images()->delete();
            $ad->users()->detach();
            $ad->delete();
            
            return redirect(route('ads.personal'));
        }
    }
    