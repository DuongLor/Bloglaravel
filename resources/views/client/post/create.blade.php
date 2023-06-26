@extends('client.layout')
@section('title', 'Tạo mới bài viết')
@section('content')
<!-- Page content-->
<div class="container">
  <h2 class="mb-4">Tạo mới bài viết</h2>
  <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-lg-8">

        <div class="mb-3">
          <label for="" class="form-label">Tiêu đề</label>
          <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="title" value="{{ old('title') }}">
          @error('title')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Nội dung</label>
          <textarea name="content" id="content">{!! Request::old('content') !!}</textarea>
          @error('content')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Mô tả ngắn</label>
          <textarea name="short_content" id="short_content">{!! Request::old('short_content') !!}</textarea>
          @error('short_content')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>


      </div>
      <div class="col-lg-4">
        <p>
          Hành động : <button type="submit" class="btn btn-primary">Đăng</button>
        </p>
        <p>

       <div class="mb-3">
          <label for="" class="form-label">Danh mục</label>
          @foreach($categories as $category)
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{ $category->id }}"
              id="category_{{ $category->id }}" name="categories[]">
            <label class="form-check-label" for="category_{{ $category->id }}">
              {{ $category->name }}
            </label>
          </div>
        @endforeach
       </div>
        </p>
        <p>
        <div class="mb-3">
          <label for="" class="form-label">Ảnh đại diện</label>
          <input type="file" name="image" id="" class="form-control">
          @error('image')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>
        </p>
      </div>
    </div>
  </form>
</div>
@endsection
@section('js-custom')
<script>
  ClassicEditor
      .create( document.querySelector( '#content' ) ,
      {
       
         ckfinder:{
        uploadUrl:"{{route('ckeditor.upload').'?_token='.csrf_token()}}",
       }       
      });
  ClassicEditor.create(document.querySelector('#short_content'), {
  toolbar: {
    items: [
      'heading',
      '|',
      'bold',
      'italic',
      'underline',
      'strikethrough',
      '|',
      'link',
      '|',
      'bulletedList',
      'numberedList',
      '|',
      'indent',
      'outdent',
      '|',
      'undo',
      'redo'
    ]
  },
});
    
</script>

@endsection