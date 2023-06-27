@extends('admin.layout')
@section('title', 'Chỉnh sửa danh mục')
@section('header_title', 'Sửa danh mục')
@section('content')
<!-- Page content-->
<div class="container py-5">
  <form action="{{ route('category.update', $cate->id) }}" method="post"
    enctype="multipart/form-data">
    @csrf
    @method('put')
     <div class="row">
      <div class="col-lg-6">

        <div class="mb-3">
          <label for="" class="form-label">Tên danh mục</label>
          <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="name"
            value="{{ $cate->name }}">
          @error('name')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Danh mục cha</label>
          {{-- select --}}
          <div class="">
            <select name="parent_id" class="form-select" id="" aria-label="Danh mục cha">
              <option selected>Chọn danh mục</option>
              @foreach($categories as $category)
              <option {{ $cate->parent_id == $category->id ? 'selected' : '' }}
                value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
            @error('parent_id')
            <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>

        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>

      </div>
     </div>
     
  </form>
</div>
@endsection