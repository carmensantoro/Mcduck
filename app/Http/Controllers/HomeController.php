<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $ads = Ad::where('is_accepted', true)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        
        //Per fare la visualizzazione dei preferiti        
        $favorite=collect([]);       
        if ($user) {
            $favorite = $user->favorites->pluck('pivot');
        }

        return view('welcome', compact('ads', 'favorite'));
    } 

    public function saveFavorites($id){
       
        $user = Auth::user();

        if ($user) {
            $user->favorites()->toggle($id);
            //return response()->json('bravo');
        } else {
            return response()->json('devi essere registrato');
        }

    }

    public function locale($locale){
        session()->put('locale', $locale);
        return redirect()->back();
    }
    
}
