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