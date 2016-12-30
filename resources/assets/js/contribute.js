var Contribute = function (contributeUrl) {
    this.contributeUrl = contributeUrl;
};

Contribute.prototype = {
    init: function () {
        var _self = this;
        _self.contribute();
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

                        setTimeout(function () {
                            $('#close-modal').click();
                            $('.notify').html('');
                            $('input').val('');
                        }, 2000);
                    }
                },

                error: function (errors) {
                    var arrayErrors = errors.responseJSON;
                    var errorsHtml = '';
                    $.each(arrayErrors, function (key, value) {
                        errorsHtml += '<div class="alert alert-danger">' + value + '</div>';
                    });
                    $('.notify').html(errorsHtml);
                }
            });
        });
    }
}
