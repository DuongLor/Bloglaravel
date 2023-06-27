@extends('admin.layout')
@section('title', 'Danh sách bài viết')
    
@section('header_title', 'Tổng quan bài viết')    
@section('content')
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@endif
<form action="{{route('admin.post.index')}}" method="get" class="row">
  <div class="mb-3 col">
    <input type="text" class="form-control" id="search" name="search" placeholder="Nhập từ khóa">
  </div>
  <div class="col">
  <button type="submit" class="btn btn-primary">Tìm kiếm</button>
  </div>
</form>
<div class="table-responsive">
  <table class="table table-secondary">
    <thead>
      <tr>
        <th scope="col">STT</th>
        <th scope="col">Ngày đăng</th>
        <th scope="col">Người tạo</th>
        <th scope="col">Ảnh đại diện</th>
        <th scope="col">Tiêu đề</th>
        <th scope="col">Bài viết đặc sắc</th>
        <th scope="col">Hành động</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $key => $post)
      <tr class="">
        <td scope="row">{{ ++$key }}</td>
        <td>{{ $post->created_at->diffForHumans() }}</td>
        <td>{{ $post->user->name }}</td>
        <td>
          @if ($post->image)
          <img src="{{ asset('uploads/' . $post->image) }}" alt="" width="100px">
          @endif
        </td>
        <td>{{ $post->title }}</td>
        <td> 
          @include('admin.components.check_featured')
        </td>
        <td>
          <a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-primary">Xem</a>
        </td>
      </tr>
      @endforeach
      <tr>
        <td colspan="8">
          {{ $posts->links('custom.pagination') }}
        </td>
      </tr>
    </tbody>
  </table>
</div>


@endsection
@section('js-custom')
<script src="{{asset('js/check_featured.js')}}"></script>
@endsection