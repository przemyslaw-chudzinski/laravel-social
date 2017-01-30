@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edycja profilu</div>

                <div class="panel-body">
                  @include('components.user_avatar')
                  <br>
                  <form class="form-horizontal" role="form" action="{{ url('/users').'/'.$user->id }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            <label for="firstName" class="col-md-4 control-label">First name</label>

                            <div class="col-md-6">
                                <input id="firstName" type="text" class="form-control" name="firstName" value="{{ $user->firstName }}" required autofocus>

                                @if ($errors->has('firstName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            <label for="lastName" class="col-md-4 control-label">Last name</label>

                            <div class="col-md-6">
                                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ $user->lastName }}" required autofocus>

                                @if ($errors->has('lastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="gender" class="col-md-4 control-label">Gender</label>
                            <div class="col-md-6">
                                <select class="form-control" name="gender" id="gender" disabled>
                                    <option value="1" {{ $user->gender == '1' ? 'selected' : null }}>Woman</option>
                                    <option value="2" {{ $user->gender == '2' ? 'selected' : null }}>Man</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                          <label for="avatar_file" class="col-md-4 control-label">Avatar</label>
                          <div class="col-md-6">
                            <input type="file" id="avatar_file" name="avatar_file" class="form-control">
                            @if ($errors->has('avatar_file'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('avatar_file') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Zmiana hasła</div>
                <div class="panel-body">
                  <form class="form-horizontal" method="post" action="{{ url('/users').'/'.$user->id }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password" class="col-md-4 control-label">New password</label>
                      <div class="col-md-6">
                        <input type="password" id="password" name="password" class="form-control" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('repeatedPassword') ? ' has-error' : '' }}">
                      <label for="repeatedPassword" class="col-md-4 control-label">Repat password</label>
                      <div class="col-md-6">
                        <input type="password" id="repeatedPassword" name="repeatedPassword" class="form-control" required>
                        @if ($errors->has('repeatedPassword'))
                            <span class="help-block">
                                <strong>{{ $errors->first('repeatedPassword') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
