<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

class RevisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.revisor');
    }

    public function index()
    {
       $ad = Ad::where('is_accepted', null)
       ->orderBy('created_at', 'desc')
       ->first();
       return view('revisor.index', compact('ad'));
    }

    private function setAccepted($ad_id, $value) {
        $ad = Ad::find($ad_id);
        $ad->is_accepted = $value;
        $ad->save();
        return redirect(route('revisor.index'));
    }

    public function accept($ad_id) {
        return $this->setAccepted($ad_id, true);
    }

    public function reject($ad_id) {
        return $this->setAccepted($ad_id, false);
    }
}
