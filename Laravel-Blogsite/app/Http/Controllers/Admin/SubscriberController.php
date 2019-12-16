<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    //
    public function index(){
        $subscriberList = Subscriber::latest()->get();

        return view('admin.subscriber',compact('subscriberList'));
    }

    public function destroy($id){
        $subscriberList = Subscriber::findOrFail($id);
        $subscriberList->delete();

        Toastr::success('Subscriber Deleted !','success');
        return redirect()->back();
    }

}
