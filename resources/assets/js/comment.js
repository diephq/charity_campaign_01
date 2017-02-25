var Comment = function (url, avatarDefault, urlRequestJoin, btnRequestSent, btnJoin) {
    this.url = url;
    this.avatarDefault = avatarDefault;
    this.urlRequestJoin = urlRequestJoin;
    this.btnRequestSent = btnRequestSent;
    this.btnJoin = btnJoin;
};

Comment.prototype = {
    init: function () {
        var _self = this;
        _self.initEvent();
        _self.joinOrLeaveCampaign();
    },

    initEvent: function () {
        var _self = this;

        $("#buttonComment").click(function(e) {
            e.preventDefault();
            _self.html = '';

            $.ajax({
                type: "POST",
                url: _self.url,
                data: $("#formComment").serialize(),
                error: function (errors) {
                    var arrayErrors = errors.responseJSON;
                    var errorsHtml = '<div class="alert alert-danger">';
                    $.each(arrayErrors, function (key, value) {
                        errorsHtml += '<p>' + value + '</p>';
                    });
                    errorsHtml += '</div>';

                    $('.notify-comment').html(errorsHtml);
                    $('.notify-comment').fadeIn(1000).delay(1000).fadeOut(3000);
                }
            });
        });
    },

    joinOrLeaveCampaign: function () {
        var _self = this;

        $(".joinOrLeave").click(function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: _self.urlRequestJoin,
                data: $("#formRequest").serialize(),
                success: function(data)
                {
                    if (data.id) {
                        $('.joinOrLeave').attr('value', _self.btnRequestSent);
                    } else {
                        $('.joinOrLeave').attr('value', _self.btnJoin);
                    }
                }
            });
        });
    }
};
