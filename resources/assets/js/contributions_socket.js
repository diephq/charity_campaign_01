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

    socket.on('contributions_unconfirm', function (data) {
        var data = $.parseJSON(data);
        campaignId = $('.hide-comment').data('campaignId');

        if (data.success && data.campaign_id == campaignId) {
            $('.list-contribution-unconfirm').empty();
            $('.list-contribution-unconfirm').append(data.html);
            $('.model_list_contribution_unconfirmed').empty();
            $('.model_list_contribution_unconfirmed').append(data.html_model);
        }
    });
});
