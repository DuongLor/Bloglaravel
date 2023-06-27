@extends('client.layout')
@section('title', 'Chi tiết')
@section('content')
<div class="container">
  <div class="row">
    <h2 class="col">Chi tiết bài viết</h2>
    <div class="col text-end">
      <a class=" btn btn-primary" href="{{route('post.index')}}" class="btn btn-primary">Quay lại</a>
    </div>
  </div>
 <div class="w-75 mx-auto">
  <h2 class="text-center mt-4">{{$post->title}}</h2>
  <div class="text-center">
  <img src="{{asset("uploads/$post->thumbnail")}}" width="400" height="300" class="object-fit-cover" alt="">
  </div>
  
  <p class="text-justify fw-bold">{!! $post->short_content !!}</p>
  <p class="text-justify">{!! $post->content !!}</p>
  <p class="text-end">{{$user->name}}</p>
 </div>
</div>
@endsection