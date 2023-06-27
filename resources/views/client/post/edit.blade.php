@extends('client.layout')
@section('title', 'Chỉnh sửa bài viết')
@section('content')
<!-- Page content-->
<div class="container">
  <form action="{{ route('post.update', $post->id ) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-lg-8">

        <div class="mb-3">
          <label for="" class="form-label">title</label>
          <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="title"
            value="{{ $post->title }}">

        </div>

        <div class="mb-3">
          <label for="" class="form-label">Nội dung</label>
          <textarea name="content"
            id="content">{!! Request::old('content', $post->content) !!}</textarea>
        </div>
   
        <div class="mb-3">
          <label for="" class="form-label">Mô tả ngắn</label>
          <textarea name="short_content"
            id="short_content">{!! Request::old('short_content', $post->short_content) !!}</textarea>
        </div>
   
 
      </div>
      <div class="col-lg-4">
        <p>
          Hành động : <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn đăng? Vì bạn sửa bài nên sẽ phải chờ duyệt một lần nữa')" class="btn btn-primary">Đăng</button>
        </p>

        <p>
          <div class="mb-3">
            <label for="" class="form-label">Danh mục</label>
            @foreach($categories as $category)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{ $category->id }}"
                id="category_{{ $category->id }}" name="categories[]"   @if(in_array($category->id, $selectedCategories)) checked @endif>
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
          <input type="file" name="thumbnail" id="" class="form-control">
          <img src="{{ asset("uploads/$post->thumbnail") }}" width="200" alt="">
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
      })
      .catch( error => {
          console.error( error );
      } );
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