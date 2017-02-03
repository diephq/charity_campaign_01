@extends('layouts.app')

@section('content')
    <div id="page-content">
        <div class="hide" data-token="{{ csrf_token() }}"></div>
        <div class="row">
            @include('user.profile')

            <div class="col col-md-9 center-panel">
                <div class="profile-content">
                    <div class="block">
                        <ul class="nav nav-tabs border-tab">
                            <li class="active"><a data-toggle="tab">{{ trans('campaign.activities') }}</a></li>
                        </ul>
                        <br>
                        <div class="profile-content">
                            @foreach ($actions as $action)
                                @if ($action->action_type == config('constants.ACTION.ACTIVE_CAMPAIGN'))
                                    @php ($message = trans('campaign.action_active_campaign'))
                                    @php ($campaign = $action->actionable->campaign($action->actionable->id))
                                @elseif ($action->action_type == config('constants.ACTION.CONTRIBUTE'))
                                    @php ($message = trans('campaign.action_contribute_campaign'))
                                    @php ($campaign = $action->actionable->campaign($action->actionable->campaign_id))
                                @endif

                                <div class="block">
                                    <div class="block-content-full">
                                        <div class="tag-item" style="padding: 15px">
                                            <p>
                                                @if ($action->action_type == config('constants.ACTION.ACTIVE_CAMPAIGN'))
                                                    <span class="glyphicon glyphicon-eye-open"></span>
                                                    @if (auth()->id() == $action->user_id)
                                                        <i>{{ trans('user.you') . ' ' . $message }}</i>
                                                    @else
                                                        <i>{{ $action->user($action->user_id)->name . ' ' . $message }}</i>
                                                    @endif
                                                @else
                                                    <span class="glyphicon glyphicon-heart"></span>
                                                    @if (auth()->id() == $action->user_id)
                                                        <i>{{ trans('user.you') . ' ' . $message }}</i>
                                                    @else
                                                        <i>{{ $action->user($action->user_id)->name . ' ' . $message }}</i>
                                                    @endif
                                                @endif
                                                <span class="pull-right"><i>{{  Carbon\Carbon::now()->subSeconds(time() - $action->time)->diffForHumans() }}</i></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="block-title themed-background-dark">
                                        <h2 class="block-title-light campaign-title">
                                            <a href="{{ action('CampaignController@show', ['id' => $campaign->id]) }}">{{{ $campaign->name }}}</a>
                                        </h2>
                                    </div>

                                    @if ($action->action_type == config('constants.ACTION.ACTIVE_CAMPAIGN'))
                                        <div class="block-content-full">
                                            <div class="timeline">
                                                <ul class="timeline-list">
                                                    <li class="active">
                                                        <div class="timeline-icon"><i class="gi gi-calendar"></i></div>
                                                        <div class="timeline-time">
                                                            <small>{{ trans('campaign.start_date') }}</small>
                                                        </div>
                                                        <div class="timeline-content">
                                                            <p class="push-bit"><strong>{{{ date('Y-m-d', strtotime($campaign->start_time)) }}}</strong></p>
                                                            <div class="row push">
                                                                <div class="col-sm-4 col-md-4">
                                                                    <a href="{{ $campaign->image->image }}" data-toggle="lightbox-image">
                                                                        <img src="{{ $campaign->image->image }}" alt="image">
                                                                    </a>
                                                                </div>
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
                                                                <div class="col-sm-6 col-md-6 profile_thumb">
                                                                    <a href="{{ action('UserController@show', ['id' => $campaign->owner->user->id]) }}">
                                                                        <img src="{{ $campaign->owner->user->avatar }}"
                                                                             class="img-responsive img-circle" alt="image">
                                                                    </a>
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
                                                            <p class="push-bit">
                                                                <strong>{{{ $campaign->address }}}</strong>
                                                            </p>
                                                        </div>
                                                    </li>

                                                    <li class="active">
                                                        <div class="timeline-icon"><i class="gi gi-calendar"></i></div>
                                                        <div class="timeline-time">
                                                            <small>{{ trans('campaign.end_date') }}</small>
                                                        </div>
                                                        <div class="timeline-content">
                                                            <p class="push-bit"><strong>{{{ date('Y-m-d', strtotime($campaign->end_time)) }}}</strong></p>
                                                            <p>
                                                                <span>{{ trans('campaign.message_end_campaign', ['time' => Carbon\Carbon::now()->addSeconds(strtotime($campaign->end_time) - time())->diffForHumans()]) }}</span>
                                                            </p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="timeline-controls">
                                                <div class="timeline-controls-list">
                                                    <div class="timeline-controls-item">
                                                        <a href="javascript:void(0)" class="comment" data-toggle="tooltip" title="" data-original-title="{{ trans('campaign.comments') }}">
                                                            <i class="gi gi-comments"></i>
                                                            <span>{{ $campaign->countComment($campaign->id) }}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="block-content-full">
                                            <div class="timeline">
                                                <ul class="timeline-list">
                                                    <li class="active">
                                                        <div class="timeline-icon"><i class="glyphicon glyphicon-heart"></i></div>
                                                        <div class="timeline-time">
                                                            <small>{{ trans('campaign.list_contribution') }}</small>
                                                        </div>
                                                        <div class="timeline-content">
                                                            @php($contributions = $action->actionable->contribution($action->actionable->id))
                                                            @foreach ($contributions as $contribution)
                                                                <div class="row push">
                                                                    <div class="col-sm-4 col-md-4">
                                                                <span><strong>{{ $contribution->category->name }}</strong> :
                                                                    {{ $contribution->amount }}  ({{ $contribution->category->unit }})</span><br>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    </li>
                                                    <li class="active">
                                                        <div class="timeline-icon"><i class="glyphicon glyphicon-pencil"></i></div>
                                                        <div class="timeline-time">
                                                            <small>{{ trans('campaign.description') }}</small>
                                                        </div>
                                                        <div class="timeline-content">
                                                            <p class="push-bit">{!! $contribution->contribution->description !!}</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="timeline-controls">
                                                <div class="timeline-controls-list">
                                                    <div class="timeline-controls-item">
                                                        <a href="javascript:void(0)" class="comment" data-toggle="tooltip" title="" data-original-title="{{ trans('campaign.comments') }}">
                                                            <i class="gi gi-comments"></i>
                                                            <span>{{ $campaign->countComment($campaign->id) }}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            @endforeach
                            {{ $actions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
