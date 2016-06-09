//Var globals

// Functions for ajax
token = $("input[name='_token']").val();

function initMap(){

}

/*
 $.ajaxSetup({
 headers: {
 'X-CSRF-TOKEN': $("input[name='_token']").val(),
 }
 });
 */


/*
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
        /*
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
        /*
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









function form_btns(){

    var MaxInputs       = 8; //maximum input boxes allowed
    var contenedor   	= $("#contenedor"); //Input boxes wrapper ID
    var AddButton       = $("#agregarCampo"); //Add button ID
    var clearFormImg    = $('.files').html();

    //var x = contenedor.length; //initlal text box count
    var x = $("#contenedor .files").length+1;
    var FieldCount = x-1; //to keep track of text box added
    $(AddButton).click(function (e)  //on add input button click
    {
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++; //div box added increment
            //add input box
            var newImg = clearFormImg;
            console.log(newImg);

            $('.newImg').append(newImg);
            console.log("Existen: "+x);

            x++; //div box increment
        }
        return false;
    });

    $("body").on("click",".eliminar", function(event){ //user click on remove text
        if( x > 2) {
            var div_ant = $(this).parent('div');
            div_ant.parent('div').remove();
            x=x-1;
            console.log("Despues de eliminar x vale: "+x);
        }
        return false;
    });

}


function dropZone() {

    function load_image() {
        $('html').on('click','.image', function (event) {
            $(this).next(".select_image").trigger('click');

        });

    }

    function load_images_front(){


        //$("input[type='file']").on('change',function (event) {
        $("html").on('change','.select_image',function (event) {

            var fileImg =  $(this);

            var filesSelected = fileImg[0].files[0];

            if (filesSelected) {

                var fileReader = new FileReader();

                fileReader.onload = function(fileLoadedEvent) {

                    var srcData = fileLoadedEvent.target.result; // <--- data: base64

                    //fileImg.parents('.contentInput').find('.imgTest img').attr('src', srcData);
                    fileImg.parent('.file').addClass('dragActive');

                    fileImg.parent('.file').find('.image').css({
                       'background': 'url('+srcData+')',
                    });

                }

                fileReader.readAsDataURL(filesSelected);


            }



        });


    }


    load_image();
    load_images_front();

}





//Validate edit


function btn_images(){
    $('.btnImages').on('click', function () {
        event.preventDefault();
        $("input[type='file']").trigger('click');
    });
}



//----------------------------------
//----------------------------------
//----------------------------------
function always(){

}
function oneTime(){

    dropZone();
    //btn_images();
    //form_btns();

}
function lastTime(){
}
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
$(document).ready(function() {
    //-- No MOD----------------------------------//
    always();
    window.addEventListener("resize", always);
    //-- No MOD----------------------------------//
    oneTime();
});
//----------------------------------------------------------//
$(window).load(function() {
    //-- No MOD----------------------------------//
    always();
    window.addEventListener("resize", always);
    //-- No MOD----------------------------------//
    lastTime();
});
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------//