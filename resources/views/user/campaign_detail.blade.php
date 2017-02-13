@extends('layouts.app')

@section('js')
    @parent
    {{ Html::script('js/user_campaign.js') }}
    <script type="text/javascript">
        $( document ).ready(function() {
            var approve = new Approve(
                '{{ action('CampaignController@approveOrRemove') }}',
                '{{ trans('campaign.approve') }}',
                '{{ trans('campaign.remove') }}',
                '{{ action('ContributionController@confirmContribution') }}',
                '{{ trans('campaign.confirm') }}',
                '{{ trans('campaign.message_confirm') }}',
                '{{ trans('user.request_status.joined') }}',
                '{{ trans('user.request_status.waiting') }}',
                '{{ trans('campaign.confirmed') }}',
                '{{ trans('campaign.waiting') }}'
            );
            approve.init();
        });
    </script>
@stop

@section('content')
    <div id="page-content">
        <div class="row">
        <div class="hide" data-token="{{ csrf_token() }}"></div>
            @include('user.profile')

            <div class="col-md-9 center-panel">
                <div class="block">
                    <div class="content-header content-header-media">
                        <div class="header-section">
                            <h1>
                                <a href="{{ action('CampaignController@show', ['id' => $campaign->id]) }}">
                                    <span class="campaign-name-custom">{{ $campaign->name }}</span>
                                </a>
                            </h1>
                            <span><i class="glyphicon glyphicon-map-marker"></i> {{ $campaign->address }}</span><br>
                            <span><i class="glyphicon glyphicon-calendar"></i> {{ date('Y-m-d', strtotime($campaign->start_time))}}</span><br>
                            <span><i class="glyphicon glyphicon-calendar"></i> {{ date('Y-m-d', strtotime($campaign->start_time)) }}</span>
                        </div>

                        <img src="{{ $campaign->image->image }}" alt="header image">
                    </div>
                </div>

                @if ($campaignUsers->count())
                <div class="block">
                    <div class="block-title themed-background-dark">
                        <h2 class="block-title-light campaign-title"><strong>{{ trans('campaign.members') }}</strong></h2>
                    </div>

                    <table class="table table-hover table-responsive table-custome">
                        <tr>
                            <th>{{ trans('campaign.index') }}</th>
                            <th>{{ trans('user.avatar') }}</th>
                            <th>{{ trans('user.name') }}</th>
                            <th>{{ trans('user.email') }}</th>
                            <th>{{ trans('user.status') }}</th>
                            <th>{{ trans('campaign.action') }}</th>
                        </tr>
                        <tbody>
                        @foreach ($campaignUsers as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <div class="profile_thumb">
                                        <a href="{{ action('UserController@show', ['id' => $contribution->user->id]) }}">
                                            <img src="{{ $user->avatar }}" alt="avatar" class="img-responsive img-circle">
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="profile_thumb">
                                        <a href="{{ action('UserController@show', ['id' => $contribution->user->id]) }}">
                                            <p>{{ $user->name }}</p>
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->userCampaign->status)
                                        <span class="badge label-primary">{{ trans('user.request_status.joined') }}</span>
                                    @else
                                        <span class="badge label-warning-custom">{{ trans('user.request_status.waiting') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                    @if (!$user->userCampaign->status)
                                        <div data-campaign-id="{{ $campaign->id }}" data-user-id="{{ $user->id }}">
                                            {!! Form::submit(trans('campaign.approve'), ['class' => 'btn active btn-default approve']) !!}
                                        </div>
                                    @else
                                        <div data-campaign-id="{{ $campaign->id }}" data-user-id="{{ $user->id }}">
                                            {!! Form::submit(trans('campaign.remove'), ['class' => 'btn active btn-default approve']) !!}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $campaignUsers->links() }}
                </div>
                @endif

                @if ($contributions->count())
                <div class="block">
                    <div class="block-title themed-background-dark">
                        <h2 class="block-title-light campaign-title"><strong>{{ trans('campaign.contribute') }}</strong></h2>
                    </div>

                    <table class="table table-hover table-responsive table-custome">
                        <tr>
                            <th>{{ trans('campaign.contribution.index') }}</th>
                            <th>{{ trans('campaign.contribution.avatar') }}</th>
                            <th>{{ trans('campaign.contribution.name') }}</th>
                            <th>{{ trans('campaign.contribution.email') }}</th>
                            <th>{{ trans('campaign.contribute') }}</th>
                            <th>{{ trans('campaign.contribution.description') }}</th>
                            <th>{{ trans('campaign.contribution.status') }}</th>
                            <th>{{ trans('campaign.action') }}</th>
                        </tr>
                        <tbody>
                        @foreach ($contributions as $key => $contribution)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                @if ($contribution->user)
                                    <td>
                                        <div class="profile_thumb">
                                            <a href="{{ action('UserController@show', ['id' => $contribution->user->id]) }}">
                                                <img src="{{ $contribution->user->avatar }}" alt="avatar" class=" img-circle">
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="profile_thumb">
                                            <a href="{{ action('UserController@show', ['id' => $contribution->user->id]) }}">
                                               <p>{{ $contribution->user->name }}</p>
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $contribution->user->email }}</td>
                                @else
                                    <td>
                                        <div class="profile_thumb">
                                            <img src="{{ config('path.to_avatar_default') }}"  alt="avatar" class=" img-circle">
                                        </div>
                                    </td>
                                    <td>{{ $contribution->name }}</td>
                                    <td>{{ $contribution->email }}</td>
                                @endif

                                <td>
                                    @foreach ($contribution->categoryContributions as $value)
                                        <span>{{ $value->category->name }} : <small>{{ $value->amount }}</small></span>
                                        <br>
                                    @endforeach
                                </td>
                                <td>{{ $contribution->description }}</td>
                                <td>
                                    @if ($contribution->status)
                                        <span class="badge label-primary">{{ trans('campaign.confirmed') }}</span>
                                    @else
                                        <span class="badge label-warning-custom">{{ trans('campaign.waiting') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div data-contribution-id="{{ $contribution->id }}">
                                    @if (!$contribution->status)
                                        {!! Form::submit(trans('campaign.confirm'), ['class' => 'btn active btn-default confirm']) !!}
                                    @else
                                        {!! Form::submit(trans('campaign.remove'), ['class' => 'btn active btn-default confirm']) !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $contributions->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
@stop
