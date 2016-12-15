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
                success: function(data)
                {
                    if (data.id) {
                        _self.html = '<li class="media">';
                        _self.html += '<a class="pull-left" href="#">';

                        if (data.user) {
                            _self.html += '<img class="media-object img-circle" src="' + data.user.avatar + '" alt="profile">';
                        } else {
                            _self.html += '<img class="media-object img-circle" src="' + _self.avatarDefault + '" alt="profile">';
                        }

                        _self.html += '</a>';
                        _self.html += '<div class="media-body">';
                        _self.html += '<div class="well well-lg">';

                        if (data.user) {
                            _self.html += '<h4 class="media-heading reviews">' + data.user.name + '</h4>';
                        } else {
                            _self.html += '<h4 class="media-heading reviews">' + data.name + '</h4>';
                        }

                        _self.html += '<p class="media-date reviews list-inline">' + data.created_at + '</p>';
                        _self.html += '<p class="media-comment">' + data.text + '</p></div>';
                        _self.html += '</div></li>';

                        $('#text').val('');
                        $('.media-list').append(_self.html);
                    }
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
