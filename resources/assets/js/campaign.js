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
        $('.datetimepicker').datepicker({format: 'yyyy/mm/dd'}).datepicker("setDate", new Date());
    },

    getGoogleAddress: function () {
        if (document.getElementById('location') != null) {
            google.maps.event.addDomListener(window, 'load', function () {
                var places = new google.maps.places.Autocomplete(document.getElementById('location'));
                google.maps.event.addListener(places, 'place_changed', function () {

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
        $(document).on('click', '.category-name', function(e) {
            count ++;
            $(this).attr('class', 'form-control');
            e.preventDefault();
            var html = '';
            html += '<div class="category-content">';
            html += '<div class="col-md-7">';
            html += '<input class="form-control category-name" placeholder="Campaign Name" name="category[name][' + count + ']" type="text" value="">';
            html += '</div>';
            html += '<div class="col-md-5">';
            html += '<input class="form-control category-goal" placeholder="Goal" min="1" name="category[goal][' + count + ']" type="number" value="">';
            html += '</div>';
            html += '</div>';

            $('.category').append(html);
        })
    }
};
