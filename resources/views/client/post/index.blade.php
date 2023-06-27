@extends('client.layout')
@section('title', 'Danh sách bái viết')
@section('content')
<div class="container">
  <div class="row">
    <h2 class="col">Danh sách bài viết đã đăng</h2>
    <div class="col text-end">
      <a class=" btn btn-primary" href="{{route('post.create')}}" class="btn btn-primary">Tạo mới</a>
    </div>
    @if (session('success'))
   <div class="col-12">
    <div class="alert alert-success">
      {{ session('success') }}
  </div>
   </div>
@endif
  </div>
  <div class="table-responsive ">
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th scope="col">#</th>
          <th scope="col">ID</th>
          <th scope="col">Tiêu đề</th>
          <th scope="col">Ảnh đại diện</th>
          <th scope="col">Danh mục</th>
          <th scope="col">Trạng thái</th>
          <th scope="col">Hành động</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr class="text-center">
          <td>{{ $loop->iteration  }}</td>
          <th scope="row">{{$post->id}}</th>
          <td scope="row">{{$post->title}}</td>
          <td>
              <img src="{{asset("storage/$post->image")}}" width="100" class="img-fluid border rounded" alt="">
          </td>
          <td scope="row">
            {{ $post->selectedCategories }}
          </td>
          <td scope="row">
            @if ($post->status == 'pending')
              <span class="btn btn-warning">Chờ duyệt</span>
            @elseif ($post->status == 'approved')
              <span class="btn btn-success">Đã duyệt</span>
            @else
              <span class="btn btn-danger">Ngừng duyệt</span>
            @endif
            </div>
        </td>
          <td class="d-flex justify-content-center gap-2">
            <a href="{{route('post.show', $post->id)}}" class="btn btn-secondary">Xem chi tiết</a>
            <a href="{{route('post.edit', $post->id)}}" class="btn btn-primary">Sửa</a>
            <form action="{{ route('post.destroy', $post->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
          </form>
          
          </td>
        </tr>
        @endforeach
        <tr>
          <td colspan="4">
            {{ $posts->links('custom.pagination') }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection