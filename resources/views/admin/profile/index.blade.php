@extends('admin.layout')
@section('title', 'Thông tin cá nhân')

@section('header_title', 'Tổng quan')
@section('content')
<section style="background-color: #eee;">
	<form action="{{ route('profile.update',["profileId" => $user->id]) }}" enctype="multipart/form-data" method="post">
		@csrf
		@method('PUT')
		<input type="text" value="{{ $user->id }}" name="id" hidden>
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
						@if ($user->avatar && file_exists(public_path('uploads/'.$user->avatar)))				
						<img src="{{ asset('uploads/'.$user->avatar) }}" alt="avatar"
						class="rounded-circle " width="150px" height="150px">
						@else
						<img src="{{ asset('uploads/OIP.jfif') }}" alt="avatar" alt="avatar"
						class="rounded-circle img-fluid" style="width: 150px;">
						@endif
						<input type="file" name="avatar" class="form-control mt-3" name="avatar">
						<br>
						@error('avatar')
						<span class="text-danger">{{ $message }}</span>
						@enderror
						@error('name')
						<span class="text-danger">{{ $message }}</span>
						@enderror
            <h5 class="my-3">{{ $user->name }}</h5>
          </div>
					<div class="d-flex justify-content-center mb-2">
							<button type="submit" class="btn btn-primary">Sửa tài khoản</button>
					</div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Họ tên</p>
              </div>
              <div class="col-sm-9">
                <input type="text" class="form-control" value="{{ $user->name }}" name="name"> 
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->email }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Bạn đã tạo lúc </p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->created_at->diffForHumans() }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Tài khoản được cập nhật </p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $user->updated_at->diffForHumans() }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
</section>
@endsection