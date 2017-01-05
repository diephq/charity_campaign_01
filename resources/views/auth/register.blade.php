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
            {!! Form::open(['url' => url('/register'), 'method' => 'POST', 'class' => 'form-horizontal form-bordered form-control-borderless']) !!}
            {!! Form::hidden('_token', csrf_token()) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('user.name') ]) !!}
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
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

            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm', 'placeholder' => trans('user.confirm_password')]) !!}
                    </div>
                </div>
            </div>

            <div class="form-group form-actions">
                <div class="col-xs-6 text-right pull-right">
                    <button type="submit" class="btn btn-sm btn-success"><i
                                class="fa fa-plus"></i> {{ trans('message.register') }}</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 text-center">
                    <span>{{ trans('message.have_account') }}</span>
                    <a href="{{ url('/login') }}" >{{ trans('message.login') }}</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
