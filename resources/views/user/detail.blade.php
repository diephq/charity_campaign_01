@extends('layouts.app')

@section('content')

    <div id="page-content">
        <div class="hide" data-token="{{ csrf_token() }}"></div>
        <div class="row">
            @include('user.profile')
            <div class="col-md-9 center-panel">
                <div class="block">
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {{ Form::model($user, ['route' => ['user.update', $user->id] , 'method' => 'PATCH', 'class' => 'form-horizontal form-bordered ui-formwizard',
                     'enctype' => 'multipart/form-data']) }}
                        <div id="advanced-first" class="step ui-formwizard-content" style="display: block;">
                            <div class="wizard-steps">
                                <div class="row">
                                    <div class="col-xs-6 col-md-offset-3">
                                        <div class="text-center">
                                            <img src="{{ $user->avatar }}" class="avatar img-circle image_size" alt="avatar">
                                            <h6>{{ trans('user.upload_avatar') }}</h6>
                                            <div class="col-sm-6 col-md-offset-3">
                                                {{ Form::file('avatar', ['class' => 'form-control']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="val_username">{{ trans('user.name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        {{ Form::text('name', $user->name, ['class' => 'form-control ui-wizard-content']) }}
                                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="val_email">{{ trans('user.email') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        {{ Form::email('email', $user->email, ['class' => 'form-control ui-wizard-content']) }}
                                        <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="val_password">{{ trans('user.password') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        {{ Form::password('password', ['class' => 'form-control ui-wizard-content' ]) }}
                                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="val_confirm_password">{{ trans('user.confirm_password') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        {{ Form::password('password_confirmation', ['class' => 'form-control ui-wizard-content']) }}
                                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-actions">
                            <div class="col-md-8 col-md-offset-4">
                                {{ Form::submit( trans('message.save_changes'), ['class' => 'btn btn-raised btn-primary']) }}
                                {{ Form::hidden('_token', csrf_token()) }}
                                <span></span>
                                <input type="reset" class="btn btn-raised btn-default"
                                       value="{{ trans('message.cancel') }}">
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop
