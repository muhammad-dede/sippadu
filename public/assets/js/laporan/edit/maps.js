// Maps
getLocation();

function getLocation() {

    var latitude = $("#latitude").val() ? $("#latitude").val() : -6.116886485802136;
    var longitude = $("#longitude").val() ? $("#longitude").val() : 106.15177005253722;

    var latlng = new google.maps.LatLng(latitude, longitude);

    var map = new google.maps.Map(document.getElementById("map"), {
        center: latlng,
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var marker = new google.maps.Marker({
        map: map,
        draggable: true,
        position: latlng
    });

    var geocode = new google.maps.Geocoder();
    geocode.geocode({
        'latLng': marker.getPosition()
    }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            marker.setPosition(results[0].geometry.location);
            $("#lokasi").val(results[0].formatted_address);
            $("#latitude").val(marker.getPosition().lat());
            $("#longitude").val(marker.getPosition().lng());
        }
    });

    var searchLocation = new google.maps.places.SearchBox(document.getElementById("lokasi"));
    google.maps.event.addListener(searchLocation, "places_changed", function () {
        var places = searchLocation.getPlaces();
        var bounds = new google.maps.LatLngBounds();
        var i, place;

        for (i = 0; place = places[i]; i++) {
            bounds.extend(place.geometry.location);
            marker.setPosition(place.geometry.location);
        }
        map.fitBounds(bounds);
        map.setZoom(14);

        geocode.geocode({
            'latLng': marker.getPosition()
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                marker.setPosition(results[0].geometry.location);
                $("#lokasi").val(results[0].formatted_address);
                $("#latitude").val(marker.getPosition().lat());
                $("#longitude").val(marker.getPosition().lng());
            }
        });
    });

    google.maps.event.addListener(marker, "dragend", function () {
        var places = marker.getPosition();
        map.panTo(places);
        geocode.geocode({
            'latLng': marker.getPosition()
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                marker.setPosition(results[0].geometry.location);
                $("#lokasi").val(results[0].formatted_address);
                $("#latitude").val(marker.getPosition().lat());
                $("#longitude").val(marker.getPosition().lng());
            }
        });
    });
}

