function initMap() {
    var latitude = parseFloat($('#latitude').val());
    var longitude = parseFloat($("#length").val());

    console.log(latitude+" "+longitude);

    var myLatLng = {lat: latitude , lng: longitude};
    console.log(myLatLng);

    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map_div_show'), {
        center: myLatLng,
        scrollwheel: false,
        zoom: 15
    });

    // Create a marker and set its position.
    var marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: 'Ubicación de Puente' 
    });
}