@extends('layouts.app')

@section('js')
    @parent
    {{ Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js') }}
    {{ Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyAvCSKMKzElwzRaHpcURMmS6J4z4qGP0ZM&libraries=places') }}
    {{ Html::script('bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
    {{ Html::script('bower_components/ckeditor/ckeditor.js') }}
    {{ Html::script('http://opoloo.github.io/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js') }}
    {{ Html::script('js/campaign.js') }}

    <script type="text/javascript">
        $(document).ready(function () {
            var campaign = new Campaign('{!! action('CampaignController@uploadImage').'?_token='.csrf_token() !!}');
            campaign.init();
        });
    </script>
@stop

@section('content')
        <div id="page-content">
            <div class="col-md-12 center-panel">
                <div class="block">
                    <div class="block-title themed-background-dark">
                        <div class="block-options pull-right">
                            <div class="dropdown">
                                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default dropdown-toggle" data-toggle="dropdown" title="Settings">
                                    <i class="fa fa-cog"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                </ul>
                            </div>
                        </div>
                        <h2 class="block-title-light campaign-title"><strong>{{ trans('campaign.create') }}</strong></h2>
                    </div>

                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="col-lg-12">
                                <div class="col-lg-10 col-lg-offset-1 alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {!! Session::get('message') !!}
                                </div>
                            </div>
                        @endif

                        <div class="campaign">
                            {!! Form::open(['action' => 'CampaignController@store', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <div id="image-preview" class="col-md-6">
                                        <label for="image-upload" id="image-label">{{ trans('campaign.image') }}</label>
                                        {{ Form::file('image', ['class' => 'form-control', 'id' => 'image-upload']) }}
                                        @if ($errors->has('image'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">{{ trans('campaign.name') }}</label>

                                <div class="col-md-8">
                                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">{{ trans('campaign.categories') }}</label>

                                <div class="col-md-8 category">
                                    <div class="category-content">
                                        <div class="col-md-6">
                                            {!! Form::text('category[name][1]', null, ['class' => 'form-control category-name', 'placeholder' => trans('campaign.category')] ) !!}
                                        </div>
                                        <div class="col-md-3">
                                            {!! Form::number('category[goal][1]', null, ['class' => 'form-control category-goal', 'placeholder' => trans('campaign.goal'), 'min' => 1]) !!}
                                        </div>
                                        <div class="col-md-3">
                                            {!! Form::text('category[unit][1]', null, ['class' => 'form-control category-unit', 'placeholder' => trans('campaign.unit')]) !!}
                                        </div>
                                    </div>
                                    <div>
                                        @if ($errors->has('category'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                <label for="start_date" class="col-md-3 control-label">{{ trans('campaign.start_date') }}</label>

                                <div class="col-md-8">
                                    {!! Form::text('start_date', null, ['class' => 'form-control datetimepicker']) !!}

                                    @if ($errors->has('start_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                <label for="end_date" class="col-md-3 control-label">{{ trans('campaign.end_date') }}</label>

                                <div class="col-md-8">
                                    {!! Form::text('end_date', null, ['class' => 'form-control datetimepicker']) !!}

                                    @if ($errors->has('end_date'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-3 control-label">{{ trans('campaign.address') }}</label>

                                <div class="col-md-8">
                                    {!! Form::text('address', old('address'), ['class' => 'form-control', 'id' => 'location']) !!}
                                    {!! Form::hidden('lattitude', '', ['id' => 'lat']) !!}
                                    {!! Form::hidden('longitude', '', ['id' => 'lng']) !!}

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

                                <label for="description" class="col-md-3 control-label">{{ trans('campaign.description') }}</label>

                                <br>
                                <div class="col-lg-10 col-lg-offset-1">
                                    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'id' => 'editor', 'rows' => '10']) !!}

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-1">
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
