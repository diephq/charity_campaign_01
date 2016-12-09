$('.datetimepicker').datepicker({format: 'yyyy/mm/dd'}).datepicker("setDate", new Date());

if (document.getElementById('location') != null) {
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('location'));
        google.maps.event.addListener(places, 'place_changed', function () {

        });
    });
}
