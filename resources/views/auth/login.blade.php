@extends('auth.app')

@section('content')
    <img src="img/placeholders/backgrounds/login_full_bg.jpg" alt="Login Full Background"
         class="full-bg animation-pulseSlow">

    <div id="login-container" class="animation-fadeIn">
        <div class="login-title text-center">
            <h1><i class="gi gi-flash"></i> <strong>{{ trans('message.project') }}</strong><br>
                <small>{{ trans('message.please') }}
                    <strong>{{ trans('message.login') }}</strong> {{ trans('message.or') }}
                    <strong>{{ trans('message.register') }}</strong>
                </small>
            </h1>
        </div>

        <div class="block push-bit">
            {!! Form::open(['url' => url('/login'), 'method' => 'POST', 'class' => 'form-horizontal form-bordered form-control-borderless']) !!}
            <div class="form-group">
                <div class="col-md-8 col-md-offset-2">
                    <a href="{{ url('/redirect/facebook') }}"
                       class="btn btn-block btn-social btn-facebook col-lg-2">
                        <span class="fa fa-facebook"></span>
                        {{ trans('user.login_facebook') }}
                    </a>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-2">
                    <a href="{{ url('/redirect/twitter') }}"
                       class="btn btn-block btn-social btn-twitter col-lg-2">
                        <span class="fa fa-twitter"></span>
                        {{ trans('user.login_twitter') }}
                    </a>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-2">
                    <a href="{{ url('/redirect/google') }}"
                       class="btn btn-block btn-social btn-google col-lg-2">
                        <span class="fa fa-google"></span>
                        {{ trans('user.login_google') }}
                    </a>
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                        {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('user.email')]) !!}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('user.password')]) !!}
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group form-actions">
                <div class="col-xs-4">
                    <label class="switch switch-primary" data-toggle="tooltip" title=""
                           data-original-title="Remember Me?">
                        {!! Form::checkbox('remember') !!} {{ trans('user.remember') }}
                        <span></span>
                    </label>
                </div>

                <div class="col-xs-8 text-right">
                    {!! Form::submit(trans('user.login'), ['class' => 'btn btn-raised btn-primary']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 text-center">
                    <a href="{{ url('/password/reset') }}">{{ trans('user.forgot_password') }}</a>
                    <a href="{{ url('/register') }}">{{ trans('message.register') }}</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
