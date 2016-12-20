@extends('layouts.app')

@section('js')
    @parent
    {{ Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyDFQqwSkHBKMaeW04BYgLL8_3fmrXlaxbE&v=3.exp&libraries=places&language=en') }}
    {{ Html::script('bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
    {{ Html::script('js/campaign.js') }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('campaign.create') }}</div>
                    <div class="panel-body">

                        @if (Session::has('message'))
                            <div class="col-lg-12">
                                <div class="col-lg-10 col-lg-offset-1 alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {!! Session::get('message') !!}
                                </div>
                            </div>
                        @endif

                    {!! Form::open(['action' => 'CampaignController@store', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">{{ trans('campaign.image') }}</label>

                            <div class="col-md-6">
                                {{ Form::file('image', ['class' => 'form-control']) }}

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">{{ trans('campaign.name') }}</label>

                            <div class="col-md-6">
                                {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">{{ trans('campaign.categories') }}</label>

                            <div class="col-md-6">
                                @foreach ($categories as $category)
                                    <div class="checkbox">
                                        {!! Form::checkbox('category_id[]', $category->id ) !!}{{ $category->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                            <label for="start_date" class="col-md-4 control-label">{{ trans('campaign.start_date') }}</label>

                            <div class="col-md-6">
                                {!! Form::text('start_date', null, ['class' => 'form-control datetimepicker']) !!}

                                @if ($errors->has('start_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                            <label for="end_date" class="col-md-4 control-label">{{ trans('campaign.end_date') }}</label>

                            <div class="col-md-6">
                                {!! Form::text('end_date', null, ['class' => 'form-control datetimepicker']) !!}

                                @if ($errors->has('end_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">{{ trans('campaign.address') }}</label>

                            <div class="col-md-6">
                                {!! Form::text('address', old('address'), ['class' => 'form-control', 'id' => 'location']) !!}

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">{{ trans('campaign.description') }}</label>

                            <div class="col-md-6">
                                {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('campaign.create') }}
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
