<form method="post" action="{{ url('/likes') }}">
  {{ csrf_field() }}
  <input type="text" name="comment_id" value="{{ $comment->id }}" hidden>
  <button type="submit" class="btn btn-xs btn-primary">Lubię to {{ $comment->likes->count() }}</button>
</form>
