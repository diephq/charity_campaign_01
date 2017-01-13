@extends('layouts.app')

@section('content')
    <div id="page-content">
        <div class="hide" data-token="{{ csrf_token() }}"></div>
        <div class="row">
            @include('user.profile')

            <div class="col-md-9 center-panel">
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
                                            <span class="glyphicon glyphicon-plus"></span>
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
                                    @if ($campaign->status)
                                    <a href="{{ action('CampaignController@show', ['id' => $campaign->id]) }}">{{{ $campaign->name }}}</a>
                                    @else
                                    <p><strong>{{{ $campaign->name }}}</strong></p>
                                    @endif
                                </h2>
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
                                                    <div class="col-sm-6 col-md-6">
                                                        <a href="{{ $campaign->owner->user->avatar }}"
                                                           data-toggle="lightbox-image" class="profile_thumb">
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
                                                    <a href="#"><strong>{{{ $campaign->address }}}</strong></a>
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
                                        <div class="timeline-controls-item">
                                            <a href="javascript:void(0)" class="facebook" data-toggle="tooltip" title="" data-original-title="{{ trans('campaign.share_facebook') }}">
                                                <i class="fa fa-facebook-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $actions->links() }}
                </div>
            </div>
            
            <div class="col-md-3 center-panel">
                <div class="profile-content">

                </div>
            </div>
        </div>
    </div>
@stop
