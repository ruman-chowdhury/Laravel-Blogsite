<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function showIndex(){
        $allData = Post::latest()->get();

        return view('admin.post.postIndex',compact('allData'));
    }

    public function create(){
        return view('admin.post.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|regex:/(^([a-zA-Z ]+)(\d+)?$)/u', //space after A-Z,it allows space
            'category' => 'required',
            'details' => 'required',

        ]);

        if ($request->hasFile('image')){

            $img = uniqid().'.jpg';
            $request->image->move('user/backend/photos',$img);

            $pos = new Post();
            $pos->title = $request->title;
            $pos->category = $request->category;
            $pos->image = $img;
            $pos->details = $request->details;
            $pos->user_id = Auth::user()->id;
            $pos->save();


        }else{

            $pos = new Post();
            $pos->title = $request->title;
            $pos->category = $request->category;
            $pos->details = $request->details;
            $pos->user_id = Auth::user()->id;
            $pos->save();
        }

        return redirect()->route('admin.post');

    }
}
