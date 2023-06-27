@extends('admin.layout')
@section('title', 'Bình luận')
@section('header_title', 'Bình luận')
@section('content')
<div class="container">
  <div class="row">
    <h2 class="col">
      Danh sách Bình luận
    </h2>
    {{-- error session --}}
    @if (session()->has('error'))
    <div class="alert alert-danger">
      {{ session()->get('error') }}
    </div>
    @endif
    {{-- success session --}}
    @if (session()->has('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div>
    @endif
  </div>
  <div class="row">
		<div>
			<div class="table-responsive">
				<table class="table table-light">
					<thead>
						<tr>
							<th scope="col">Bài đăng</th>
							<th scope="col">Ảnh đại diện</th>
							<th scope="col">Người bình luận</th>
							<th scope="col">Nội dung</th>
							<th scope="col">Ngày comment</th>
							<th scope="col">Chi tiết</th>
							<th scope="col">Phản hồi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($comments as $comment)
						<tr>
							<td>{{ $comment->post->title }}</td>
							<td><img src="@if ($comment->user->avatar == null || !file_exists('uploads/' . $comment->user->avatar)) {{ asset('uploads/OIP.jfif') }} @else {{ asset('uploads/' . $comment->user->avatar) }} @endif" alt="" width="50px" height="50px"></td>
							<td>{{ $comment->user->name }}</td>
							<td>{{ $comment->content }}</td>
							<td>{{ $comment->created_at }}</td>
							<td><a href="{{ route('admin.comment.show', $comment->id) }}">Các phản hồi</a></td>
							<td>
								<form action="{{ route('admin.comment.reply', $comment->id) }}" method="post">
									@csrf
									<input type="text" name="content" class="form-control">
									<button type="submit" class="btn btn-primary" hidden>Phản hồi</button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			{{$comments->links('custom.pagination')}}
		</div>
  </div>
</div>

@endsection