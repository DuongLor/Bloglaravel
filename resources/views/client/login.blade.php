@extends('client.layout')
@section('title', 'Đăng nhập')
@section('content')
<div class="w-50 mx-auto py-5">
  @if (session('success'))
  <div class="alert alert-success" role="alert">
      {{ session('success') }}
  </div>
      
  @endif
  @if(session('error'))
  <div class="alert alert-danger" role="alert">
      {{ session('error') }}
  </div>
  @endif
<form action="{{ route('login') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Địa chỉ email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    @error('email')
    <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    @error('password')
    <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>
 
  <button type="submit" class="btn btn-primary">Đăng nhập</button>
</form>
</div>
@endsection