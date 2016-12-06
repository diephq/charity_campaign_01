@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <div class="profile-userpic">
                        <img src="{{ $user->avatar }}" class="img-responsive" alt="">
                    </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {{ $user->name }}
                        </div>
                        <div class="profile-usertitle-email">
                            {{ $user->email }}
                        </div>
                    </div>

                    <div class="profile-userbuttons">
                        <button type="button" class="btn btn-success btn-sm">{{ trans('user.follow') }}</button>
                    </div>

                    <div class="profile-usermenu">
                        <ul class="nav">
                            @if ($user->isCurrent())
                            <li>
                                <a href="{{ action('UserController@edit', ['id' => $user->id]) }}">
                                    <i class="glyphicon glyphicon-user"></i>{{ trans('user.setting') }}
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                </div>
            </div>
        </div>
    </div>
@stop
