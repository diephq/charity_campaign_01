@extends('layouts.app')

@section('content')
    <div id="page-content">
        <div class="hide" data-token="{{ csrf_token() }}"></div>
            <div class="row">
                <div class="col-md-8 center-panel">
                    @foreach ($campaigns as $campaign)
                    <div class="block">
                        <div class="block-title themed-background-dark">
                            <h2 class="block-title-light campaign-title"><a href="{{ action('CampaignController@show', ['id' => $campaign->id]) }}"><strong>{{{ $campaign->name }}}</strong></a></h2>
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
                                                <div class="col-sm-8 col-md-8">
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
                                                    <div class="col-sm-6 col-md-6">
                                                        <a href="{{ $campaign->owner->user->avatar }}"
                                                           data-toggle="lightbox-image" class="profile_thumb">
                                                            <img src="{{ $campaign->owner->user->avatar }}"
                                                                class="img-responsive img-circle" alt="image">
                                                        </a>
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
                                        <a href="javascript:void(0)" class="comment" data-toggle="tooltip" title="" data-original-title="Comments">
                                            <i class="gi gi-comments"></i>
                                            <span>{{ $campaign->countComment($campaign->id) }}</span>
                                        </a>
                                    </div>
                                    <div class="timeline-controls-item">
                                        <a href="javascript:void(0)" class="facebook" data-toggle="tooltip" title="" data-original-title="Share facebook">
                                            <i class="fa fa-facebook-square"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{ $campaigns->render() }}
                </div>
            </div>
        </div>
    </div>
@stop
