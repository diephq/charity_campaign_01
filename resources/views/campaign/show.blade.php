@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-xs-12  col-md-8">
                    <div class="boxed  sticky  push-down-45">
                        <div class="meta">
                            <img class="wp-post-image" src="{{ $campaign->image->image }}">
                            <div class="meta__container">
                                <div class="row">
                                    <div class="col-xs-12  col-sm-8">
                                        <div class="meta__info">
                                                <span class="meta__author">
                                                    <img src="{{ $campaign->owner->user->avatar }}" class="img-circle">
                                                    <a href="#">{{ $campaign->owner->user->name }}</a>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sticky__box">
                            <span class="sticky__circle"></span>
                            <span class="sticky__circle"></span>
                            <span class="sticky__circle"></span>
                            <span class="sticky__circle"></span>
                        </div>

                        <div class="row">
                            <div class="col-xs-10  col-xs-offset-1">

                                <div class="post-content--front-page">
                                    <h3>{{ $campaign->name }}</h3>
                                    <p>{{ $campaign->description }}</p>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12  col-sm-6">
                                    </div>
                                    <div class="col-xs-12  col-sm-6">
                                        <div class="btn-group social-network">
                                            {!! Form::button('', ['class' => 'btn btn-default fa fa-facebook']) !!}
                                            {!! Form::button('', ['class' => 'btn btn-default fa fa-twitter']) !!}
                                            {!! Form::button('', ['class' => 'btn btn-default fa fa-envelope']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12  col-md-4">
                    <div class="widget-author  boxed  push-down-30">
                        <div class="row">
                            <div class="col-xs-10  col-xs-offset-1">
                                <div class="x_title">
                                    <h2>{{ trans('campaign.contributors') }}</h2>
                                </div>
                                <ul class="list-unstyled top_profiles scroll-view">
                                    @foreach ($campaign->contributions as $contribution)
                                    <li class="media event">
                                        @if ($contribution->user)
                                            <a class="pull-left border-aero profile_thumb">
                                                <img src="{{ $contribution->user->avatar }}" class="img-circle" alt="" >
                                            </a>
                                            <div class="media-body">
                                                <a class="title" href="{{ action('UserController@show', ['id' => $contribution->user->id    ]) }}">{{ $contribution->user->name }}</a>
                                                <p>{{ $contribution->user->email }}</p>
                                                <small>{{ $contribution->created_at }}</small>
                                            </div>
                                        @else
                                            <a class="pull-left border-aero profile_thumb">
                                                <img src="{{ config('path.to_avatar_default') }}" class="img-circle" alt="" >
                                            </a>
                                            <div class="media-body">
                                                <p>{{ $contribution->name }}</p>
                                                <p>{{ $contribution->email }}</p>
                                                <small>{{ $contribution->created_at }}</small>
                                            </div>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="contribution">
                                    {{ Form::button('Contribute', [
                                    'class' => 'btn btn-success',
                                    'data-toggle'=>'modal',
                                    'data-target'=>'.contribute'
                                    ]) }}
                                    {{ Form::button('Show more', ['class' => 'btn btn-success']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade contribute" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('campaign.contribute') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body">
                        {!! Form::open(['url' => action('ContributionController@store'), 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                        {!! Form::hidden('campaign_id', $campaign->id) !!}

                        @if (Auth::guest())
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <div class="col-md-10 col-md-offset-1">
                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('user.name')]) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('user.email')]) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @foreach ($categories as $category)
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="col-md-6">
                                    {{ $category->name }}
                                </div>
                                <div class="col-md-6 category">
                                    <div class="input-group">
                                        {!! Form::number('amount[' . $category->id . ']', 'value', ['class' => 'form-control', 'placeholder' => trans('campaign.amount')]) !!}

                                        @if ($errors->has('amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('campaign.description')]) !!}

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-1">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('campaign.create_contribute') }}
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
