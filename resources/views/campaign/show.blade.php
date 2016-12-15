@extends('layouts.app')

@section('js')
    @parent
    {{ Html::script('js/comment.js') }}
    <script type="text/javascript">
        $( document ).ready(function() {
            var comment = new Comment('{{ action('CommentController@store') }}',
                    '{{ config('path.to_avatar_default') }}',
                    '{{ action('CampaignController@joinOrLeaveCampaign') }}',
                    '{{ trans('campaign.request_sent') }}',
                    '{{ trans('campaign.request_join') }}'
            );
            comment.init();
        });
    </script>
@stop

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

                                <div class="request-join">
                                    @if (Auth::user())
                                    {!! Form::open(['method' => 'POST', 'id' => 'formRequest']) !!}
                                    {!! Form::hidden('campaign_id', $campaign->id) !!}
                                        @if (empty($userCampaign))
                                            {!! Form::submit(trans('campaign.request_join'), ['class' => 'btn btn-success joinOrLeave']) !!}
                                        @elseif (empty($userCampaign->status) && empty($userCampaign->is_owner))
                                            {!! Form::submit(trans('campaign.request_sent'), ['class' => 'btn btn-success joinOrLeave']) !!}
                                        @elseif ($userCampaign->status && empty($userCampaign->is_owner))
                                            {!! Form::submit(trans('campaign.leave_campaign'), ['class' => 'btn btn-success joinOrLeave']) !!}
                                        @endif
                                    {!! Form::close() !!}
                                    @else
                                        <a href="{{ action('Auth\UserLoginController@getLogin') }}" class="btn btn-success join">{{ trans('campaign.request_join') }}</a>
                                    @endif
                                </div>

                                <div>
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
                        <hr>
                        @include('campaign.comment')
                    </div>
                </div>

                <div class="col-xs-12  col-md-4 total">
                    <div class="widget-author  boxed  push-down-30">
                        <div class="row">
                            <div class="col-xs-10  col-xs-offset-1">
                                <div class="x_title">
                                    <h2>{{ trans('campaign.value') }}</h2>
                                    <hr>
                                </div>
                                <ul class="list-unstyled top_profiles scroll-view">
                                    @foreach ($results as $key => $result)
                                        <li class="media event">
                                            <div class="pull-left">
                                                <span>
                                                    <strong>{{ $result->category->name }}</strong> :
                                                    <strong>{{ $result->amount }}</strong>
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
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
                                    <hr>
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
                                    <a href=".list_contribute" data-toggle="modal" data-target=".list_contribute">{{ trans('campaign.show_more') }}</a>
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
