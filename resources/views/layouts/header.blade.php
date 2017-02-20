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
                    <li><a href="{{ action('UserController@show', ['id' => Auth::user()->id]) }}" ><span class="glyphicon glyphicon-user"></span> {{ trans('user.home') }}</a></li>
                    <li><a href="{{ url('/logout') }}"><span class="glyphicon glyphicon-log-out"></span> {{ trans('message.logout') }}</a></li>
                </ul>
            </li>
        @endif
        <li>
            <div class="hide_language" data-route="{{ url('language') }}" data-token="{{ csrf_token() }}"></div>
            <div class="multiple-lang">
                <select name="lang" id="countries" class="form-control btn-multiple-language">
                    <option value='en' {{ Session::get('locale') == 'en' ? 'selected' : '' }}
                    data-image="{{ asset('bower_components/ms-Dropdown/images/msdropdown/icons/blank.gif') }}"
                            data-imagecss="flag england" data-title="{{ config('settings.language.en') }}">
                        {{ config('settings.language.en') }}
                    </option>
                    <option value='vi' {{ Session::get('locale') == 'vi' ? 'selected' : '' }}
                    data-image="{{ asset('bower_components/ms-Dropdown/images/msdropdown/icons/blank.gif') }}"
                            data-imagecss="flag vn" data-title="{{ config('settings.language.vi') }}">
                        {{ config('settings.language.vi') }}
                    </option>
                </select>
            </div>
        </li>
    </ul>
    <ul class="nav navbar-nav-custom">
        <li>
            <a href="/">
                <i class="gi gi-home"></i>
                <span>{{ trans('message.project') }}</span>
            </a>
        </li>
    </ul>

    <div class="col-sm-6">
        <form class="navbar-form-custom form-group typeahead" role="search" style="width: 100%">
            <div class="form-group">
                <input id="typeahead-search" value="" type="search" name="q" class="form-control typeahead-search" autocomplete="off" placeholder="{{ trans('campaign.search_campaign') }}">
            </div>
        </form>
    </div>
</header>
