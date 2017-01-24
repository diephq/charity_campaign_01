var Active = function (btnActive, btnClose, urlActiveCampaign, messageConfirm) {
    this.btnActive = btnActive;
    this.btnClose = btnClose;
    this.urlActiveCampaign = urlActiveCampaign;
    this.messageConfirm = messageConfirm;
};

Active.prototype = {
    init: function () {
        var _self = this;
        _self.activeOrCloseCampaign();
    },

    activeOrCloseCampaign: function () {
        var _self = this;

        $(".active-campaign").click(function (e) {
            e.preventDefault();
            var thisButton = this;
            var thisStatus = $(this).closest('tr').find('.badge');
            var divChangeAmount = $(this).parent();
            var campaignId = divChangeAmount.data('campaignId');
            var token = $('.hide').data('token');

            BootstrapDialog.confirm(_self.messageConfirm, function (result) {
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: _self.urlActiveCampaign,
                        data: {
                            'campaign_id': campaignId,
                            '_token': token
                        },
                        success: function (data) {
                            if (data.status) {
                                $(thisButton).attr('value', _self.btnClose);
                                $(thisStatus).html(_self.btnActive);
                                $(thisStatus).attr('class', 'badge label-primary');
                            } else {
                                $(thisButton).attr('value', _self.btnActive);
                                $(thisStatus).html(_self.btnClose);
                                $(thisStatus).attr('class', 'badge label-warning-custom');
                            }
                        }
                    });
                }
            });
        });
    }
};
