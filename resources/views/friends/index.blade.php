@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Znajomi</div>
                <div class="panel-body">
                    @if(count($friends) > 0)
                      <div class="row">
                        @foreach ($friends as $user)
                          <div class="col-md-3">
                            <a href="{{ url('/users').'/'.$user->id }}">
                              @include('components.user_avatar')
                              <h5 class="text-center">{{ $user->firstName }} {{ $user->lastName }}</h5>
                            </a>
                          </div>
                        @endforeach
                      <div>
                      <div class="text-center">
                        {{-- {{ $friends->links() }} --}}
                      </div>
                    @else
                      <h3>Użytkownik nie ma żadnych znajomych</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
