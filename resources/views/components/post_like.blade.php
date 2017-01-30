<form method="post" action="{{ url('/likes') }}">
  {{ csrf_field() }}
  <input type="text" name="post_id" value="{{ $post->id }}" hidden>
  <button type="submit" class="btn btn-xs btn-primary">Lubię to {{ $post->likes->count() }}</button>
</form>
