@extends('layouts.app')

@section('css')
    @parent
    {{ Html::style('bower_components/bootstrap-star-rating/css/star-rating.css') }}
    {{ Html::style('bower_components/bootstrap-star-rating/css/theme-krajee-fa.css') }}
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/css/bootstrap-dialog.min.css') }}
    {{ Html::style('https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css') }}
@stop

@section('js')
    @parent
    {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/js/bootstrap-dialog.min.js') }}
    {{ Html::script('bower_components/bootstrap-star-rating/js/star-rating.js') }}
    {{ Html::script('https://www.gstatic.com/charts/loader.js') }}
    {{ Html::script('js/comment.js') }}
    {{ Html::script('js/rating.js') }}
    {{ Html::script('js/contribute.js') }}
    {{ Html::script('http://maps.google.com/maps/api/js?sensor=true') }}
    {{ Html::script('js/helpers/gmaps.min.js') }}
    <script type="text/javascript">
        $(document).ready(function () {
            Dashboard.init();

            var comment = new Comment('{{ action('CommentController@store') }}',
                    '{{ config('path.to_avatar_default') }}',
                    '{{ action('CampaignController@joinOrLeaveCampaign') }}',
                    '{{ trans('campaign.request_sent') }}',
                    '{{ trans('campaign.request_join') }}'
            );
            comment.init();

            var rating = new Rating(
                    '{{ action('RatingController@ratingCampaign') }}',
                    '{{ trans('campaign.must_join_campaign') }}',
                    '{{ trans('campaign.close') }}',
                    '{{ $averageRanking['average'] }}',
                    '{{ action('RatingController@ratingUser') }}',
                    '{{ trans('campaign.must_login') }}',
                    '{{ $averageRankingUser['average'] }}',
                    {!! $ratingChart !!},
                    '{{ trans('campaign.star') }}',
                    '{{ config('constants.ONE_STAR') }}',
                    '{{ config('constants.TWO_STAR') }}',
                    '{{ config('constants.THREE_STAR') }}',
                    '{{ config('constants.FOUR_STAR') }}',
                    '{{ config('constants.FIVE_STAR') }}',
                    '{{ trans('campaign.rating') }}'
            );
            rating.init();

            var contribute = new Contribute('{{ action('ContributionController@store') }}');
            contribute.init();
        });
    </script>
@stop

@section('content')
    <div id="page-content">
        <div class="hide" data-token="{{ csrf_token() }}"></div>
        <div class="row">
            <div class="col-md-8 center-panel">
                <div class="block">
                    <div class="block-title themed-background-dark">
                        <h2 class="block-title-light campaign-title"><strong>{{{ $campaign->name }}}</strong></h2>
                    </div>
                    <div class="block-content-full">
                        <div class="timeline">
                            <ul class="timeline-list">
                                <li class="active">
                                    <div class="timeline-icon"><i class="gi gi-calendar"></i></div>
                                    <div class="timeline-time">
                                        <small>{{ trans('campaign.start_date') }}</small>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="push-bit"><strong>{{{ $campaign->start_time }}}</strong></p>
                                        <div class="row push">
                                            <div class="col-sm-8 col-md-8">
                                                <a href="{{ $campaign->image->image }}" data-toggle="lightbox-image">
                                                    <img src="{{ $campaign->image->image }}" alt="image">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="right request-join">
                                            @if (Auth::user())
                                                {!! Form::open(['method' => 'POST', 'id' => 'formRequest']) !!}
                                                {!! Form::hidden('campaign_id', $campaign->id) !!}
                                                @if (empty($userCampaign))
                                                    {!! Form::submit(trans('campaign.request_join'), ['class' => 'btn btn-sm btn-success joinOrLeave']) !!}
                                                @elseif (empty($userCampaign->status) && empty($userCampaign->is_owner))
                                                    {!! Form::submit(trans('campaign.request_sent'), ['class' => 'btn btn-sm btn-success joinOrLeave']) !!}
                                                @elseif ($userCampaign->status && empty($userCampaign->is_owner))
                                                    {!! Form::submit(trans('campaign.leave_campaign'), ['class' => 'btn btn-sm btn-success joinOrLeave']) !!}
                                                @endif
                                                {!! Form::close() !!}
                                            @else
                                                <a href="{{ action('Auth\UserLoginController@getLogin') }}"
                                                   class="btn btn-sm btn-success join">{{ trans('campaign.request_join') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li class="active">
                                    <div class="timeline-icon"><i class="fa fa-smile-o"></i></div>
                                    <div class="timeline-time">
                                        <small>{{{ trans('campaign.author') }}}</small>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="push-bit">
                                            <a href="{{ action('UserController@show', ['id' => $campaign->owner->user->id]) }}"><strong>{{ $campaign->owner->user->name }}</strong></a>
                                        </p>
                                        <div class="row push">
                                            <div class="col-sm-6 col-md-6">
                                                <a href="{{ $campaign->owner->user->avatar }}"
                                                   data-toggle="lightbox-image" class="profile_thumb">
                                                    <img src="{{ $campaign->owner->user->avatar }}"
                                                         class="img-responsive img-circle" alt="image">
                                                </a>
                                                @if (Auth::user())
                                                    {!! Form::hidden('target_id', $campaign->owner->user->id, ['id' => 'target_id']) !!}
                                                    <input id="allow-rating-user" name="input-1"
                                                        class="rating rating-loading" data-min="0" data-max="5"
                                                        data-step="1" data-size="xs">
                                                @else
                                                    <input id="not-allow-rating-user" name="input-1"
                                                        class="rating rating-loading" data-min="0" data-max="5"
                                                        data-step="1" data-size="xs">
                                                @endif
                                                <div class="reviews-stats"> {{ trans('campaign.total') }}
                                                    <span class="glyphicon glyphicon-user"></span>
                                                    <span class="reviews-num-user">{{ $averageRankingUser['amount'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="active">
                                    <div class="timeline-icon"><i class="fa fa-map-marker"></i></div>
                                    <div class="timeline-time">
                                        <small>{{ trans('campaign.address') }}</small>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="push-bit"><a href="#"><strong>{{{ $campaign->address }}}</strong></a>
                                        </p>
                                        <div id="gmap-timeline-ID" class="gmap gmap-timeline"
                                             data-lat="{{ $campaign->lat }}" data-lng="{{ $campaign->lng }}"
                                             data-address="{{ $campaign->address }}"></div>
                                    </div>
                                </li>
                                <li class="active">
                                    <div class="timeline-icon"><i class="gi gi-suitcase"></i></div>
                                    <div class="timeline-time">
                                        <small>{{ trans('campaign.description') }}</small>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="push-bit"><strong>{{ trans('campaign.description') }}</strong></p>
                                        <p class="push-bit">{!! $campaign->description !!}</p>
                                    </div>
                                </li>
                                <li class="active">
                                    <div class="timeline-icon"><i class="gi gi-calendar"></i></div>
                                    <div class="timeline-time">
                                        <small>{{ trans('campaign.end_date') }}</small>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="push-bit"><strong>{{ $campaign->end_time }}</strong></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <hr>
                        @include('campaign.comment')
                    </div>
                </div>
            </div>

            <div class="col-md-4 right-panel">
                <div class="widget">
                    <div class="widget-extra themed-background-dark">
                        <h4 class="block-title-light campaign-title">
                            <strong>{{ trans('campaign.value') }}</strong>
                        </h4>
                    </div>
                    <div class="widget-extra">
                        <div class="timeline">
                            <ul class="">
                                @foreach ($results as $result)
                                    <li class="media event active">
                                        <div class="pull-left">
                                            <span>
                                                <strong>{{ $result['name'] }}</strong> :
                                                <span>{{ $result['value'] }}</span>
                                                <strong>{{ $result['unit'] }}</strong>
                                            </span>
                                        </div>
                                        <div class="pull-right">
                                            <strong>{{ trans('campaign.goal') }}</strong> :
                                            <span>{{ $result['goal'] }}</span>
                                            <strong>{{ $result['unit'] }}</strong>
                                        </div>
                                    </li>

                                    <div class="progress">
                                        @if ($result['progress'] < 100)
                                            <div class="progress-bar progress-bar-success progress-bar-striped  active"
                                                role="progressbar"
                                                aria-valuenow="{{ $result['progress'] }}"
                                                aria-valuemin="0" aria-valuemax="100"
                                                style="width:{{ $result['progress'] }}%">
                                                <span class="show">{{ $result['progress'] }} %</span>
                                            </div>
                                        @else
                                            <div class="progress-bar progress-bar-success progress-bar-striped  active"
                                                role="progressbar"
                                                style="width:{{ round(100 / $result['progress'] * 100) }}%">
                                                <span class="show">100%</span>
                                            </div>
                                            <div class="progress-bar progress-bar-warning progress-bar-striped  active"
                                                 style="width:{{ 100 - round(100 / $result['progress'] * 100) }}%">
                                                <span class="show">{{ $result['progress'] - 100 }}%</span>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="widget">
                    <div class="widget-extra themed-background-dark">
                        <h4 class="widget-content-light">
                            <strong>{{ trans('campaign.contributors') }}</strong>
                        </h4>
                    </div>

                    <div class="widget-extra active-user">
                        <ul class="active-user-list">
                            @foreach ($campaign->contributions as $contribution)
                                <li class="active-user-item">
                                    <div class="row">
                                        @if ($contribution->user)
                                            <div class="col-md-4">
                                                <a class="pull-left border-aero profile_thumb">
                                                    <img src="{{ $contribution->user->avatar }}" alt="avatar"
                                                        class="img-responsive img-circle">
                                                </a>
                                            </div>
                                            <div class="col-md-8 active-user-item-info">
                                                <a class="title" href="{{ action('UserController@show', ['id' => $contribution->user->id]) }}">
                                                    {{ $contribution->user->name }}
                                                </a><br>
                                                <span>{{ $contribution->user->email }}</span><br>
                                                <span>{{ $contribution->created_at }}</span>
                                            </div>
                                        @else
                                            <div class="col-md-4">
                                                <a class="pull-left border-aero profile_thumb">
                                                    <img src="{{ config('path.to_avatar_default') }}" alt="avatar"
                                                        class="img-responsive img-circle">
                                                </a>
                                            </div>
                                            <div class="col-md-8 active-user-item-info">
                                                <span>{{ $contribution->name }}</span><br>
                                                <span>{{ $contribution->email }}</span><br>
                                                <span>{{ $contribution->created_at }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="contribution">
                            {{ Form::button(trans('campaign.contribute'), [
                                'class' => 'btn btn-sm btn-success',
                                'data-toggle'=>'modal',
                                'data-target'=>'.contribute'
                            ]) }}
                            <a href=".list_contribute" data-toggle="modal"
                               data-target=".list_contribute">{{ trans('campaign.show_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('campaign.create_contribution')
    @include('campaign.list_contribution')
@stop
