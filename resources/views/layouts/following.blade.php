<div class="modal fade" id="followingUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ trans('user.following') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tableFollowing" class=" table-striped table-bordered table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>{{ trans('campaign.contribution.index') }}</th>
                        <th>{{ trans('campaign.contribution.avatar') }}</th>
                        <th>{{ trans('campaign.contribution.name') }}</th>
                        <th>{{ trans('campaign.contribution.email') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($following as $key => $value)
                        <tr>
                            <td scope="row">{{ $key + 1 }}</td>
                            <td>
                                <div class="profile_thumb">
                                    <img src="{{ $value->following->avatar }}" alt="avatar" class="img-responsive img-circle">
                                </div>
                            </td>
                            <td>
                                <p>{{ $value->following->name }}</p>
                            </td>
                            <td>
                                <p>{{ $value->following->email }}</p>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
