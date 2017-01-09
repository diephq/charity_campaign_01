<header class="navbar navbar-default fix-float">
    <ul class="nav navbar-nav-custom pull-right">
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}">{{ trans('message.login') }}</a></li>
            <li><a href="{{ url('/register') }}">{{ trans('message.register') }}</a></li>
        @else
            <li>
                <a href="{{ action('CampaignController@create') }}">
                    <i class="glyphicon glyphicon-pencil"></i>
                    <span>{{ trans('campaign.create_campaign') }}</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ Auth()->user()->avatar }}" alt="avatar"> <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                    <li><a href="{{ action('UserController@show', ['id' => Auth::user()->id]) }}" ><span class="glyphicon glyphicon-user"></span> {{ trans('user.your_profile') }}</a></li>
                    <li><a href="{{ url('/logout') }}"><span class="glyphicon glyphicon-log-out"></span> {{ trans('message.logout') }}</a></li>
                </ul>
            </li>
        @endif
    </ul>
    <ul class="nav navbar-nav-custom">
        <li>
            <a href="/">
                <i class="gi gi-home"></i>
                <span>{{ trans('message.project') }}</span>
            </a>
        </li>
    </ul>
</header>
