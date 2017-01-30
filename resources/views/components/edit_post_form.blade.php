<form method="post" action="{{ url('/posts'.'/'.$post->id) }}">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
  <div class="form-group">
    <textarea name="post_content" class="form-control" placeholder="Napisz co u Ciebie słychać..." rows="5" required>{{ $post->content }}</textarea>
    @if ($errors->has('post_content'))
        <span class="help-block">
            <strong>{{ $errors->first('post_content') }}</strong>
        </span>
    @endif
  </div>
  <div class="form-group"><button class="btn btn-primary">Zapisz</button></div>
</form>
