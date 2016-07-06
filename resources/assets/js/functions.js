
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

