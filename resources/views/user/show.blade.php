@extends('layouts.app')

@section('content')
    <div id="page-content">
        <div class="hide" data-token="{{ csrf_token() }}"></div>
        <div class="row">
            @include('user.profile')

            <div class="col-md-6 center-panel">
                <div class="profile-content">

                </div>
            </div>
            
            <div class="col-md-3 center-panel">
                <div class="profile-content">

                </div>
            </div>
        </div>
    </div>
@stop
