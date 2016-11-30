@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p class="text-warning">{{ trans('message.not_found') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
