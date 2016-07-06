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