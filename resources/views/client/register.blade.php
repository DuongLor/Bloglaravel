@extends('client.layout')
@section('title', 'Đăng ký')
@section('content')
<div class="w-50 mx-auto py-5">
  {{-- session error --}}
  @if (Session::has('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif
<form method="post" action="{{ route('register.store') }}" class="px-5 py-5">
  @csrf
  <div class="mb-3">
    <label for="" class="form-label">Họ tên</label>
    <input type="text" class="form-control" id="" name="name" value="{{ old('name') }}">
    @error('name')
      <p class="text-danger">{{ $message }}</p>
    @enderror
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Địa chỉ email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ old('email') }}">
    @error('email')
      <p class="text-danger">{{ $message }}</p>
    @enderror
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="{{ old('password') }}">
    @error('password')
      <p class="text-danger">{{ $message }}</p>
    @enderror
  </div>
 
  <div class="mb-3">
    <label for="" class="form-label">Nhập lại mật khẩu</label>
    <input type="password" class="form-control" id="" name="password_confirmation" value="{{ old('password_confirmation') }}">
    @error('password_confirmation')
      <p class="text-danger">{{ $message }}</p>
    @enderror
  </div>
 
  <button type="submit" class="btn btn-primary">Đăng ký</button>
</form>
</div>
@endsection