@extends('client.layout')

@section('title', 'tìm kiếm')
@section('content')
      <h2 class="mb-3">
        @isset($category)
        {{$category->name}}
        @endisset
        @if (request()->routeIs('search')) 
        <p>Danh mục:
        @foreach ($posts as $post)
          @foreach ($post->categories as $category)
          {{ $category->name }},
          @endforeach
          @endforeach
        </p>
        @endif

      </h2>
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
   
@endsection