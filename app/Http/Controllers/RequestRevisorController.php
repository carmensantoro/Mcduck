<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestRevisorController extends Controller
{
    
    
    public function contactSave(Request $request){
        $request_revisor = Auth::user();
       

        //$contact->save();

        //$contact = compact('name', 'surname', 'description', 'mail');

        Mail::to('caronte@averno.com')->send(new RevisorRequest($request_revisor));

        return redirect()->back();
    }
}
