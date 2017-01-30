<form method="post" action="{{ url('/comments'.'/'.$comment->id) }}">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
  <div class="form-group">
    <textarea name="comment_content" class="form-control" placeholder="Napisz co u Ciebie słychać..." rows="5" required>{{ $comment->content }}</textarea>
    @if ($errors->has('comment_content'))
        <span class="help-block">
            <strong>{{ $errors->first('comment_content') }}</strong>
        </span>
    @endif
  </div>
  <div class="form-group"><button class="btn btn-primary">Zapisz</button></div>
</form>
