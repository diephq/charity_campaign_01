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
                '{{ trans('campaign.message_confirm') }}'
            );
            approve.init();
        });
    </script>
@stop

@section('content')
    <div class="container">
        <div class="hide" data-token="{{ csrf_token() }}"></div>
        <div class="row profile">

            @include('user.profile')

            <div class="col-md-9">
                <div class="profile-content">
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>{{ trans('campaign.index') }}</th>
                            <th>{{ trans('user.avatar') }}</th>
                            <th>{{ trans('user.name') }}</th>
                            <th>{{ trans('user.email') }}</th>
                            <th>{{ trans('user.status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($campaignUsers as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ $user->avatar }}" alt=""></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if (!$user->userCampaign->status)
                                        <div data-campaign-id="{{ $campaign->id }}" data-user-id="{{ $user->id }}">
                                            {!! Form::submit(trans('campaign.approve'), ['class' => 'btn btn-success approve']) !!}
                                        </div>
                                    @else
                                        <div data-campaign-id="{{ $campaign->id }}" data-user-id="{{ $user->id }}">
                                            {!! Form::submit(trans('campaign.remove'), ['class' => 'btn btn-success approve']) !!}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $campaignUsers->links() }}
                </div>

                <div class="profile-content">
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>{{ trans('campaign.contribution.index') }}</th>
                            <th>{{ trans('campaign.contribution.avatar') }}</th>
                            <th>{{ trans('campaign.contribution.name') }}</th>
                            <th>{{ trans('campaign.contribution.email') }}</th>
                            <th>{{ trans('campaign.contribute') }}</th>
                            <th>{{ trans('campaign.contribution.description') }}</th>
                            <th>{{ trans('campaign.contribution.status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($contributions as $key => $contribution)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                @if ($contribution->user)
                                    <td><img src="{{ $contribution->user->avatar }}" alt=""></td>
                                    <td>{{ $contribution->user->name }}</td>
                                    <td>{{ $contribution->user->email }}</td>
                                @else
                                    <td><img src="{{ config('path.to_avatar_default') }}" alt=""></td>
                                    <td>{{ $contribution->name }}</td>
                                    <td>{{ $contribution->email }}</td>
                                @endif

                                <td>
                                    @foreach ($contribution->categoryContributions as $value)
                                        <p>{{ $value->category->name }} : <small>{{ $value->amount }}</small></p>
                                    @endforeach
                                </td>
                                <td>{{ $contribution->description }}</td>
                                <td>
                                    <div data-contribution-id="{{ $contribution->id }}">
                                    @if (!$contribution->status)
                                        {!! Form::submit(trans('campaign.confirm'), ['class' => 'btn btn-success confirm']) !!}
                                    @else
                                        {!! Form::submit(trans('campaign.remove'), ['class' => 'btn btn-success confirm']) !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $contributions->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
