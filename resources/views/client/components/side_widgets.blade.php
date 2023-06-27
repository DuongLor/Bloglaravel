  <!-- Side widgets-->
  
    <!-- Search widget-->
    <div class="card mb-4">
      <div class="card-header">Search</div>
      <div class="card-body">
       <form action="{{ route('search') }}" method="get">
        <div class="input-group">
          <input class="form-control" type="text" placeholder="Enter search term..."
            aria-label="Enter search term..." aria-describedby="button-search" name="q" value="{{ old('q') }}"/>
          <button class="btn btn-primary" id="button-search" >Go!</button>
        </div>
      </form>
      </div>
    </div>
    <!-- Categories widget-->
    <div class="card mb-4">
      <div class="card-header">Danh mục</div>
      <div class="card-body">
        <div class="row">
            <div class="row mb-0">
              @foreach ($categories as $category)
              <div class="col-md-6 text-justify"><a href="{{route('post.showByCategory', ['categoryId' => $category->id]) }}">{{ $category->name }}</a></div>
              @endforeach
            </div>
        </div>
      </div>
    </div>
    <!-- Side widget-->
    <h3>Bình luận</h3>
    <div class="card mb-4">
      @foreach ($top_10_new_comment as $comment)
        <a href="{{route('post.detail', ['postId' => $comment->post->id])}}" class="d-flex border-bottom p-1 gap-1 text-decoration-none">
          <div class="">
            @if ($comment->user->avatar != null && file_exists(public_path('uploads/' . $comment->user->avatar)))
              <img src="{{ asset('uploads/' . $comment->user->avatar) }}" alt="" width="50px" height="50px">
            @else
              <img src="{{ asset('uploads/OIP.jfif') }}" alt="" width="50px" height="50px">
            @endif
          </div>
          <div class="">
            <p>{{ $comment->user->name }}: <span class="text-break">{{ Str::limit($comment->content, 50, '...') }}</span></p>
          </div>
        </a>

      @endforeach
    </div>