@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-3 p-5">
        <img src="/svg/dm.svg" class="rounded-circle">
    </div>
    <div class="col-9 pt-5">
    <div class="d-flex justify-content-between align-items-baseline">
        <h1>{{$user->username}}</h1>
        <a href="/p/create">Add Post</a>
    </div>
        <div class="d-flex">
            <div class="pr-5"><strong>{{$user->posts->count()}} </strong>posts</div>
            <div class="pr-5"><strong>33k </strong>followers</div>
            <div class="pr-5"><strong>153 </strong>following</div>
        </div>
        <div class="pt-4">{{$user->profile->title}}</div>
        <div>{{$user->profile->description}}</div>
        <div><a href='#'>{{$user->profile->url ?? 'N/A'}}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
        <img src="/storage/{{$post->image}}" class="w-100">
        </div>
        
        @endforeach
    </div>

</div>
@endsection
