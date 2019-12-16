<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    //=============read===============
    public function showIndex(){
        $allData = Auth::user()->posts()->latest()->get();

        return view('author.post.postIndex',compact('allData'));
    }

//=================create,store=================
    public function create(){
        return view('author.post.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required', //space after A-Z,it allows space
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
            $pos->details = strip_tags($request->details) ; //remove tag like p,h1

            if (isset($request->status)){
                $pos->status = true; //if data is submitted then status is true
            }else{
                $pos->status = false;
            }
            $pos->is_approved = false; //it is author,so initially false

            $pos->user_id = Auth::user()->id; //insert user_id
            $pos->save();


        }else{

            $pos = new Post();
            $pos->title = $request->title;
            $pos->category = $request->category;
            $pos->details = strip_tags($request->details);

            if (isset($request->status)){
                $pos->status = true; //if data is submitted then status is true
            }else{
                $pos->status = false;
            }
            $pos->is_approved = false; //it is author,so initially false

            $pos->user_id = Auth::user()->id;
            $pos->save();
        }

        return redirect()->route('author.post');

    }

//========================edit,update=======================
    public function edit($id){
        $singleData = Post::find($id);

        if ($singleData->user_id != Auth::id()){

            return redirect()->back();
        }

        return view('author.post.edit',compact('singleData'));

    }


    public function update(Request $request,$id){

        //check this post belongs to authenticated user or not
        $pos = Post::find($id);
        if ($pos->user_id != Auth::id()){

            return redirect()->back();
        }

        $request->validate([
            'title' => 'required', //space after A-Z,it allows space
            'category' => 'required',
            'details' => 'required',

        ]);

        if ($request->hasFile('image')){
            $img = uniqid().'.jpg';
            $request->image->move('user/backend/photos',$img);

            $pos = Post::find($id);
            $pos->title = $request->title;
            $pos->category = $request->category;
            $pos->image = $img;
            $pos->details = strip_tags($request->details) ; //remove tag like p,h1

            if (isset($request->status)){
                $pos->status = true; //if data is submitted then status is true
            }else{
                $pos->status = false;
            }
            $pos->is_approved = false; //it is author,so initially false

            $pos->user_id = Auth::user()->id; //insert user_id
            $pos->save();


        }else{

            $pos = Post::find($id);
            $pos->title = $request->title;
            $pos->category = $request->category;
            $pos->details = strip_tags($request->details);

            if (isset($request->status)){
                $pos->status = true; //if data is submitted then status is true
            }else{
                $pos->status = false;
            }
            $pos->is_approved = false; //it is author,so initially false

            $pos->user_id = Auth::user()->id;
            $pos->save();
        }

        return redirect()->route('author.post')->with('msg','updated successfully!');

    }


    //==============================view,delete=========================

    public function view($id){
        $rows = Post::find($id);

//        dd($rows->user_id);
//        if ($rows->user_id != Auth::id()){
//
//           dd($rows->user_id);
//        }

        return view('author.post.view',compact('rows'));




    }

    public function delete($id){
        $row = Post::find($id);
        if ($row->user_id != Auth::id()){

            return redirect()->back();
        }

        $row->delete();
        File::delete('user/backend/photos/'.$row->image);

        return redirect()->route('author.post');
    }



}
