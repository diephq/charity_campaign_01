var Follow = function (urlFollowUser, btnFollow, btnUnFollow) {
    this.urlFollowUser = urlFollowUser;
    this.btnFollow = btnFollow;
    this.btnUnFollow = btnUnFollow;
};

Follow.prototype = {
    init: function () {
        var _self = this;
        _self.followOrUnFollowUser();
    },

    followOrUnFollowUser: function () {
        var _self = this;
        var icon = '<i class="fa fa-users"></i> ';

        $(".follow").click(function(e) {
            e.preventDefault();
            var thisButton = this;
            var divChangeAmount = $(this).parent();
            var userId = divChangeAmount.data('userId');
            var token = $('.hide').data('token');

            $.ajax({
                type: "POST",
                url: _self.urlFollowUser,
                data: {
                    target_id: userId,
                    _token: token
                },
                success: function(data)
                {
                    if (data.result.status) {
                        $(thisButton).text(_self.btnUnFollow).prepend(icon);
                        $(thisButton).removeClass('btn-success');
                        $(thisButton).addClass('btn-danger');
                    } else {
                        $(thisButton).text(_self.btnFollow).prepend(icon);
                        $(thisButton).removeClass('btn-danger');
                        $(thisButton).addClass('btn-success');
                    }
                }
            });
        });
    }
};
