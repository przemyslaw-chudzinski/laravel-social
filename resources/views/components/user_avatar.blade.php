@if($user->avatar)
  @if(strpos($user->avatar,'randomuser') === false)
  <img width="300" class="img-responsive thumbnail center-block" src="{{ asset('storage/users').'/'.$user->id.'/avatars/'.$user->avatar }}">
  @else
  {{-- Ten kod jest tylko dla wersji development !!!  --}}
  <img width="300" class="img-responsive thumbnail center-block" src="{{ $user->avatar }}">
  @endif
@endif
