@if(!Auth::user()->likes->contains('comment_id',$comment->id))
<form method="post" action="{{ url('/likes') }}">
  {{ csrf_field() }}
  <input type="text" name="comment_id" value="{{ $comment->id }}" hidden>
  <button type="submit" class="btn btn-xs btn-primary">Lubię to {{ $comment->likes->count() }}</button>
</form>
@else
  <form method="post" action="{{ url('/likes') }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="text" name="comment_id" value="{{ $comment->id }}" hidden>
    <button type="submit" class="btn btn-xs btn-primary">Nie lubię {{ $comment->likes->count() }}</button>
  </form>
@endif
