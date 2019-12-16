<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    //store subscriber
    public function store(Request $request){

        $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);

        $subs = new Subscriber();
        $subs->email = $request->email;
        $subs->save();

        Toastr::success('Successfully added to subscribe list ','success');
        return back();
    }
}
