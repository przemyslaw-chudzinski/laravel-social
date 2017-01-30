<form method="post" action="{{ url('/posts') }}">
  {{ csrf_field() }}
  <div class="form-group">
    <textarea name="post_content" class="form-control" placeholder="Napisz co u Ciebie słychać..." rows="5" required></textarea>
    @if ($errors->has('post_content'))
        <span class="help-block">
            <strong>{{ $errors->first('post_content') }}</strong>
        </span>
    @endif
  </div>
  <div class="form-group"><button class="btn btn-primary">Opublikuj</button></div>
</form>
