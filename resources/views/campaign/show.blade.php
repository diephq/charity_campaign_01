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
                                    {{ Form::button(trans('campaign.contribute'), [
                                        'class' => 'btn btn-success',
                                        'data-toggle'=>'modal',
                                        'data-target'=>'.contribute'
                                    ]) }}

                                    {{ Form::button(trans('campaign.show_more'), [
                                        'class' => 'btn btn-success',
                                        'data-toggle'=>'modal',
                                        'data-target'=>'.list_contribute'
                                    ]) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('campaign.create_contribution')
    @include('campaign.list_contribution')

@stop
