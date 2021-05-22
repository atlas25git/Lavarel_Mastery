<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


//skipping  the middle ware auth here in this file


class ProfilesController extends Controller
{
    public function index($user)
    {   
        $user = \App\Models\User::findOrFail($user);
        return view('home',[
            'user' => $user,
        ]);
    }
}
