@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('user.login') }}</div>
                <div class="panel-body">

                    @if ($errors)
                        @foreach ($errors->all() as $message)
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @endforeach
                    @endif

                    {!! Form::open(['url' => url('/login'), 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('_token', csrf_token()) !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ trans('user.email') }}</label>

                            <div class="col-md-6">
                                {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ trans('user.password') }}</label>

                            <div class="col-md-6">
                                {!! Form::password('password', ['class' => 'form-control']) !!}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('remember') !!} {{ trans('user.remember') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {!! Form::submit(trans('user.login'), ['class' => 'btn btn-primary']) !!}
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">{{ trans('user.forgot_password') }}</a>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ url('/redirect/facebook') }}" class="btn btn-block btn-social btn-facebook col-lg-2">
                                            <span class="fa fa-twitter"></span>
                                            {{ trans('user.login_facebook') }}
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ url('/redirect/twitter') }}" class="btn btn-block btn-social btn-twitter col-lg-2">
                                            <span class="fa fa-twitter"></span>
                                            {{ trans('user.login_twitter') }}
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ url('/redirect/google') }}" class="btn btn-block btn-social btn-google col-lg-2">
                                            <span class="fa fa-twitter"></span>
                                            {{ trans('user.login_google') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
