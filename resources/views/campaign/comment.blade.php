<div class="row">
    <div class="col-xs-10  col-xs-offset-1">
        <div class="comment">
            <h2>{{ trans('campaign.comments') }}</h2>
            {!! Form::open([ 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'formComment', 'enctype' => 'multipart/form-data']) !!}
            {!! Form::hidden('campaign_id', $campaign->id) !!}

            <div class="row">
                @if (Auth::guest())
                    <div class="col-xs-6">
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('user.name')]) !!}

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-xs-6">
                        {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('user.email')]) !!}

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                @endif

                <div class="col-xs-12">
                    {!! Form::textarea('text', old('text'), ['rows' => '4', 'class' => 'form-control', 'id' => 'text', 'placeholder' => trans('campaign.your_message')]) !!}

                    @if ($errors->has('text'))
                        <span class="help-block">
                            <strong>{{ $errors->first('text') }}</strong>
                        </span>
                    @endif
                    {!! Form::button(trans('campaign.create_comment'), ['class' => 'btn  btn-success', 'id' => 'buttonComment']) !!}
                    </div>
            </div>
            {!! Form::close() !!}
            <br>
            <hr>
            <ul class="media-list">
                @foreach ($campaign->comments as $comment)
                <li class="media">
                    @if ($comment->user)
                        <div class="pull-left">
                            <img class="media-object img-circle" src="{{ $comment->user->avatar }}" alt="profile">
                        </div>
                    @else
                        <div class="pull-left">
                            <img class="media-object img-circle" src="{{ config('path.to_avatar_default') }}" alt="profile">
                        </div>
                    @endif

                    <div class="media-body">
                        <div class="well well-lg">
                            @if ($comment->user)
                                <a href="{{ action('UserController@show', ['id' => $comment->user->id]) }}">
                                    <h4 class="media-heading reviews">{{ $comment->user->name }}</h4>
                                </a>
                            @else
                                <h4 class="media-heading reviews">{{ $comment->name }}</h4>
                            @endif
                            <p class="media-date reviews list-inline">{{ $comment->created_at }}</p>
                            <p class="media-comment">{{ $comment->text }}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
    $( document ).ready(function() {
        var comment = new Comment('{{ action('CommentController@store') }}',
                '{{ config('path.to_avatar_default') }}',
                '{{ action('CampaignController@joinOrLeaveCampaign') }}',
                '{{ trans('campaign.request_sent') }}',
                '{{ trans('campaign.request_join') }}'
        );
        comment.init();
    });
</script>