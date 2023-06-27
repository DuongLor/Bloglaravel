@extends('admin.layout')
@section('title', 'Danh sách danh mục')
@section('header_title', 'Danh mục')
@section('content')
<div class="container">

  <div class="row">
    <h2 class="col">Thêm mới</h2>
    <h2 class="col">
      Danh sách danh mục
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
    <div class="col-md-6">
      <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
        @csrf
          <div class="col-lg-8">
    
            <div class="mb-3">
              <label for="" class="form-label">Tên danh mục</label>
              <input type="text" class="form-control" id=""
                aria-describedby="emailHelp" name="name">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Danh mục cha</label>
              {{-- select --}}
              <div class="">
                <select name="parent_id" class="form-select" id="" aria-label="Danh mục cha">
                  <option selected value="">Chọn danh mục</option>
                  @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
                @error('parent_id')
                <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            
            </div>
            <button type="submit" class="btn btn-primary">Đăng</button>
            
          </div>
         
      </form>
    </div>
    <ul class="mt-3 col-md-6">
      @foreach ($parent_categories as $category)
      @include('admin.category._category', ['category' => $category])
      @endforeach
    </ul>
  </div>
 
</div>

@endsection