<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

//skipping  the middle ware auth here in this file


class ProfilesController extends Controller
{
    public function index(\App\Models\User $user)
    {   
        //$user = \App\Models\User::findOrFail($user);
       
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id):false;
       
        $postsCount = Cache::remember(
        'count.post' . $user->id,
        now()->addSeconds((2)), 
        function() use ($user){
            return $user->posts->count();
        });
        
        $followersCount = Cache::remember(
            'count.followers' . $user->id,
            now()->addSeconds((2)), 
            function() use ($user){
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember(
            'count.following' . $user->id,
            now()->addSeconds((2)), 
            function() use ($user){
                return $user->following->count();
            });
        
        return view('profiles.index',[
            'user' => $user,
            'follows' => $follows,
            'postsCount' => $postsCount,
            'followersCount' => $followersCount,
            'followingCount'=> $followingCount,
            ]);
    }
    public function edit(\App\Models\User $user)
    {   
        $this->authorize('update',$user->profile);
        return view('profiles.edit',compact('user'));
    }

    public function update(\App\Models\User $user)
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' =>'',
        ]);
        //$imagePath
        // global $imagePath;
        // $imagePath = NULL;   
        if(request('image')){
            
            
            $imagePath = $data['image']->store('profile','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
            $imageArray = ['image'=>$imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray??[]//overwrites the already exisiting image field in data, with the image path
        ));

        return redirect("/profile/{$user->id}");
    }
}
//App/Models could be used as use statement and pnly user would suffice our query then
// use App\Models\User;
//(!$imagePath)?(['image'=>$imagePath]):NULL