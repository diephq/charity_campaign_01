@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row profile">

            @include('user.profile')

            <div class="col-md-9">
                <div class="profile-content">
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>{{ trans('campaign.index') }}</th>
                            <th>{{ trans('campaign.name') }}</th>
                            <th>{{ trans('campaign.address') }}</th>
                            <th>{{ trans('campaign.start_date') }}</th>
                            <th>{{ trans('campaign.end_date') }}</th>
                            <th>{{ trans('campaign.status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($campaigns as $key => $campaign)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ action('UserController@manageCampaign', ['userId' => $user->id, 'campaignId' => $campaign->id]) }}">{{ $campaign->name }}</a></td>
                                <td>{{ $campaign->address }}</td>
                                <td>{{ $campaign->start_time }}</td>
                                <td>{{ $campaign->end_time }}</td>
                                <td>
                                    @if ($campaign->status)
                                        {{ trans('campaign.activated') }}
                                    @else
                                        {{ trans('campaign.not_active') }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $campaigns->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
