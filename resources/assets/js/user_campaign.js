var Approve = function (url, btnApprove, btnRemove, urlConfirmContribution, btnConfirm, messageConfirm) {
    this.url = url;
    this.btnApprove = btnApprove;
    this.btnRemove = btnRemove;
    this.urlConfirmContribution = urlConfirmContribution;
    this.btnConfirm = btnConfirm;
    this.messageConfirm = messageConfirm;
};

Approve.prototype = {
    init: function () {
        var _self = this;
        _self.approveOrRemove();
        _self.confirmContribution();
    },

    approveOrRemove: function () {
        var _self = this;
        $(".approve").click(function(e) {
            e.preventDefault();
            var thisButton = this;
            var divChangeAmount = $(this).parent();
            var userId = divChangeAmount.data('userId');
            var campaignId = divChangeAmount.data('campaignId');
            var token = $('.hide').data('token');

            BootstrapDialog.confirm(_self.messageConfirm, function (result) {
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: _self.url,
                        data: {
                            'user_id': userId,
                            'campaign_id': campaignId,
                            '_token': token
                        },
                        success: function (data) {
                            if (data.status) {
                                $(thisButton).attr('value', _self.btnRemove);
                            } else {
                                $(thisButton).attr('value', _self.btnApprove);
                            }
                        }
                    });
                }
            });
        });
    },

    confirmContribution: function () {
        var _self = this;

        $(".confirm").click(function(e) {
            e.preventDefault();
            var thisButton = this;
            var divChangeAmount = $(this).parent();
            var contributionId = divChangeAmount.data('contributionId');
            var token = $('.hide').data('token');

            BootstrapDialog.confirm(_self.messageConfirm, function (result) {
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: _self.urlConfirmContribution,
                        data: {
                            'contribution_id': contributionId,
                            '_token': token
                        },
                        success: function(data)
                        {
                            if (data.status) {
                                $(thisButton).attr('value', _self.btnRemove);
                            } else {
                                $(thisButton).attr('value', _self.btnConfirm);
                            }
                        }
                    });
                }
            });
        });
    }
};
