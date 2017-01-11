<li class="list-group-item custom-li-hover">
    <a class="campaign-detail" href="{{ action('CampaignController@show', ['id' => $campaign->id]) }}">
        <div>
            <img src="{{ $campaign->image->image }}" class="search-campaign-img">
            <span>{{ $campaign->name }}</span><br>
            <span><i><small><em>{{ $campaign->address }}</em></small></i></span>
        </div>
    </a>
</li>
<hr>
