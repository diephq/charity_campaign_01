<div class="modal fade list-user-rating" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tableUserRating" class="mdl-data-table table table-hover table-responsive table-custome" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{ trans('campaign.contribution.index') }}</th>
                        <th>{{ trans('campaign.contribution.avatar') }}</th>
                        <th>{{ trans('campaign.contribution.name') }}</th>
                        <th>{{ trans('campaign.contribution.email') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($userRatings as $key => $value)
                        <tr>
                            <td scope="row">{{ $key + 1 }}</td>
                            <td>
                                <div class="profile_thumb">
                                    <a href="{{ action('UserController@show', ['id' => $value->user->id]) }}">
                                        <img src="{{ $value->user->avatar }}" alt="avatar" class="img-responsive img-circle">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <a href="{{ action('UserController@show', ['id' => $value->user->id]) }}">
                                    <p>{{ $value->user->name }}</p>
                                </a>
                            </td>
                            <td>
                                <p>{{ $value->user->email }}</p>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
