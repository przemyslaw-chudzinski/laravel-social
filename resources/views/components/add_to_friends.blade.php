@if(Auth::user()->id !== $user->id)
  @if(!App\Helpers\UserHelper::friendship($user->id)['exists'])
    <form action="{{ url('/friends'. '/'. $user->id) }}" method="post">
      {{ csrf_field() }}
      <button class="btn btn-success">Dodaj do znajomych</button>
    </form>
  @else
    @if(App\Helpers\UserHelper::friendship($user->id)['accepted'])
      <form method="post" action="{{ url('friends').'/'.$user->id }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button class="btn btn-danger">Usuń ze znajomych</button>
      </form>
    @elseif(!App\Helpers\UserHelper::has_invitation($user->id))
      <button class="btn btn-success">Zaproszenie wysłano</button>
    @elseif(App\Helpers\UserHelper::has_invitation($user->id))
      <form method="post" action="{{ url('friends').'/'.$user->id }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <button class="btn btn-warning">Przyjmij zaproszenie</button>
      </form>
    @endif
  @endif
@endif

{{-- !App\Helpers\UserHelper::has_invitation($user->id) --}}
