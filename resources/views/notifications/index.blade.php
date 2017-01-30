@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Powiadomienia</div>
                <div class="panel-body">
                    @if(Auth::user()->notifications->count())
                      @foreach (Auth::user()->notifications as $notification)
                        <div class="col-xs-12 {{ !is_null($notification->read_at) ? 'notification_muted': null }}">
                          <div class="pull-left">{!! $notification->data['message'] !!}</div>
                          <div class="pull-right">
                            @if(is_null($notification->read_at))
                            <form id="notification_form_update" method="post" action="{{ url('/notifications'.'/'.$notification->id) }}">
                              {{ csrf_field() }}
                              {{ method_field('PATCH') }}
                              <input type="checkbox" onclick="document.querySelector('#notification_form_update').submit();">
                            </form>
                            @endif
                          </div>
                        </div>
                      @endforeach
                    @else
                      <h3>Brak notyfikacji</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
