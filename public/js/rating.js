var Rating = function (ratingUrl, titleError, messageError, btnClose) {
    this.ratingUrl = ratingUrl;
    this.titleError = titleError;
    this.messageError = messageError;
    this.btnClose = btnClose;
};

Rating.prototype = {
    init: function () {
        var _self = this;
        _self.ratingCampaign();
        _self.notifyCampaign();
    },

    ratingCampaign: function () {
        var _self = this;

        $('#input-1').on('rating.change', function(event, value) {

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
                success: function(data)
                {
                    if (data) {
                        $('#input-1').rating('update', data.average);
                        $('.reviews-num').html(data.amount);
                    }
                }
            });
        });
    },

    notifyCampaign: function () {
        var _self = this;

        $('#input-2').on('rating.change', function() {
            BootstrapDialog.show({
                title: _self.titleError,
                message: _self.messageError,
                buttons: [{
                    label: _self.btnClose,
                    action: function(dialog) {
                        dialog.close();
                    }
                }]
            });
        });
    }
};
