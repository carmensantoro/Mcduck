<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\RevisorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

class RequestRevisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function formRequest(){
        $user = Auth::user();
        return view('revisor.request', compact('user'));
    }

    
    public function request(Request $request){
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $motivation = $request->input('motivation_revisor');
        $request_revisor = compact('name', 'email', 'motivation');
       

        Mail::to('caronte@averno.com')->send(new RevisorRequest($request_revisor));

        return redirect('/');
    }

    public function confirmRevisor($email){
        Artisan::call('presto:makeUserRevisor', ['email' => $email]);
        $user = User::where('email', $email)->first();
        if (!$user) {
            $confirm = 'Utente non trovato';
            return view('revisor.confirm', compact('confirm'));
        } else {
            $confirm = "L'utente {$user->name} è ora revisore";
            return view('revisor.confirm', compact('confirm'));
        }

    }
}
