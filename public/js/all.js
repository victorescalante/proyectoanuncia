function initMap() {

    var myLatLng = {lat: 19.3431244, lng: -99.4210658};
    var geocoder = new google.maps.Geocoder;
    var btnAddress = document.getElementById('btnAddress');


    var styles = [
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                { "visibility": "on" },
                { "saturation": 45 },
                { "lightness": -10 },
                { "gamma": 0.82 },
                { "weight": 0.8 },
                { "color": "#f35e2c" }
            ]
        },{
            "elementType": "geometry.fill",
            "stylers": [
                { "hue": "#00f6ff" }
            ]
        }
    ];

    function createMap() {
        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            scrollwheel: false,
            zoom: 8,
        });

        return map;
    }

    function createMarker(map,pos) {

        // Create a marker and set its position.
        var marker = new google.maps.Marker({
            map: map,
            position: pos,
            draggable: true,
            title: 'Posición de la marca'
        });

        return marker;
    }

    function events(map,marker) {

        google.maps.event.addListener(marker, 'dragend', function () {
            $positions = getLatAndLong();
            getAddress($positions);
            map.setCenter({lat: getLat(), lng: getLong()});
            //codeAddress(marker);
        });

        /*
        google.maps.event.addListener(map,marker, "dblclick", function() {
            console.log("Entro a eliminar");
            map.removeOverlay(marker);
        });
        */

        google.maps.event.addListener(marker, 'click', function () {
            $positions = getLatAndLong();
            getAddress($positions);
            map.setCenter({lat: getLat(), lng: getLong()});
            //codeAddress(marker);
        });

        google.maps.event.addListener(map, 'click', function () {
            createMarker(map,{lat: 19.3431244, lng: -99.4210658});
        });

        google.maps.event.addDomListener(window, 'resize', function() {
            map.setCenter(marker.getPosition());
        });


    }


    function events_dom() {

        google.maps.event.addDomListener(btnAddress, 'click', function() {
            var address_form = $(".address").val();
            if(address_form.length!=0){
                codeAddress(address_form);
            }else{
                alert('Tienes que colocar una dirección');
            }

        });

    }


    function getLatAndLong() {
        var lat = marker.getPosition().lat();
        var long = marker.getPosition().lng();
        sendFormLatAndLong(lat, long);
        return lat+","+long;
    }


    function getLat() {
        var lat = marker.getPosition().lat();
        return lat;
    }


    function getLong() {
        var long = marker.getPosition().lng();
        return long;
    }



    function getAddress(positions) {
        /* Other solution
         geocoder.geocode({'location': {lat: 19.4171849, lng: -99.5617849}}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    console.log(results);
                }
            }
         });
         */

        $.ajax({
            method: "GET",
            url: "http://maps.googleapis.com/maps/api/geocode/json?latlng="+positions,
            success: function(resp){
                console.log(resp.status);
                sendFormAddress(resp.results[0].formatted_address);

            }
        });
    }

    function sendFormLatAndLong(lat, long) {

        $(".latitude").val(lat);
        $(".longitude").val(long);
    }

    function sendFormAddress(address) {
        $(".address").val(address);
    }


    function codeAddress(address) {
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                console.log(results);
                var p_lat = (results[0].geometry.location.lat());
                var p_long = (results[0].geometry.location.lng());
                marker.setPosition({lat: p_lat, lng: p_long});
                map.setCenter({lat: getLat(), lng: getLong()});
                getLatAndLong();
            } else {
                alert("Error: " + status);
            }
        });
    }




    element = document.querySelector('#map');

    events_dom();

    if (element) {

        map = createMap();
        marker = createMarker(map,myLatLng);
        events(map,marker);
        map.setOptions({styles: styles});


    }



}


// End-code Google Maps

//Start Code of the views


$(document).ready(function ()
{

    $('.btnImages').on('click', function () {
        event.preventDefault();
        $("input[type='file']").trigger('click');
    });

    /*
    $('#btnAddress').on('click', function () {
        var address_form = $(".address").val();
        initMap().codeAddress(address_form);
    });
    */
});







// Functions for ajax
token = $("input[name='_token']").val();

/*
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $("input[name='_token']").val(),
    }
});
*/


function recargarS2(id)
{
    $('#municipalities').html('<option value="">Cargando datos ..</option>');

    $.ajax({
        method: "GET",
        url: "/sistema/puentes/create/select/",
        data: {
            id: id,
            _method: token
        },
        success: function(resp){
            $('#municipalities').html(resp)
        }
    });
}













$(document).ready(function() {

    var MaxInputs       = 8; //maximum input boxes allowed
    var contenedor   	= $("#contenedor"); //Input boxes wrapper ID
    var AddButton       = $("#agregarCampo"); //Add button ID

    //var x = contenedor.length; //initlal text box count
    var x = $("#contenedor div").length + 1;
    var FieldCount = x-1; //to keep track of text box added

    $(AddButton).click(function (e)  //on add input button click
    {
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++; //text box added increment
            //add input box
            $(contenedor).append('<div class="added"><input type="text" name="mitexto[]" id="campo_'+ FieldCount +'" placeholder="Texto '+ FieldCount +'"/><a href="#" class="eliminar">&times;</a></div>');
            x++; //text box increment
        }
        return false;
    });

    $("body").on("click",".eliminar", function(e){ //user click on remove text
        if( x > 1 ) {
            $(this).parent('div').remove(); //remove text box
            x--; //decrement textbox
        }
        return false;
    });

});




//Validate edit


    $(document).ready(function ()
    {
        $('.btnImages').on('click', function () {
            event.preventDefault();
            $("input[type='file']").trigger('click');
        });
    });





//# sourceMappingURL=all.js.map
