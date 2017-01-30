@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Edycja komentarza</div>
          <div class="panel-body">
            @include('components.edit_comment_form')
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
