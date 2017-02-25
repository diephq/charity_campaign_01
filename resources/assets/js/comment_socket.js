$(document).ready(function(){
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var host = $('.hide-comment').data('host');
    var port = $('.hide-comment').data('port');
    var link = (port == '') ? host : host + ":" + port;
    var socket = io.connect(link);

    socket.on('comment', function (data) {
        var data = $.parseJSON(data);
        campaignId = $('.hide-comment').data('campaignId');

        if (data.success && data.campaign_id == campaignId) {
            $('#text').val('');
            $('.media-list').prepend(data.html);
        }
    });
});
