@extends('layouts.app')

@section('js')
    @parent
    {{ Html::script('js/user_campaign.js') }}
    <script type="text/javascript">
        $( document ).ready(function() {
            var approve = new Approve(
                    '{{ action('CampaignController@approveOrRemove') }}',
                    '{{ trans('campaign.approve') }}',
                    '{{ trans('campaign.remove') }}'
            );
            approve.init();
        });
    </script>
@stop

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
                                    {!! Form::open(['method' => 'POST', 'id' => 'formApprove']) !!}
                                    {!! Form::hidden('campaign_id', $campaign->id) !!}
                                    {!! Form::hidden('user_id', $user->id) !!}
                                    @if (!$user->userCampaign->status)
                                        {!! Form::submit(trans('campaign.approve'), ['class' => 'btn btn-success approve']) !!}
                                    @else
                                        {!! Form::submit(trans('campaign.remove'), ['class' => 'btn btn-success approve']) !!}
                                    @endif
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $campaignUsers->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
