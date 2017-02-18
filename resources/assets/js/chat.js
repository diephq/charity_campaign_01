$(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});

$(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});

$(document).on('click', '#new_chat', function (e) {
    var size = $( ".chat-window:last-child" ).css("margin-left");
     size_total = parseInt(size) + 400;
    alert(size_total);
    var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
    clone.css("margin-left", size_total);
});

$(document).on('click', '.icon_close', function (e) {
    $( "#chat_window_1" ).remove();
});

$(document).ready(function(){
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var host = $('.hide-chat').data('host');
    var port = $('.hide-chat').data('port');
    var link = (port == '') ? host : host + ":" + port;
    var socket = io.connect(link);

    socket.on('message', function (data) {
        var data = $.parseJSON(data);

        campaignId = $('.hide-campaign-id').data('campaignId');
        currentUserId = $('.hide-user-id').data('currentUserId');

        if (data.success && data.campaign_id == campaignId) {
            if (data.user_id != currentUserId) {
                $('.msg_container_base').append(data.html);
            }
        }
    });


    $('.btn-sm').click(function(e){
        e.preventDefault();
        campaignId = $('.hide-chat').data('campaignId');
        content = $('.chat_input').val();
        routeChat = $('.hide-chat').data('routeChat');

        $.ajax({
            type: 'POST',
            url: routeChat,
            dataType: 'JSON',
            data: {
                'content': content,
                'campaign_id': campaignId,
            },
            success: function(data){
                if (data.success) {
                    $('.chat_input').val('');
                    $('.msg_container_base').append(data.html);
                }
            }
        });
    });
});
