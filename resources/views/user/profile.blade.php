@section('css')
    @parent
    {{ Html::style('bower_components/bootstrap-star-rating/css/star-rating.css') }}
    {{ Html::style('bower_components/bootstrap-star-rating/css/theme-krajee-fa.css') }}
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/css/bootstrap-dialog.min.css') }}
    {{ Html::style('https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css') }}
@stop

@section('js')
    @parent
    {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/js/bootstrap-dialog.min.js') }}
    {{ Html::script('bower_components/bootstrap-star-rating/js/star-rating.js') }}
    {{ Html::script('js/user_profile.js') }}

    <script type="text/javascript">
        $( document ).ready(function() {
            var userProfile = new UserProfile(
                '{{ action('RatingController@ratingUser') }}',
                '{{ $averageRankingUser['average'] }}',
                '{{ trans('user.rating_your_self') }}',
                '{{ trans('campaign.close') }}',
                '{{ action('FollowController@followOrUnFollowUser') }}',
                '{{ trans('user.follow') }}',
                '{{ trans('user.un_follow') }}'
            );
            userProfile.init();
        });
    </script>
@stop

<div class="col-md-3 left-panel">
    <div class="widget user-info">
        <div class="widget-extra themed-background-dark">
            <h3 class="widget-content-light">
                <p>{{ trans('user.profile') }}</p>
            </h3>
        </div>
        <div class="widget-extra">
            <div class="user-info-details">
                <div class="row">
                    <div class="col-md-5 col-sm-5 profile_thumb">
                        <img src="{{ $user->avatar }}" alt="avatar" class="img-responsive img-circle">
                    </div>
                    <div class="profile-usertitle-name">
                        <p>
                            {{ $user->name }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="user-info-sologan">
                <span class="user-info-social-item">{{ $user->email }}</span>
            </div>
            <div class="user-info-social">
                <ul class="list-group">
                    @if (auth()->id() != $user->id)
                        <li  class="list-group-item btn-follow">
                            <div class="profile-userbuttons">
                                <div data-user-id="{{ $user->id }}">
                                    @if ($follow && $follow->status)
                                        {!! Form::button('<i class="fa fa-users"></i>' . trans('user.un_follow'), ['class' => 'btn btn-raised btn-danger' , 'id' => 'follow']) !!}
                                    @else
                                        {!! Form::button('<i class="fa fa-users"></i>' . trans('user.follow'), ['class' => 'btn btn-raised btn-success', 'id' => 'follow']) !!}
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endif

                    <li class="list-group-item rating-user">
                        @if (Auth::user()->id != $user->id)
                            {!! Form::hidden('target_id', $user->id, ['id' => 'target_id']) !!}
                            <input id="allow-rating-user" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" data-size="xs">
                        @else
                            <input id="not-allow-rating-user" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" data-size="xs">
                        @endif
                    </li>
                    <li class="list-group-item">
                        <div class="reviews-stats"> {{ trans('campaign.total') }}
                            <span class="glyphicon glyphicon-user"></span>
                            <span class="reviews-num-user">{{ $averageRankingUser['amount'] }}</span>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span class="title">{{ trans('campaign.campaigns') }}</span>
                        <span class="badge">{{ $countCampaign }}</span>
                    </li>
                    <li class="list-group-item">
                        <a href="" data-toggle="modal" data-target="#followingUser">
                            <span class="title">{{ trans('user.following') }}</span>
                            <span class="badge">{{ $following->count() }}</span>
                        </a>
                    </li>
                    <li class="list-group-item" >
                        <a href="" data-toggle="modal" data-target="#followerUser">
                            <span class="title">{{ trans('user.followers') }}</span>
                            <span class="badge">{{ $followers->count() }}</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
    @if ($user->isCurrent())
    <div class="widget favorite-tag">
        <div class="widget-extra themed-background-dark">
            <h3 class="widget-content-light">
            </h3>
        </div>
        <div class="widget-extra">
            <ul class="tag-list nav">
                <li class="tag-item">
                    <a href="{{ action('UserController@edit', ['id' => $user->id]) }}">
                        <span class="glyphicon glyphicon-user"></span>
                        <span>{{ trans('user.setting') }}</span>
                    </a>
                </li>
                <li class="tag-item">
                    <a href="{{ action('UserController@listUserCampaign', ['userId' => $user->id]) }}">
                        <span class="glyphicon glyphicon-heart-empty"></span>
                        <span>{{ trans('user.your_campaign') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @endif

    @include('layouts.following')
    @include('layouts.follower')
</div>

