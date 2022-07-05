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
        draggable: false,
        position: latlng
    });
}

