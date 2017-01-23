var Approve = function (
    url, btnApprove, btnRemove, urlConfirmContribution, btnConfirm, messageConfirm,
    joined, waiting, contributeConfirmed, contributeWaiting
    ) {
    this.url = url;
    this.btnApprove = btnApprove;
    this.btnRemove = btnRemove;
    this.urlConfirmContribution = urlConfirmContribution;
    this.btnConfirm = btnConfirm;
    this.messageConfirm = messageConfirm;
    this.joined = joined;
    this.waiting = waiting;
    this.contributeConfirmed = contributeConfirmed;
    this.contributeWaiting = contributeWaiting;
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
            var thisStatus = $(this).closest('tr').find('.badge');
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
                                $(thisStatus).html(_self.joined);
                                $(thisStatus).attr('class', 'badge label-primary');
                            } else {
                                $(thisButton).attr('value', _self.btnApprove);
                                $(thisStatus).html(_self.waiting);
                                $(thisStatus).attr('class', 'badge label-warning-custom');
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
            var thisStatus = $(this).closest('tr').find('.badge');
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
                                $(thisStatus).html(_self.contributeConfirmed);
                                $(thisStatus).attr('class', 'badge label-primary');
                            } else {
                                $(thisButton).attr('value', _self.btnConfirm);
                                $(thisStatus).html(_self.contributeWaiting);
                                $(thisStatus).attr('class', 'badge label-warning-custom');
                            }
                        }
                    });
                }
            });
        });
    }
};
