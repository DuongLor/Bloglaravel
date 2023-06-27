@extends('admin.layout')
@section('title', 'Bài viết')
    
@section('header_title', 'Chi tiết bài viết')    
@section('content')
<div class="">
  <div class="row">
    <div class="col text-end">
      <button class=" btn btn-primary" onclick="window.history.back()" class="btn btn-primary">Quay lại</button>
    </div>
  </div>
 <div class="w-75 mx-auto">
  <h2 class="text-center mt-4">{{$post->title}}</h2>
  <div class="text-center ">
  <img src="{{asset("uploads/$post->thumbnail")}}"class="object-fit-cover w-100" alt="">
  </div>
  
  <p class="text-justify fw-bold">{!! $post->short_content !!}</p>
  <p class="text-justify">{!! $post->content !!}</p>
  <p class="text-end">{{$post->user->name}}</p>
 </div>
</div>
@endsection