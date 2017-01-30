@if(!Auth::user()->likes->contains('post_id',$post->id))
<form method="post" action="{{ url('/likes') }}">
  {{ csrf_field() }}
  <input type="text" name="post_id" value="{{ $post->id }}" hidden>
  <button type="submit" class="btn btn-xs btn-primary">Lubię to {{ $post->likes->count() }}</button>
</form>
@else
  <form method="post" action="{{ url('/likes') }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="text" name="post_id" value="{{ $post->id }}" hidden>
    <button class="btn btn-xs btn-primary">Nie lubię {{ $post->likes->count() }}</button>
  </form>
@endif
