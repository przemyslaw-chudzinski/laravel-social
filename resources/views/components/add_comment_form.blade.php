<div id="comment-{{ $post->id }}">
  <form method="post" action="{{ url('/comments') }}">
    {{ csrf_field() }}
    <div class="form-group">
      <textarea name="post_{{ $post->id }}_comment_content" class="form-control" placeholder="Skomentuj ten post" required></textarea>
      <input type="text" name="post_id" hidden value="{{ $post->id }}">
      @if ($errors->has('post_'. $post->id .'_comment_content'))
          <span class="help-block">
              <strong>{{ $errors->first('post_'. $post->id .'_comment_content') }}</strong>
          </span>
      @endif
    </div>
    <button class="btn btn-primary btn-sm">Opublikuj</button>
  </form>
</div>
