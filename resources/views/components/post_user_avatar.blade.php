@if($user->avatar)
  @if(strpos($user->avatar,'randomuser') === false)
  <a href="{{ url('users'.'/'.$user->id) }}"><img width="64" class="media-object" src="{{ asset('storage/users').'/'.$user->id.'/avatars/'.$user->avatar }}"></a>
  @else
  {{-- Ten kod jest tylko dla wersji development !!!  --}}
  <a href="{{ url('users'.'/'.$user->id) }}"><img width="64" class="media-object" src="{{ $user->avatar }}"></a>
  @endif
@endif
