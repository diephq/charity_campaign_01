@extends('layouts.app')

@section('content')
    <div id="page-content">
        <div class="row">
            <div class="col-md-12 center-panel text-center">
                <br>
                <h4>{{ trans('message.site') }}</h4>
                <br>
                <br>
                <br>
                <p><img src="{{ config('path.not_found') }}" alt=""></p>
                <h2><i class="fa fa-exclamation-triangle"></i>
                    {{ trans('message.not_found') }} <small>{{ trans('message.404') }}</small>
                </h2>
                <br>
                <br>
                <br>
                <p><a href="{{ action('CampaignController@index') }}">{{ trans('message.click_here') }}</a> {{ trans('message.visit_home_page') }}</p>
            </div>
        </div>
    </div>
@stop
