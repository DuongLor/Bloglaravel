@extends('admin.layout')
@section('title', 'Dashboard')

@section('header_title', 'Tổng quan')
@section('content')
<form method="get" action="{{ route('dashboard') }}">
  @csrf
  <select class="form-select w-25" name="time_range" onchange="this.parentNode.submit()">
    <option value="today" {{$timeRange=='today' ? 'selected' : '' }}>Hôm nay</option>
    <option value="last_week" {{$timeRange=='last_week' ? 'selected' : '' }}>1 tuần trước</option>
    <option value="two_weeks_ago" {{$timeRange=='two_weeks_ago' ? 'selected' : '' }}>2 tuần trước
    </option>
  </select>
</form>

<div class="row mt-3">
  <div class="col-xl-6 col-md-12 mb-4">
    @include('admin.components.card',['color'=>'primary','title'=>'Tổng bài viết đã duyệt','count'
    => $approvedCount])
  </div>
  <div class="col-xl-6 col-md-12 mb-4">
    @include('admin.components.card',['color'=>'danger','title'=>'Tổng bài viết chưa duyệt','count'
    => $pendingCount])
  </div>
  <div class="col-xl-6 col-md-12 mb-4">
    @include('admin.components.card',['color'=>'success','title'=>'Người đăng ký mới','count' =>
    $user_joined_count])
  </div>
  <div class="col-xl-6 col-md-12 mb-4">
    @include('admin.components.card',['color'=>'warning','title'=>'Số lượt bình luận','count' =>
    $comment_count])
  </div>
</div>
<h2>Người có nhiều đóng góp</h2>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên</th>
        <th scope="col">Email</th>
        <th scope="col">Số lường bài viết đã đăng</th>
        <th scope="col">Được duyệt</th>
        <th scope="col">Chờ duyệt</th>
        <th scope="col">Bị từ chối</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users_top as $key => $user)
      <tr>
        <th scope="row">{{++$key}}</th>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->posts_count}}</td>
        <td>{{$user->posts()->where('status', 'approved')->count()}}</td>
        <td>{{$user->posts()->where('status', 'pending')->count()}}</td>
        <td>{{$user->posts()->where('status', 'reject')->count()}}</td>
      </tr>
      @endforeach
      @if ($users_top->count() >=$quantityData)
      <tr>
        <td colspan="7">
          {{$users_top->links('custom.pagination')}}
        </td>
      </tr>
      @endif
    </tbody>
  </table>
</div>
@endsection