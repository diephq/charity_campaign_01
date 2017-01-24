<div class="modal fade" id="campaigns" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ trans('user.following') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tableCampaigns" class="table table-hover table-responsive table-custome" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{ trans('campaign.name') }}</th>
                        <th>{{ trans('campaign.address') }}</th>
                        <th>{{ trans('campaign.status') }}</th>
                        <th>{{ trans('campaign.start_date') }}</th>
                        <th>{{ trans('campaign.end_date') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($campaigns as $key => $campaign)
                        <tr>
                            <td><a href="{{ action('CampaignController@show', ['id' => $campaign->id]) }}">{{ $campaign->name }}</a></td>
                            <td>{{ $campaign->address }}</td>
                            <td>
                                @if ($campaign->status)
                                    <span class="badge label-primary">{{ trans('campaign.active') }}</span>
                                @else
                                    <span class="badge label-warning-custom">{{ trans('campaign.close') }}</span>
                                @endif
                            </td>
                            <td><span>{{{ date('Y-m-d', strtotime($campaign->start_time)) }}}</span></td>
                            <td><span>{{{ date('Y-m-d', strtotime($campaign->end_time)) }}}</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
