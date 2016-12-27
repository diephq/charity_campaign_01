var UserProfile = function (ratingUserUrl, averageRankingUser, messageRatingYourSelf, btnClose ) {
    this.ratingUserUrl = ratingUserUrl;
    this.averageRankingUser = averageRankingUser;
    this.messageRatingYourSelf = messageRatingYourSelf;
    this.btnClose = btnClose;
};

UserProfile.prototype = {
    init: function () {
        var _self = this;
        _self.initStarUser();
        _self.ratingUser();
        _self.notifyRatingUser();
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
    }
};
