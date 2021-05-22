@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-3 p-5">
        <img src="/svg/dm.svg" class="rounded-circle">
    </div>
    <div class="col-9 pt-5">
    <div><h1>{{$user->username}}</h1></div>
        <div class="d-flex">
            <div class="pr-5"><strong>153 </strong>posts</div>
            <div class="pr-5"><strong>33k </strong>followers</div>
            <div class="pr-5"><strong>153 </strong>following</div>
        </div>
        <div class="pt-4">{{$user->profile->title}}</div>
        <div>{{$user->profile->description}}</div>
        <div><a href='#'>{{$user->profile->url ?? 'N/A'}}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        <div class="col-4">
        <img src="/svg/dm.svg" class="w-100">
        </div>
        <div class="col-4">
        <img src="/svg/dm.svg" class="w-100">
        </div>
        <div class="col-4">
        <img src="/svg/dm.svg" class="w-100">
        </div>
    </div>

</div>
@endsection
