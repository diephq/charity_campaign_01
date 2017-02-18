$(document).ready(function(){

    /* multiple language */
    $("#countries").msDropdown();

    $('.btn-multiple-language').change(function(e) {
        e.preventDefault();
        divChangeAmount = $(this).parent();
        var route = $('.hide_language').data('route');
        var lang = $('.btn-multiple-language').val();
        var token = $('.hide_language').data('token');

        $.ajax({
            type: 'POST',
            url: route,
            dataType: 'JSON',
            data: {
                'lang': lang,
                '_token': token,
            },
            success: function(data){
                if (data.success) {
                    window.location.href = data.url_back;
                }
            }
        });
    });
});
