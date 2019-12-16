<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //
    public function showIndex()
    {
        $allData = Post::latest()->get();

        return view('admin.post.postIndex', compact('allData'));
    }

    public function create()
    {
        return view('admin.post.create');
    }

//======================store==================
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required', //space after A-Z,it allows space
            'category' => 'required',
            'details' => 'required',

        ]);

        if ($request->hasFile('image')) {
            $img = uniqid() . '.jpg';
            $request->image->move('user/backend/photos', $img);

            $pos = new Post();
            $pos->title = $request->title;

            $pos->category = $request->category;

            $pos->image = $img;
            $pos->details = strip_tags($request->details); //remove tag like p,h1
            $pos->status = true; //if data is submitted then status is true
            $pos->is_approved = true; //it is admin,so always approved
            $pos->user_id = Auth::user()->id; //insert user_id
            $pos->save();


        } else {

            $pos = new Post();
            $pos->title = $request->title;

            $pos->category = $request->category;

            $pos->details = strip_tags($request->details);
            $pos->status = true; //if data is submitted then status is true
            $pos->is_approved = true; //it is admin,so always approved
            $pos->user_id = Auth::user()->id;
            $pos->save();
        }

        return redirect()->route('admin.post');

    }


//========================edit,update=======================
    public function edit($id)
    {
        $singleData = Post::find($id);
        if ($singleData->user_id != Auth::id()) {
            return back();
        }

        return view('admin.post.edit', compact('singleData'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required', //space after A-Z,it allows space
            'category' => 'required',
            'details' => 'required',

        ]);

        if ($request->hasFile('image')) {
            $img = uniqid() . '.jpg';
            $request->image->move('user/backend/photos', $img);

            $pos = Post::find($id);
            $pos->title = $request->title;
            $pos->category = $request->category;
            $pos->image = $img;
            $pos->details = strip_tags($request->details); //remove tag like p,h1

            $pos->status = true; //if data is submitted then status is true
            $pos->is_approved = true; //it is admin,so always approved

            $pos->user_id = Auth::user()->id; //insert user_id
            $pos->save();


        } else {

            $pos = Post::find($id);
            $pos->title = $request->title;
            $pos->category = $request->category;
            $pos->details = strip_tags($request->details);

            $pos->status = true; //if data is submitted then status is true
            $pos->is_approved = true; //it is admin,so always approved

            $pos->user_id = Auth::user()->id;
            $pos->save();
        }

        Toastr::success('Updated successfully !','success');
        return redirect()->route('admin.post');

    }


    //==============================view=========================

    public function view($id)
    {
        $row = Post::find($id);
        if ($row->user_id != Auth::id()) {
            return back();
        }

        return view('admin.post.view', compact('row'));
    }

    public function delete($id)
    {
        $row = Post::find($id);
        if ($row->user_id != Auth::id()) {
            Toastr::error('You are not authorized!','error');
            return back();
        }

        $row->delete();
        File::delete('user/backend/photos/' . $row->image);

        return redirect()->route('admin.post');
    }


    //======================pending post==============

    public function pending()
    {
        $pendingData = Post::where('is_approved', false)->get();

        return view('admin.post.pending', compact('pendingData'));
    }

    public function approve($id)
    {
        $pos = Post::find($id);

        if ($pos->is_approved == false) {
            $pos->is_approved = true;
            $pos->status = true;
            $pos->save();
        }

        return back();
    }

}
