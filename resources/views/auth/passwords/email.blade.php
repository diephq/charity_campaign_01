@extends('auth.app')

@section('content')
<div class="container">
    <div id="login-container" class="animation-fadeIn">
        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="login-title text-center">
                <h1><i class="gi gi-flash"></i> <strong>{{ trans('message.project') }}</strong><br>
                    <small>
                        <strong>{{ trans('user.reset_password') }}</strong>
                    </small>
                </h1>
            </div>
            <div class="block push-bit">
                {!! Form::open(['url' => url('/password/email'), 'method' => 'POST', 'class' => 'form-horizontal form-bordered form-control-borderless']) !!}
                {!! Form::hidden('_token', csrf_token()) !!}
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

                <div class="form-group form-actions">
                    <div class="col-xs-6 text-right pull-right">
                        {!! Form::submit(trans('user.link_reset_password'), ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
