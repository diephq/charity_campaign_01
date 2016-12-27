@section('css')
    @parent
    {{ Html::style('bower_components/bootstrap-star-rating/css/star-rating.css') }}
    {{ Html::style('bower_components/bootstrap-star-rating/css/theme-krajee-fa.css') }}
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/css/bootstrap-dialog.min.css') }}
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
                '{{ trans('campaign.close') }}'
            );
            userProfile.init();
        });
    </script>
@stop

<div class="col-md-3">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="{{ $user->avatar }}" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                {{ $user->name }}
            </div>
            <div class="profile-usertitle-email">
                {{ $user->email }}
            </div>
            @if (Auth::user()->id != $user->id)
                {!! Form::hidden('target_id', $user->id, ['id' => 'target_id']) !!}
                <input id="allow-rating-user" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" data-size="xs">
            @else
                <input id="not-allow-rating-user" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" data-size="xs">
            @endif
            <div class="reviews-stats"> {{ trans('campaign.total') }}
                <span class="glyphicon glyphicon-user"></span>
                <span class="reviews-num-user">{{ $averageRankingUser['amount'] }}</span>
            </div>
        </div>

        <div class="profile-userbuttons">
            <button type="button" class="btn btn-success btn-sm">{{ trans('user.follow') }}</button>
        </div>
    </div>

    <div>
        <div class="profile-sidebar">
            <div class="profile-usermenu">
                <ul class="nav">
                    @if ($user->isCurrent())
                        <li>
                            <a href="{{ action('UserController@edit', ['id' => $user->id]) }}">
                                <i class="glyphicon glyphicon-user"></i>{{ trans('user.setting') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ action('UserController@listUserCampaign', ['userId' => $user->id]) }}">
                                <i class="glyphicon glyphicon-heart-empty"></i>{{ trans('user.your_campaign') }}
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="glyphicon glyphicon-list"></i>{{ trans('user.joined') }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
