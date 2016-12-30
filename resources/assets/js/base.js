/**
 * This is base js file
 */

/*
 *  Document   : index.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Dashboard page
 */

var Dashboard = function() {

    return {
        init: function() {
            // Initialize Timeline map
            // REMEMBER to init map after we append the html to page because it will auto calculate the width, height
            $('.gmap-timeline').each(function() {
                // should filter element not init -> you do it
                var lat = $(this).data('lat');
                var lng = $(this).data('lng');
                var address = $(this).data('address');
                var elementId = '#' + $(this).attr('id');
                new GMaps({
                    div: elementId,
                    lat: lat,
                    lng: lng,
                    zoom: 15,
                    disableDefaultUI: true,
                    scrollwheel: false
                }).addMarkers([
                    {
                        lat: lat,
                        lng: lng,
                        animation: google.maps.Animation.DROP,
                        infoWindow: {content: '<strong>' + address + '</strong>'}
                    }
                ]);
            });
        }
    };
}();
