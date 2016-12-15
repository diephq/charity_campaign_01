@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row profile">

            @include('user.profile')

            <div class="col-md-6">
                <div class="profile-content">

                </div>
            </div>
            
            <div class="col-md-3">
                <div class="profile-content">
                </div>
            </div>
        </div>
    </div>
@stop
