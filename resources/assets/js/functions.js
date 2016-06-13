//Var globals

// Functions for ajax
token = $("input[name='_token']").val();


/*
 $.ajaxSetup({
 headers: {
 'X-CSRF-TOKEN': $("input[name='_token']").val(),
 }
 });
 */

function initMap() {

    var myLatLng = {lat: 19.3431244, lng: -99.4210658};
    var geocoder = new google.maps.Geocoder();
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
            codeAddress(marker);
        });

        google.maps.event.addListener(marker, 'click', function () {
            $positions = getLatAndLong();
            getAddress($positions);
            map.setCenter({lat: getLat(), lng: getLong()});
            codeAddress(marker);
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
                map.setZoom(16);
                getLatAndLong();
            } else {
                alert("Error: " + status);
            }
        });
    }



    //search key map in DOM

    element = document.querySelector('#map');

    events_dom();

    if (element) {

        map = createMap();
        marker = createMarker(map,myLatLng);
        events(map,marker);
        map.setOptions({styles: styles});

        var form_lat = $(".latitude").val();
        var form_long = $(".longitude").val();

        if(form_lat!='' && form_long!=''){
            $position = form_lat+","+form_long;
            getAddress($position);
        }

    }

}




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




function dropZone() {

    var clearFormImg    = $('.container_images').html();
    var clearFormImg2    = $('.file:last').html();
    var x = $(".container_images .file").length; // the var x is the general container
    var y = 0; // the var y is the container images create

    function load_image() {
        $('html').on('click','.image', function (event) {
            $(this).next(".select_image").trigger('click');
        });

    }

    function delete_image() {
        $('html').on('click','.add-delete ', function (event) {

            var delete_file = $(this).parents('.file');

            if(confirm('¿eliminar?')){
                delete_file.fadeOut('fast');
                delete_file.remove();
                /**
                 * Agregar desmanecimiento
                 * setTimeout(function (){},1000);
                 */
                x--;
                y--;
            }

            if( (count_images_exist()==true) && (y==0 && x==1) ) {
                create_div_img();
            }
            event.stopPropagation();

        });

    }

    function load_images_front(){


        $("html").on('change','.select_image',function (event) {

            var fileImg =  $(this);

            if(fileImg.parent('.file').hasClass('dragActive')){
                var temp = 1;
            }

            var filesSelected = fileImg[0].files[0];

            if (filesSelected) {

                var fileReader = new FileReader();

                fileReader.onload = function(fileLoadedEvent) {

                    var srcData = fileLoadedEvent.target.result; // <--- data: base64


                    fileImg.parent('.file').find('.image').css({
                       'background': 'url('+srcData+')',
                    });


                    if(!temp) {

                        create_div_img();

                    }

                }

                fileReader.readAsDataURL(filesSelected);

                fileImg.parent('.file').addClass('dragActive');


            }



        });


    }

    function create_div_img(){

        var MaxInputs       = 5;

        if(x < MaxInputs)
        {
            //add new form img on DOM
            var newImg = clearFormImg2;
            console.log(newImg);
            $('.container_images').append(newImg);
            x++;
            y++;
        }

    }

    function count_images_exist(){

            var val = $('.file').hasClass("dragActive");
            return val;

    }

    function active_sortable(){


        $( ".container_images" ).sortable({
            items: '> .dragActive',
            cursor: "move",
            revert: 100,
            opacity: 0.5,
        });

        $( ".container_images" ).disableSelection();
    }



    load_image();
    load_images_front();
    active_sortable();
    delete_image();




}


//----------------------------------
//----------------------------------
//----------------------------------
function always(){

}
function oneTime(){

    dropZone();

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