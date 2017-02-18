<div class="hide-chat" data-campaign-id="{{ $campaign->id }}"
    data-route-chat="{{ url('campaign-chat') }}"
    data-host="{{ config('app.key_program.socket_host') }}"
    data-port="{{ config('app.key_program.socket_port') }}">
</div>
<div class="group-chat">
    <div class="hide-campaign-id" data-campaign-id="{{ $campaign->id }}"></div>
    <div class="hide-user-id" data-current-user-id="{{ auth()->id() }}"></div>
    <div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left:10px;">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> {{ $groupName }}</h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;">
                        <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                        <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                    </div>
                </div>
                <div class="panel-body msg_container_base">
                    @foreach ($messages as $message)
                        @if ($message->isOwnerCurrentUser())
                            @include('layouts.message_send', [
                                'content' => $message->content,
                                'avatar' => $message->user->avatar,
                                'time' => $message->created_at->diffForHumans(),
                                'name' => $message->user->name,
                            ])
                        @else
                            @include('layouts.message_receive', [
                                'content' => $message->content,
                                'avatar' => $message->user->avatar,
                                'time' => $message->created_at->diffForHumans(),
                                'name' => $message->user->name,
                            ])
                        @endif
                    @endforeach
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <span>
                        {!! Form::text('content', null, ['class' => 'form-control input-sm chat_input', 'id' => 'btn-input', 'placeholder' => 'Write your message here...']) !!}

                        {!! Form::button('Send', ['class' => 'btn btn-raised btn-primary btn-sm', 'id' => 'btn-chat']) !!}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
