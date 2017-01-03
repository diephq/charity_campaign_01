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
    {{ Html::script('js/page/tablesDatatables.js') }}

    <script type="text/javascript">
        $( document ).ready(function() {
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
                    <!-- Timeline Title -->
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
                        <h2 class="block-title-light campaign-title"><strong>{{{ $campaign->name }}}</strong></h2>
                    </div>
                    <!-- END Timeline Title -->

                    <!-- Timeline Content -->
                    <div class="block-content-full">
                        <div class="timeline">
                            <ul class="timeline-list">
                                <li class="active">
                                    <div class="timeline-icon"><i class="gi gi-calendar"></i></div>
                                    <div class="timeline-time"><small>{{ trans('campaign.start_date') }}</small></div>
                                    <div class="timeline-content">
                                        <p class="push-bit"><strong>{{{ $campaign->start_time }}}</strong></p>
                                        <div class="row push">
                                            <div class="col-sm-6 col-md-4">
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
                                    </div>
                                </li>
                                <li class="active">
                                    <div class="timeline-icon"><i class="fa fa-smile-o"></i></div>
                                    <div class="timeline-time"><small>{{{ trans('campaign.author') }}}</small></div>
                                    <div class="timeline-content">
                                        <p class="push-bit"><a href="{{ action('UserController@show', ['id' => $campaign->owner->user->id]) }}"><strong>{{ $campaign->owner->user->name }}</strong></a></p>
                                        <div class="row push">
                                            <div class="col-sm-2 col-md-2">
                                                <a href="{{ $campaign->owner->user->avatar }}" data-toggle="lightbox-image">
                                                    <img src="{{ $campaign->owner->user->avatar }}" class="img-circle" alt="image">
                                                </a>
                                                @if (Auth::user())
                                                    {!! Form::hidden('target_id', $campaign->owner->user->id, ['id' => 'target_id']) !!}
                                                    <input id="allow-rating-user" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" data-size="xs">
                                                @else
                                                    <input id="not-allow-rating-user" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" data-size="xs">
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
                                    <div class="timeline-time"><small>{{ trans('campaign.address') }}</small></div>
                                    <div class="timeline-content">
                                        <p class="push-bit"><a href="#"><strong>{{{ $campaign->address }}}</strong></a></p>
                                        <div id="gmap-timeline-ID" class="gmap gmap-timeline"
                                             data-lat="{{ $campaign->lat }}" data-lng="{{ $campaign->lng }}"
                                             data-address="{{ $campaign->address }}"></div>
                                    </div>
                                </li>
                                <li class="active">
                                    <div class="timeline-icon"><i class="gi gi-suitcase"></i></div>
                                    <div class="timeline-time"><small>{{ trans('campaign.description') }}</small></div>
                                    <div class="timeline-content">
                                        <p class="push-bit"><strong>{{ trans('campaign.description') }}</strong></p>
                                        <p class="push-bit">{!! $campaign->description !!}</p>
                                    </div>
                                </li>
                                <li class="active">
                                    <div class="timeline-icon"><i class="gi gi-calendar"></i></div>
                                    <div class="timeline-time"><small>{{ trans('campaign.end_date') }}</small></div>
                                    <div class="timeline-content">
                                        <p class="push-bit"><a href="#"><strong>{{ $campaign->end_time }}</strong></a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <hr>
                        @include('campaign.comment')
                    </div>
                    <!-- END Timeline Content -->
                </div>
            </div>

            <div class="col-md-4 right-panel">
                <div class="widget">
                    <div class="widget-extra themed-background-dark">
                        <h3 class="widget-content-light">
                            <strong>{{ trans('campaign.value') }}</strong>
                        </h3>
                    </div>
                    <div class="widget-extra">
                        <!-- Timeline Content -->
                        <div class="timeline">
                            <ul class="">
                                @foreach ($results as $result)
                                    <li class="media event active">
                                        <div class="pull-left">
                                            <span>
                                                <strong>{{ $result['name'] }}</strong> :
                                                <span>{{ $result['value'] }}</span>
                                            </span>
                                        </div>
                                    </li>

                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success progress-bar-striped  active" role="progressbar"
                                             aria-valuenow="{{ $result['progress'] }}"
                                             aria-valuemin="0" aria-valuemax="100" style="width:{{ $result['progress'] }}%">
                                            <span class="show">{{ $result['progress'] }} %</span>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                        <!-- END Timeline Content -->
                    </div>

                    <div class="widget-extra themed-background-dark">
                        <h3 class="widget-content-light">
                            <strong>{{ trans('campaign.contributors') }}</strong>
                        </h3>
                    </div>
                    <br>
                    <!-- Timeline Content -->
                    <div class="timeline">
                        <ul class="timeline-list">
                            @foreach ($campaign->contributions as $contribution)
                                <li class="media event active">
                                    @if ($contribution->user)
                                        <div class="timeline-icon"><i class="fa fa-smile-o"></i></div>
                                        <a class="pull-left border-aero profile_thumb">
                                            <img src="{{ $contribution->user->avatar }}" class="img-circle" alt="" >
                                        </a>
                                        <div class="timeline-content">
                                            <a class="title" href="{{ action('UserController@show', ['id' => $contribution->user->id    ]) }}">
                                                {{ $contribution->user->name }}
                                            </a>
                                            <p>{{ $contribution->user->email }}</p>
                                            <p>{{ $contribution->created_at }}</p>
                                        </div>
                                    @else
                                        <div class="timeline-icon"><i class="fa fa-smile-o"></i></div>
                                        <a class="pull-left border-aero profile_thumb">
                                            <img src="{{ config('path.to_avatar_default') }}" class="img-circle" alt="" >
                                        </a>
                                        <div class="timeline-content">
                                            <p>{{ $contribution->name }}</p>
                                            <p>{{ $contribution->email }}</p>
                                            <p>{{ $contribution->created_at }}</p>
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
                    <!-- END Timeline Content -->
                </div>
            </div>
        </div>
    </div>

    @include('campaign.create_contribution')
    @include('campaign.list_contribution')

@stop
