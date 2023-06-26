@extends('client.layout');
@section('title', 'Trang chủ');
@section('content')
	<!-- Page content-->
  
  
    <!-- Blog entries-->
      <!-- Featured blog post-->
      <!-- Nested row for non-featured blog posts-->
      <div class="row">
        @foreach ($posts as $post)
        <div class="col-lg-6">
          <!-- Blog post-->
      @include('client.components.post', ['post' => $post])
        </div>
        @endforeach
      </div>
      <!-- Pagination-->
      {{ $posts->links('custom.pagination') }}
@endsection;
