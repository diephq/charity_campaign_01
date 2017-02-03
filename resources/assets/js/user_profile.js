var UserProfile = function (
    ratingUserUrl, averageRankingUser, messageRatingYourSelf, btnClose, urlFollowUser,
    btnFollow, btnUnFollow
    ) {
    this.ratingUserUrl = ratingUserUrl;
    this.averageRankingUser = averageRankingUser;
    this.messageRatingYourSelf = messageRatingYourSelf;
    this.btnClose = btnClose;
    this.urlFollowUser = urlFollowUser;
    this.btnFollow = btnFollow;
    this.btnUnFollow = btnUnFollow;
};

UserProfile.prototype = {
    init: function () {
        var _self = this;
        _self.initStarUser();
        _self.ratingUser();
        _self.notifyRatingUser();
        _self.followOrUnFollowUser();
        _self.followingUserTable();
        _self.followerUserTable();
        _self.campaignsTable();
    },

    ratingUser: function () {
        var _self = this;
        $('#allow-rating-user').on('rating.change', function (event, value) {
            var targetId = $('#target_id').val();
            var token = $('.hide').data('token');
            $.ajax({
                type: "POST",
                url: _self.ratingUserUrl,
                data: {
                    'value': value,
                    'targetId': targetId,
                    '_token': token
                },
                success: function (data) {
                    if (data) {
                        $('#allow-rating-user').rating('update', data.average);
                        $('.reviews-num-user').html(data.amount);
                    }
                }
            });
        });
    },

    notifyRatingUser: function () {
        var _self = this;
        $('#not-allow-rating-user').on('rating.change', function () {
            BootstrapDialog.show({
                title: '',
                message: _self.messageRatingYourSelf,
                buttons: [{
                    label: _self.btnClose,
                    action: function (dialog) {
                        dialog.close();
                        _self.initStarUser();
                    }
                }]
            });
        });
    },

    initStarUser: function () {
        var _self = this;
        $('#allow-rating-user').rating('update', _self.averageRankingUser);
        $('#not-allow-rating-user').rating('update', _self.averageRankingUser);
        $('.clear-rating').remove();
        $('.caption').remove();
    },

    followOrUnFollowUser: function () {
        var _self = this;
        var icon = '<i class="fa fa-users"></i>';

        $("#follow").click(function(e) {
            e.preventDefault();
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
                        $("#follow").text(_self.btnUnFollow).prepend(icon);
                        $("#follow").removeClass('btn-default');
                        $("#follow").addClass('btn-success');
                    } else {
                        $("#follow").text(_self.btnFollow).prepend(icon);
                        $("#follow").removeClass('btn-success');
                        $("#follow").addClass('btn-default');
                    }
                }
            });
        });
    },

    followingUserTable: function () {
        $('#tableFollowing').DataTable();
    },
    
    followerUserTable: function () {
        $('#tableFollower').DataTable();
    },

    campaignsTable: function () {
        $('#tableCampaigns').DataTable();
    }
};
