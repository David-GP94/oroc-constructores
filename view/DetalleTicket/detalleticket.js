function init () {

}
$(document).ready(function() {
    var ticket_id = getUrlparameter('Id');
    listardetalle(ticket_id);
    
    $('#ticket_desc_resp').summernote({
        height: 400,
        lang: "es-ES",
        callbacks: {
            onImageUpload: function(image) {
                
            },
            onPaste: function(e) {

            }
        },
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
    $('#ticket_desc_read').summernote({
        height: 400,
        lang: "es-ES",
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
    $('#ticket_desc_read').summernote('disable');

    
});

var getUrlparameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
        
    }
}

$(document).on("click","#btn-enviar", function(){
    var ticket_id = getUrlparameter('Id');
    var usu_id = $('#user_id').val();
    var ticket_desc = $('#ticket_desc_resp').val();
    if ($('#ticket_desc_resp').summernote('isEmpty')) {
        swal("¡Advertencia!", "La descirpción no puede estar vacía", "warning");
    }else {
        $.post("../../controller/ticket.php?op=insert_ticket_detalle", { ticket_id : ticket_id, usu_id : usu_id, ticket_desc : ticket_desc}, function(data) {
            listardetalle(ticket_id);
            $('#ticket_desc_resp').summernote('reset');
            swal("¡Correcto!", "Respuesta enviada correctamente","success");
    
        });
    }
   
});

$(document).on("click","#btn-cerrar-ticket", function(){
    swal({
        title: "¿Estas seguro que deseas cerrar el ticket?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si, estoy seguro",
        cancelButtonText: "No, Cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    },
    function(isConfirm) {
        if (isConfirm) {
            var usu_id = $('#user_id').val();
            var ticket_id = getUrlparameter('Id');
            $.post("../../controller/ticket.php?op=update_estado_ticket",{ticket_id : ticket_id, usu_id : usu_id}, function (data){

            });
            listardetalle(ticket_id);
            swal({
                title: "Exito",
                text: "¡Ticket cerrado correctamente!",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        } 
    });

});
function listardetalle (ticket_id){
    $.post("../../controller/ticket.php?op=listardetalle",{ ticket_id : ticket_id}, function (data) {
        $('#lbl-detalle').html(data)
     });
     $.post("../../controller/ticket.php?op=mostrar",{ticket_id : ticket_id}, function (data){
        data = JSON.parse(data);
        $('#lbl-estado').html(data.ticket_estado);
        $('#lbl-nom-usuario').html(data.usu_nom +" "+data.usu_ape);
        $('#lbl-fecha-creacion').html(data.fecha_creacion);
        $('#lbl-id-ticket').html("Detalle Ticket - "+ticket_id);
        $('#ticket_titulo').val(data.ticket_titulo);
        $('#ticket_desc_read').summernote('code',data.ticket_desc);
        if (data.ticket_estado_texto == "Cerrado") {
            $('#pnl-detalle').hide();
        }
        
    });
}
init();