@foreach ($contributionUnConfirmed->take(10) as $contribution)
<li class="active-user-item">
    <div class="row">
        @if ($contribution->user)
            <div class="col-md-4">
                <a class="pull-left border-aero profile_thumb">
                    <img src="{{ $contribution->user->avatar }}" alt="avatar"
                         class="img-responsive img-circle">
                </a>
            </div>
            <div class="col-md-8 active-user-item-info">
                <a class="title" href="{{ action('UserController@show', ['id' => $contribution->user->id]) }}">
                    {{ $contribution->user->name }}
                </a><br>
                <span>{{ $contribution->user->email }}</span><br>
                <span>{{ Carbon\Carbon::now()->subSeconds(time() - strtotime($contribution->created_at))->diffForHumans() }}</span>
            </div>
        @else
            <div class="col-md-4">
                <a class="pull-left border-aero profile_thumb">
                    <img src="{{ config('path.to_avatar_default') }}" alt="avatar"
                         class="img-responsive img-circle">
                </a>
            </div>
            <div class="col-md-8 active-user-item-info">
                <span>{{ $contribution->name }}</span><br>
                <span>{{ $contribution->email }}</span><br>
                <span>{{ Carbon\Carbon::now()->subSeconds(time() - strtotime($contribution->created_at))->diffForHumans() }}</span>
            </div>
        @endif
    </div>
</li>
@endforeach

<a class="pull-right" href=".list-contribute-unconfirmed" data-toggle="modal"
    data-target=".list-contribute-unconfirmed">{{ trans('campaign.show_detail') }}
</a>
