@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Dane użytkownika <a class="pull-right" href="{{ url('users').'/'.$user->id.'/friends' }}">Friends ({{ $user->friends()->count() }})</a></div>
                <div class="panel-body text-center">
                    @include('components.user_avatar')
                    <h2>{{ $user->firstName }} {{ $user->lastName }}</h2>
                    <h3>
                    @if($user->gender == '1')
                        Kobieta
                    @else
                        Mężczyzna
                    @endif
                    </h3>
                    <h4>{{ $user->email }}</h4>
                    @include('components.add_to_friends')
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @include('components.wall')
        </div>
    </div>
</div>
@endsection
