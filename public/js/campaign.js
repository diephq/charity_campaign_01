var Campaign = function (url, validateMessage) {
    this.url = url;
    this.validateMessage = validateMessage;
};

Campaign.prototype = {
    init: function () {
        var _self = this;
        _self.setDatepicker();
        _self.getGoogleAddress();
        _self.uploadPreview();
        _self.ckeditor();
        _self.category();
        _self.validate();

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
        var _self = this;
        var message = JSON.parse(_self.validateMessage);
        var count = 1;
        $(document).on('change', '.category-name', function(e) {
            var value = $(this).val();

            count ++;
            $(this).attr('class', 'form-control');
            e.preventDefault();
            var html = '';
            html += '<div class="form-group">';
            html += '<label for="name" class="col-md-3 control-label"></label>';
            html += '<div class="col-md-8 category">';
            html += '<div class="category-content">';
            html += '<div class="col-md-6">';
            html += '<input class="form-control category-name" placeholder="' + message.contribution_type.contribution + '" name="contribution_type[]" type="text" value="">';
            html += '</div>';
            html += '<div class="col-md-3">';
            html += '<input class="form-control category-goal" placeholder="' + message.goal.goal + '" min="1" name="goal[]" type="number" value="">';
            html += '</div>';
            html += '<div class="col-md-3">';
            html += '<input class="form-control category-unit" placeholder="' + message.unit.unit + '" name="unit[]" type="text">';
            html += '</div></div></div></div>';

            $('.contribution').append(html);
        });
    },

    validate: function () {
        var _self = this;
        var message = JSON.parse(_self.validateMessage);

        $('#create-campaign').validate({
            rules: {
                image: {
                    required: true
                },
                name: {
                    required: true,
                    minlength: 10
                },
                'contribution_type[]': {
                    required: true,
                    minlength: 2
                },
                'goal[]': {
                    required: true,
                    number : true
                },
                'unit[]': {
                    required: true,
                    minlength: 2
                },
                start_date: {
                    required: true
                },
                end_date: {
                    required: true
                },
                address: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                image: {
                    required: message.image.required
                },
                name: {
                    required: message.name.required,
                    minlength: message.name.minlength
                },
                'contribution_type[]': {
                    required: message.contribution_type.required,
                    minlength: message.contribution_type.minlength
                },
                'goal[]': {
                    required: message.goal.required,
                    number : message.goal.number
                },
                'unit[]': {
                    required: message.unit.required,
                    minlength: message.unit.minlength
                },
                start_date: {
                    required: message.start_date.required
                },
                end_date: {
                    required: message.end_date.required
                },
                address: {
                    required: message.location.required
                },
                description: {
                    required: message.description.required
                }
            }
        });
    }
};
