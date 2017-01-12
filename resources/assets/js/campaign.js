var Campaign = function (url) {
    this.url = url;
};

Campaign.prototype = {
    init: function () {
        var _self = this;
        _self.setDatepicker();
        _self.getGoogleAddress();
        _self.uploadPreview();
        _self.ckeditor();
        _self.category();

    },

    setDatepicker: function () {
        $('.datetimepicker').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'YYYY/MM/DD'}  );
    },

    getGoogleAddress: function () {
        if (document.getElementById('location') != null) {
            google.maps.event.addDomListener(window, 'load', function () {
                var places = new google.maps.places.Autocomplete(document.getElementById('location'));
                google.maps.event.addListener(places, 'place_changed', function () {
                    document.getElementById('lat').value = places.getPlace().geometry.location.lat();
                    document.getElementById('lng').value = places.getPlace().geometry.location.lng();
                });
            });
        }
    },

    uploadPreview: function () {
        $.uploadPreview({
            input_field: "#image-upload",
            preview_box: "#image-preview"
        });
    },

    ckeditor: function () {
        var _self = this;
        CKEDITOR.replace( 'editor', {
            filebrowserUploadUrl: _self.url
        });
    },
    
    category: function () {
        var count = 1;
        $(document).on('change', '.category-name', function(e) {
            var value = $(this).val();

            count ++;
            $(this).attr('class', 'form-control');
            e.preventDefault();
            var html = '';
            html += '<div class="category-content">';
            html += '<div class="col-md-6">';
            html += '<input class="form-control category-name" placeholder="Campaign Name" name="category[name][' + count + ']" type="text" value="">';
            html += '</div>';
            html += '<div class="col-md-3">';
            html += '<input class="form-control category-goal" placeholder="Goal" min="1" name="category[goal][' + count + ']" type="number" value="">';
            html += '</div>';
            html += '<div class="col-md-3">';
            html += '<input class="form-control category-unit" placeholder="Unit" name="category[unit][' + count + ']" type="text">';
            html += '</div>';
            html += '</div>';

            $('.category').append(html);
        });
    }
};
