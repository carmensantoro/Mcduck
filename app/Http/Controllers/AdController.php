<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAd;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
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
            $ads = $category->ads()->get();
        }
        else {
            $ads=Ad::all()->sortDesc();
        }
        
        return view('ads.index', compact('ads'));
    }

    public function search(Request $request) {
        $q = $request->input('q');
        $ads = Ad::search($q)->get();
        dd($ads);
        return view ('search_result', compact('q', 'ads'));
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('ads.create');
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
        $user->ads()->create(
            [
                'title'=>$request->title,
                'body'=>$request->body,
                'price'=>$request->price,
                'category_id'=>$request->category
                ]
            );
            
            return redirect()->back()->with('message', 'bene il tuo annuncio è stato inserito');
            
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
    