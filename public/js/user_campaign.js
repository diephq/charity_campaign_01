var Approve = function (url, btnApprove, btnRemove) {
    this.url = url;
    this.btnApprove = btnApprove;
    this.btnRemove = btnRemove;
};

Approve.prototype = {
    init: function () {
        var _self = this;
        _self.approveOrRemove();
    },

    approveOrRemove: function () {
        var _self = this;

        $(".approve").click(function(e) {
            e.preventDefault();
            var thisButton = this;

            $.ajax({
                type: "POST",
                url: _self.url,
                data: $("#formApprove").serialize(),
                success: function(data)
                {
                    if (data.id) {
                        $(thisButton).attr('value', _self.btnRemove);
                    } else {
                        $(thisButton).remove();
                    }
                }
            });
        });
    }
};
