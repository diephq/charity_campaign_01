<div class="row">
    <div class="col-xs-10  col-xs-offset-1">
        <div class="comment">
            <h2>{{ trans('campaign.comments') }}</h2>
            <div class="notify-comment"></div>
            @if ($campaign->status)
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
                    {!! Form::textarea('text', old('text'), ['rows' => '3', 'class' => 'form-control', 'id' => 'text', 'placeholder' => trans('campaign.your_message')]) !!}

                    @if ($errors->has('text'))
                        <span class="help-block">
                            <strong>{{ $errors->first('text') }}</strong>
                        </span>
                    @endif
                    {!! Form::button(trans('campaign.create_comment'), ['class' => 'btn btn-raised  btn-success', 'id' => 'buttonComment']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            @endif
            <ul class="media-list">
                @foreach ($campaign->comments->sortBy(function($comment)
                    {
                      return $comment->created_at;
                    })->reverse() as $comment)
                @include('layouts.comment')
                @endforeach
            </ul>
        </div>
    </div>
</div>
