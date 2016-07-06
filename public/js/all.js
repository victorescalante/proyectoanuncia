function dropZone() {

    var clearFormImg    = $('.container_images').html();
    if($('.content_file').hasClass('content_file')){
        clearFormImg = $('.content_file').html();
    }

    var MaxInputs       = 8;
    var band = 0;
    var x = $(".container_images .file").length; // the var x is the general container
    var y = x-1; // the var y is the container images create


    function load_image() {
        $('html').on('click','.image', function (event) {
            $(this).next(".select_image").trigger('click');
        });

    }

    function delete_image() {
        $('html').on('click','.add-delete ', function (event) {

            var delete_file = $(this).parents('.file');

            if(x==y){
                band=1;
            }

            if(confirm('¿eliminar?')){
                delete_file.fadeOut('fast');
                delete_file.remove();
                /**
                 * Agregar desmanecimiento
                 * setTimeout(function (){},1000);
                 */
                x--;
                y=x-1;
            }

            if( (images_exist()==true) && (y==0 && x==1) || band==1) {
                create_div_img();
                band=0;
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

        if(x < MaxInputs)
        {
            //add new form img on DOM
            var newImg = clearFormImg;
            $('.container_images').append(newImg);
            $('.content_file').find('.file').unwrap('<div></div>');
            x++;
        }
        y++;

    }

    function images_exist(){

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
/**
 * Created by victor.escalante on 06/07/16.
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
                $result_address=resp.results[0].formatted_address;
                sendFormAddress($result_address);

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

        form_lat_f = parseFloat(form_lat);
        form_long_f = parseFloat(form_long);

        if(form_lat!='' && form_long!=''){
            $position = form_lat+","+form_long;
            getAddress($position);
            marker.setPosition({lat: form_lat_f, lng: form_long_f});
            map.setCenter({lat: getLat(), lng: getLong()});
            map.setZoom(16);
        }

    }

}



/*
(function($) {

    $.fn.parallax = function(options) {

        var windowHeight = $(window).height();

        // Establish default settings
        var settings = $.extend({
            speed        : 0.15
        }, options);

        // Iterate over each object in collection
        return this.each( function() {

            // Save a reference to the element
            var $this = $(this);

            // Set up Scroll Handler
            $(document).scroll(function(){

                var scrollTop = $(window).scrollTop();
                var offset = $this.offset().top;
                var height = $this.outerHeight();

                // Check if above or below viewport
                if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
                    return;
                }

                var yBgPosition = Math.round((offset - scrollTop) * settings.speed);

                // Apply the Y Background Position to Set the Parallax Effect
                $this.css('background-position', 'center ' + yBgPosition + 'px');

            });
        });
    }
}(jQuery));

$('.bg-1').parallax({
    speed :	0.25
});*/

// Functions for ajax
token = $("input[name='_token']").val();


/*
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
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



function active_sortable(){


    $( ".container_images" ).sortable({
        items: '> .dragActive',
        cursor: "move",
        revert: 100,
        opacity: 0.5,
    });


    $( ".container_images" ).disableSelection();
}


/**
 * Created by victor.escalante on 06/07/16.
 */

function files() {


    token = $("input[name='_token']").val();

    var clearFormImg = $('.content_file').html();

    function load_image() {
        $('html').on('click', '.image', function (event) {
            $(this).next(".select_image").trigger('click');
        });

    }

    function load_images_front() {


        $("html").on('change', '.select_image', function (event) {

            var fileImg = $(this);
            var id_footbridge = $('#id_footbridge').val();
            var inputtext = fileImg.next();
            var inputorder = inputtext.next();
            console.log("Este es el valro de input text "+inputtext.val());
            if(inputtext.val()==0){
                /*crea un nuevo registro */
                console.log(inputtext);
                var file = fileImg.context.files[0];
                var formData = new FormData();
                formData.append('_token', token);
                formData.append('id_footbridge', id_footbridge);
                formData.append('Photo', file);




                $.ajax(send_ajax('POST', '../../images/store', formData))
                    .done(function (value, status, xhr) {

                        print_file(fileImg);
                        inputtext.attr('id',value.id);
                        inputtext.attr('value',value.id);
                        inputorder.attr('value',value.id);

                    }).fail(function (jqXHR, textStatus, errorThrown) {

                    alert('Error al cargar imagen!!');

                }).always(function () {


                });

            }else{

                var update_file = $(this).parents('.file');
                var input_with_id = update_file.find('.id_img');
                var id_update = input_with_id.val();
                console.log("valor del id_img "+id_update);
                /* actualiza un registro */
                console.log(inputtext);
                var file = fileImg.context.files[0];
                var formData3 = new FormData();
                formData3.append('_token', token);
                formData3.append('_method', 'patch');
                formData3.append('Photo', file);
                formData3.append('id', id_update);




                $.ajax(send_ajax('POST', '../../images/update', formData3))
                    .done(function (value, status, xhr) {

                        print_file(fileImg);
                        inputtext.attr('id',value.id);
                        inputtext.attr('value',value.id);


                    }).fail(function (jqXHR, textStatus, errorThrown) {

                    alert('Error al actualizar imagen!!');

                }).always(function () {


                });

            }


        });


    }


    function create_new_div() {

        var newImg = clearFormImg;

        console.log('clearFormImg tiene: '+clearFormImg);

        $('.container_images').append(newImg);



        $('.content_file').find('.file').unwrap('<div></div>');


    }

    function print_file(fileImg) {

        var x=0;

        if (fileImg.parent('.file').hasClass('dragActive')) {
            var temp = 1;
        }

        var filesSelected = fileImg[0].files[0];

        if (filesSelected) {

            var fileReader = new FileReader();

            fileReader.onload = function (fileLoadedEvent) {

                var srcData = fileLoadedEvent.target.result; // <--- data: base64


                fileImg.parent('.file').find('.image').css({
                    'background': 'url(' + srcData + ')',
                });


                if (!temp) {

                    console.log("Entro x: "+x);

                    create_new_div();

                }

            }

            fileReader.readAsDataURL(filesSelected);

            fileImg.parent('.file').addClass('dragActive');


        }

    }

    // Methods the Send request Ajax

    function send_ajax(type, url, data) {

        var ajaxOptions =

        {

            type: type,
            url: url,
            data: data,
            contentType: false,
            processData: false,
            dataType: "json",
            cache: false,
            beforeSend: function () {

                console.log("enviando");

            },


        }

        return ajaxOptions;

    }

    function delete_image() {
        $('html').on('click','.add-delete ', function (event) {

            var delete_file = $(this).parents('.file');
            var input_with_id = delete_file.find('.id_img');
            var id_delete = input_with_id.val();


            if(confirm('¿eliminar?')){

                var formData2 = new FormData();
                console.log("id a eliminar: "+id_delete);
                console.log("Esto es lo que guarda el token: "+token);
                formData2.append('_token', token);
                formData2.append('_method', 'delete');
                formData2.append('id', id_delete);

                $.ajax(send_ajax('POST', '../../images/destroy', formData2))
                    .done(function (value, status, xhr) {

                        console.log('Eliminado correctamente');

                    }).fail(function (jqXHR, textStatus, errorThrown) {

                    alert('Error!!');

                }).always(function () {


                });

                // Delete of the DOOM
                delete_file.fadeOut('fast');
                delete_file.remove();

            }

            event.stopPropagation();

        });

    }



    load_image();
    load_images_front();
    delete_image();
}

//----------------------------------
//----------------------------------
//----------------------------------
function always(){

}
function oneTime(){

    //dropZone();
    files();
    active_sortable();

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

//# sourceMappingURL=all.js.map
