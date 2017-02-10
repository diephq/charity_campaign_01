var Rating = function (
    ratingUrl, messageError, btnClose, averageRanking, ratingUserUrl, messageRequireLogin,
    averageRankingUser, options, star, one_star, two_star, three_star, four_star, five_star, rating,
    messageRatingYourSelf
    ) {
    this.ratingUrl = ratingUrl;
    this.messageError = messageError;
    this.btnClose = btnClose;
    this.averageRanking = averageRanking;
    this.ratingUserUrl = ratingUserUrl;
    this.messageRequireLogin = messageRequireLogin;
    this.averageRankingUser = averageRankingUser;
    this.options = options;
    this.star = star;
    this.one_star = one_star;
    this.two_star = two_star;
    this.three_star = three_star;
    this.four_star = four_star;
    this.five_star = five_star;
    this.rating = rating;
    this.messageRatingYourSelf = messageRatingYourSelf;
};

Rating.prototype = {
    init: function () {
        var _self = this;
        _self.ratingCampaign();
        _self.notifyCampaign();
        _self.initStarCampaign();
        _self.ratingUser();
        _self.notifyRatingUser();
        _self.initStarUser();
        _self.userRatingTable();
        _self.memberTable();
    },

    ratingCampaign: function () {
        var _self = this;
        $('#allow-rating').on('rating.change', function (event, value) {
            var campaignId = $('#campaign_id').val();
            var token = $('.hide').data('token');
            $.ajax({
                type: "POST",
                url: _self.ratingUrl,
                data: {
                    'value': value,
                    'campaign_id': campaignId,
                    '_token': token
                },
                success: function (data) {
                    if (data) {
                        $('#allow-rating').rating('update', data.dataAverage.average);
                        $('.reviews-num').html(data.dataAverage.amount);
                        $('#top_x_div').remove();
                        $('#chart').append('<div id="top_x_div"></div>');
                        _self.drawStuff(data.dataChart);
                    }
                }
            });
        });
    },

    notifyCampaign: function () {
        var _self = this;
        $('#not-allow-rating').on('rating.change', function () {
            BootstrapDialog.show({
                title: '',
                message: _self.messageError,
                buttons: [{
                    label: _self.btnClose,
                    action: function (dialog) {
                        dialog.close();
                        _self.initStarCampaign();
                    }
                }]
            });
        });
    },

    initStarCampaign: function () {
        var _self = this;
        $('#allow-rating').rating('update', _self.averageRanking);
        $('#not-allow-rating').rating('update', _self.averageRanking);
        $('.clear-rating').remove();
        $('.caption').remove();
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
                message: _self.messageRequireLogin,
                buttons: [{
                    label: _self.btnClose,
                    action: function (dialog) {
                        dialog.close();
                        _self.initStarUser();
                    }
                }]
            });
        });

        $('#not-allow-rating-user-myself').on('rating.change', function () {
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
        $('#not-allow-rating-user-myself').rating('update', _self.averageRankingUser);
    },

    drawStuff: function (dataChart) {
        var _self = this;
        var data = google.visualization.arrayToDataTable([
            ['', '', { role: "style" }],
            [_self.five_star + ' ' + _self.star, dataChart[_self.five_star] ? dataChart[_self.five_star] : 0, '#5cb85c'],
            [_self.four_star + ' ' + _self.star, dataChart[_self.four_star] ? dataChart[_self.four_star] : 0, '#337ab7'],
            [_self.three_star + ' ' + _self.star, dataChart[_self.three_star] ? dataChart[_self.three_star] : 0, '#5bc0de'],
            [_self.two_star + ' ' + _self.star, dataChart[_self.two_star] ? dataChart[_self.two_star] : 0, '#f0ad4e'],
            [_self.one_star + ' ' + _self.star, dataChart[_self.one_star] ? dataChart[_self.one_star] : 0, '#d9534f']
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" },
            2]);

        var options = {
            title:  _self.rating,
            bar: {groupWidth: "80%"},
            legend: { position: "none" }
        };
        var chart = new google.visualization.BarChart(document.getElementById("top_x_div"));
        chart.draw(view, options);
    },

    userRatingTable: function () {
        $('#tableUserRating').DataTable();
    },

    memberTable: function () {
        $('#tableMember').DataTable();
    }
};
