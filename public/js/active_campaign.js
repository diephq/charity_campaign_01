var Active = function (btnActive, btnClose, urlActiveCampaign) {
    this.btnActive = btnActive;
    this.btnClose = btnClose;
    this.urlActiveCampaign = urlActiveCampaign;
};

Active.prototype = {
    init: function () {
        var _self = this;
        _self.activeOrCloseCampaign();
    },

    activeOrCloseCampaign: function () {
        var _self = this;

        $(".active").click(function (e) {
            e.preventDefault();
            var thisButton = this;

            var divChangeAmount = $(this).parent();
            var campaignId = divChangeAmount.data('campaignId');
            var token = $('.hide').data('token');

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
                    } else {
                        $(thisButton).attr('value', _self.btnActive);
                    }
                }
            });
        });
    }
}
