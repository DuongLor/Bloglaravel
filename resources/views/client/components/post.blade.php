<div class="card mb-4">
  <a href="{{ route('post.detail', ['postId' => $post->id]) }}"><img class="card-img-top"
      src="{{ asset('storage/'.$post->image) }}" alt="..." /></a>
  <div class="card-body">
    <div class="small text-muted">{{ $post->created_at->diffForHumans() }}</div>
    <h2 class="card-title h4">{{ $post->title }}</h2>
    <p class="card-text">{!! $post->short_content !!}</p>
    <a class="btn btn-primary" href="{{ route('post.detail', ['postId' => $post->id]) }}">Đọc thêm →</a>
  </div>
</div>