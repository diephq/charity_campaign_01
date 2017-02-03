@extends('layouts.app')

@section('js')
    @parent
    {{ Html::script('js/active_campaign.js') }}
    <script type="text/javascript">
        $( document ).ready(function() {
            var active = new Active(
                '{{ trans('campaign.active') }}',
                '{{ trans('campaign.close') }}',
                '{{ action('CampaignController@activeOrCloseCampaign') }}',
                '{{ trans('campaign.message_confirm') }}'
            );
            active.init();
        });
    </script>
@stop

@section('content')
    <div id="page-content">
        <div class="row">
            @include('user.profile')
            <div class="col-md-9 center-panel">
                @if ($campaigns->count())
                <div class="block">
                    <div class="block-title themed-background-dark">
                        <h2 class="block-title-light campaign-title">{{ trans('user.your_campaign') }}</h2>
                    </div>

                        <table class="table table-hover table-responsive table-custome">
                            <tr>
                                <th>{{ trans('campaign.index') }}</th>
                                <th>{{ trans('campaign.name') }}</th>
                                <th>{{ trans('campaign.address') }}</th>
                                <th>{{ trans('campaign.start_date') }}</th>
                                <th>{{ trans('campaign.end_date') }}</th>
                                <th>{{ trans('campaign.status') }}</th>
                                <th>{{ trans('campaign.action') }}</th>
                            </tr>
                            <tbody>
                            @foreach ($campaigns as $key => $campaign)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="{{ action('UserController@manageCampaign', ['userId' => $user->id, 'campaignId' => $campaign->id]) }}">{{ $campaign->name }}</a></td>
                                    <td>{{ $campaign->address }}</td>
                                    <td>{{{ date('Y-m-d', strtotime($campaign->start_time)) }}}</td>
                                    <td>{{{ date('Y-m-d', strtotime($campaign->end_time)) }}}</td>
                                    <td>
                                        @if ($campaign->status)
                                            <span class="badge label-primary">{{ trans('campaign.active') }}</span>
                                        @else
                                            <span class="badge label-warning-custom">{{ trans('campaign.close') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div data-campaign-id="{{ $campaign->id }}">
                                            @if (!$campaign->status)
                                                {!! Form::submit(trans('campaign.active'), ['class' => 'btn active btn-default active-campaign']) !!}
                                            @else
                                                {!! Form::submit(trans('campaign.close'), ['class' => 'btn active btn-default active-campaign']) !!}
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{ $campaigns->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
