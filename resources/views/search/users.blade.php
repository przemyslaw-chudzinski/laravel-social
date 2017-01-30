@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Wyniki wyszukiwania</div>
                <div class="panel-body">
                    @if(count($results) > 0)
                      <div class="row">
                        @foreach ($results as $user)
                          <div class="col-md-3">
                            <a href="{{ url('/users').'/'.$user->id }}">
                              @include('components.user_avatar')
                              <h5 class="text-center">{{ $user->firstName }} {{ $user->lastName }}</h5>
                            </a>
                          </div>
                        @endforeach
                      <div>
                      <div class="text-center">
                        {{ $results->links() }}
                      </div>
                    @else
                      <h3>Brak wyników wyszukiwania</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
