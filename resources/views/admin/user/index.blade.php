@extends('admin.layout')
@section('title', 'Thành viên')
    
@section('header_title', 'Tổng quan')    
@section('content')
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@endif
<form action="{{route('admin.user.index')}}" method="get" class="row">
  <div class="mb-3 col">
    <input type="text" class="form-control" id="search" name="search" placeholder="Nhập tên">
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
        <th scope="col">Tên</th>
        <th scope="col">Email</th>
        <th scope="col">Ảnh đại diện</th>
        <th scope="col">Quyền</th>
        <th scope="col">Thời gian tạo</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $key => $user)
      <tr class="">
        <td scope="row">{{ ++$key }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          @if ($user->avatar)
          <img src="{{ asset('uploads/' . $user->avatar) }}" alt="" width="100px">
          @endif
        </td>
        <td>{{ $user->role == 0 ? 'Quản trị' : 'Thành viên' }}</td>
        <td>{{ $user->created_at . '/' . $user->created_at->diffForHumans() }}</td>
      
      </tr>
      @endforeach
      <tr>
        <td colspan="6">
          {{ $users->links('custom.pagination') }}
        </td>
      </tr>
    </tbody>
  </table>
</div>


@endsection
@section('js-custom')
<script src="{{asset('js/check_featured.js')}}"></script>
@endsection