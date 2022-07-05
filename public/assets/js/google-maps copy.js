let map;
let geolocation;
let marker;

function initialize() {
    var initialLat = $("#latitude").val();
    var initialLong = $("#longitude").val();
    initialLat = initialLat ? initialLat : 6.1169;
    initialLong = initialLong ? initialLong : 6.1169;

    var latlng = new google.maps.LatLng(initialLat, initialLong);
    var options = {
        center: latlng,
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map"), options);

    geolocation = new google.maps.Geocoder();

    marker = new google.maps.Marker({
        map: map,
        draggable: true,
        position: latlng
    });

    google.maps.event.addListener(marker, "dragend", function () {
        var point = marker.getPosition();
        map.panTo(point);
        geolocation.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                marker.setPosition(results[0].geometry.location);
                $("#alamat").val(results[0].formatted_address);
                $("#latitude").val(marker.getPosition().lat());
                $("#longitude").val(marker.getPosition().lng());
            }
        });
    });

}

$(document).ready(function () {
    initialize();

    var PostCodeId = "#lokasi";
    $(function () {
        $(PostCodeId).autocomplete({
            source: function (request, response) {
                geolocation.geocode({
                    'address': request.term
                }, function (results, status) {
                    response($.map(results, function (item) {
                        return {
                            label: item.formatted_address,
                            value: item.formatted_address,
                            lat: item.geometry.location.lat(),
                            lon: item.geometry.location.lng()
                        }
                    }))
                })
            },
            select: function (event, ui) {
                $('#alamat').val(ui.item.value);
                $('#latitude').val(ui.item.lat);
                $('#longitude').val(ui.item.lon);
                var latlng = new google.maps.LatLng(ui.item.lat, ui.item.lon);
                marker.setPosition(latlng);
                initialize();
            }
        });
    });

    google.maps.event.addListener(marker, "drag", function () {
        geolocation.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
            if (results[0]) {
                $("#alamat").val(results[0].formatted_address);
                $("#latitude").val(marker.getPosition().lat());
                $("#longitude").val(marker.getPosition().lng());
            }
        });
    });
});

// function initMap() {
//     map = new google.maps.Map(document.getElementById("map"), {
//         center: {
//             lat: -34.397,
//             lng: 150.644
//         },
//         zoom: 8,
//     });
// }

// window.initMap = initMap;

