<li class="media">
    <div class="pull-left profile_thumb">
        @if ($comment->user)
            <img class="media-object img-circle" src="{{ $comment->user->avatar }}" alt="profile">
        @else
            <img class="media-object img-circle" src="{{ config('path.to_avatar_default') }}" alt="profile">
        @endif
    </div>

    <div class="media-body">
        @if ($comment->user)
            <a href="{{ action('UserController@show', ['id' => $comment->user->id]) }}" >
                <span>{{ $comment->user->name }}</span>
            </a>
        @else
            <span>{{{ $comment->name }}}</span>
        @endif
        <span class="text-muted"><small><em>{{  Carbon\Carbon::now()->subSeconds(time() - strtotime($comment->created_at))->diffForHumans() }}</em></small></span>
        <p class="push-bit">{{{ $comment->text }}}</p>
    </div>
</li>
