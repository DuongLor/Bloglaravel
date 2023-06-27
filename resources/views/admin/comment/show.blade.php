@extends('admin.layout')
@section('title', 'Chi tiết phản hồi')
@section('header_title', 'Phản hồi')
@section('content')
<div class="container">
  <div class="row">
    <h2 class="col">
      Danh sách phản hồi
    </h2>
  </div>
	<div class="row">
		<div class="table-responsive">
			<a name="" id="" class="btn btn-primary" href="{{ route('comment.index') }}" role="button">Trở về </a>
			<table class="table table-light">
				<thead>
					<tr>
						<th scope="col">Ảnh đại diện</th>
						<th scope="col">Tên người dùng</th>
						<th scope="col">Nội dung</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($comment->replies as $reply)
					<tr>
						<td><img src="@if ($reply->user->avatar) {{ asset('uploads/' . $reply->user->avatar) }} @else
							https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp @endif" alt="" width="50px" height="50px"></td>
						<td>{{ $reply->user->name }}</td>
						<td>{{ $reply->content }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endsection