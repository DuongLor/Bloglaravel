<a href="{{ route('post.detail', ['postId' => $post->id])}}" class="card border-0 text-decoration-none">
  <img class="card-img-top rounded-0" src="{{ asset('storage/' . $post->image) }}" alt="Title">
  <div class="card-body ms-0 ps-0">
    <p class="card-title text-primary">{{ $post->title }}</p>
    <p class="card-text text-secondary">{{ $post->created_at->diffForHumans() }}</p>
  </div>
</a>