<div class="modal fade list_contribute" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myLargeModalLabel">{{ trans('campaign.contribute') }}</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>{{ trans('campaign.contribution.index') }}</th>
                            <th>{{ trans('campaign.contribution.avatar') }}</th>
                            <th>{{ trans('campaign.contribution.name') }}</th>
                            <th>{{ trans('campaign.contribution.email') }}</th>
                            <th>{{ trans('campaign.contribute') }}</th>
                            <th>{{ trans('campaign.contribution.description') }}</th>
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
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
