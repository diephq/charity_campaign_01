<div class="modal fade list-contribute-confirmed" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myLargeModalLabel">{{ trans('campaign.contribute') }}</h4>
            </div>
            <div class="modal-body">
                <table id="contribution-confirmed" class="mdl-data-table table-custome" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ trans('campaign.contribution.index') }}</th>
                            <th>{{ trans('campaign.contribution.avatar') }}</th>
                            <th>{{ trans('campaign.contribution.name') }}</th>
                            <th>{{ trans('campaign.contribution.email') }}</th>
                            <th>{{ trans('campaign.contribute') }}</th>
                            <th>{{ trans('campaign.contribution.description') }}</th>
                            <th>{{ trans('campaign.contribution.time') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($contributionConfirmed as $key => $contribution)
                        <tr>
                            <td scope="row"><p>{{ $key + 1 }}</p></td>
                            @if ($contribution->user)
                                <td>
                                    <div class="profile_thumb">
                                        <img src="{{ $contribution->user->avatar }}" alt="avatar" class="img-responsive img-circle">
                                    </div>
                                </td>
                                <td><p>{{ $contribution->user->name }}</p></td>
                                <td><p>{{ $contribution->user->email }}</p></td>
                            @else
                                <td>
                                    <div class="profile_thumb">
                                        <img src="{{ config('path.to_avatar_default') }}" alt="avatar" class="img-responsive img-circle">
                                    </div>
                                </td>
                                <td><p>{{ $contribution->name }}</p></td>
                                <td><p>{{ $contribution->email }}</p></td>
                            @endif
                            <td>
                                @foreach ($contribution->categoryContributions as $value)
                                    <span>{{ $value->category->name }} : {{ $value->amount }}  ({{ $value->category->unit }})</span><br>
                                @endforeach
                            </td>
                            <td><p>{{ $contribution->description }}</p></td>
                            <td><p>{{ $contribution->created_at }}</p></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
