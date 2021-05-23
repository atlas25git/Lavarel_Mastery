<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = \App\Models\Post::whereIn('user_id',$users)->with('user')->latest()->paginate(5);

        return view('posts.index',compact('posts'));

    }

    public function create()
    {
    return view('posts/create');
    }

    public function store(Request $request){

        $data = $request->validate([                             
            'caption' => 'required',
            'image' => 'required',
        ]);
        
        $imagePath = $data['image']->store('uploads','public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();
        
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Models\post $post)
    {
            return view('posts.show',[
                'post' => $post,
            ]);
    }
}
