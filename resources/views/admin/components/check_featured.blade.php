<form class="featureForm" action="{{ route('admin.post.feature', $post->id)}}" method="post">
  @csrf
  <div class="form-check form-switch">
    <input class="form-check-input featureCheckbox" type="checkbox" @if ($post->is_featured == 1) checked @endif>
  </div>
</form>