var Contribute = function (contributeUrl) {
    this.contributeUrl = contributeUrl;
};

Contribute.prototype = {
    init: function () {
        var _self = this;
        _self.contribute();
        _self.dataTable();
    },

    contribute: function () {
        var _self = this;

        $("#btn-contribute").click(function (e) {
            e.preventDefault();
            var campaignId = $('.campaign-id').data('campaignId');

            $.ajax({
                type: "POST",
                url: _self.contributeUrl,
                data: $("#form-contribute").serialize() + '&campaign_id=' + campaignId,
                success: function (data) {
                    if (data.success) {
                        var html = '';
                        html += '<div class="alert alert-success">' + data.message + '</div>';
                        $('.notify').html(html);

                        $('.notify').fadeIn(1000).delay(500).fadeOut(2000);
                        setTimeout(function () {
                            $('#close-modal').click();
                            $('.notify').html('');
                            $('input').val('');
                        }, 2500);
                    }
                },

                error: function (errors) {
                    var arrayErrors = errors.responseJSON;
                    var errorsHtml = '<div class="alert alert-danger">';
                    $.each(arrayErrors, function (key, value) {
                        errorsHtml += '<p>' + value + '</p>';
                    });
                    errorsHtml += '</div>';

                    $('.notify').html(errorsHtml);
                    $('.notify').fadeIn(1000).delay(1000).fadeOut(3000);
                }
            });
        });
    },

    dataTable: function () {
        $('#contribution-confirmed').dataTable();
        $('#contribution-unconfirmed').dataTable();
    }
};
