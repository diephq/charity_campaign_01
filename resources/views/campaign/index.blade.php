@extends('layouts.app')

@section('content')
    <div class="container category">
        <div class="col-md-12 user-profile">
            <div class="col-md-10 col-md-offset-1">
                <h1 class="page-header title">{{ trans('campaign.list') }}</h1>
            </div>

            <div class="col-md-10 col-md-offset-1">
                @foreach ($campaigns as $campaign)
                <div class="row">
                    <div class="image-campaign">
                        <img src="{{ $campaign->images->image }}" class="image_campaign" alt="">
                    </div>

                    <div class="desc_miles">
                        <div class="row">
                            <a href="#" target="_blank">
                                <div class="title_campaign"><p>{{ $campaign->name }}</p></div>
                            </a>
                            <a href="#" target="_blank">
                                <div class="description"><p class="text">{{ $campaign->description }}</p></div>
                            </a>
                            <br>
                            <div class="title_auth">
                                <span>{{ trans('campaign.by') }}&nbsp;|&nbsp;{{ $campaign->owner->user->name }}</span>
                                <a href="{{ action('UserController@show', ['id' => $campaign->owner->user->id]) }}"></a><span class="date-campaign">&nbsp;|&nbsp;{{ $campaign->created_at }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
                {{ $campaigns->links() }}
            </div>
        </div>
    </div>}
@stop
