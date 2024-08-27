var tabla;
function init(){
    $("#usuario_form").on("submit", function(e){
        guardaryeditar(e);
    });
}

$(document).ready(function(){
        tabla = $('#usuario_data').dataTable({
            "aProcessing": true,
            "aServerSide": true,
            dom: 'Bfrtip',
            "searching": true,
            lengthChange: true,
            colReorder: true,
            buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                     ],
            "ajax":{
                url: '../../controller/usuario.php?op=listarusuario',
                type: "post",
                dataType: "json",
                error: function(e){
                    console.log("ERROR");
    
                    console.log(e);
                }
            },
            "bDestroy": true,
            "responsive": true,
            "bInfo": true,
            "iDsiplayLength": 10,
            "autoWidth": false,
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _Menu_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando un total de 0 registros",
                "sInfoFiltered": "(Filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sloadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirts": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior",
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
    
        }).dataTable();
    
    
});

function editar (usu_id) {
    $('#mdltitulo').html('Editar Usuario')
    $.post("../../controller/usuario.php?op=mostrarusuario",{ usu_id : usu_id}, function (data){
        data = JSON.parse(data);
         $('#usu_nom').val(data.usu_nom);
         $('#usu_ape').val(data.usu_ape);
         $('#usu_correo').val(data.usu_correo);
         $('#usu_pass').val(data.usu_pass);
         $('#usu_id').val(data.usu_id);
         $('#role_id').val(data.rol_id).trigger('change');
       

    });
    $('#modal-usuario').modal('show')   

}
function eliminar (usu_id) {
    swal({
        title: "¿Estas seguro que deseas eliminar el usuario?",
        text: "",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si, estoy seguro",
        cancelButtonText: "No, Cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/usuario.php?op=eliminar",{ usu_id : usu_id}, function (data){

            });
            $('#usuario_data').DataTable().ajax.reload();
            swal({
                title: "Exito",
                text: "¡Usuario eliminado correctamente!",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        } 
    });

}
$(document).on("click","#btn-nuevo", function(){
    $('#mdltitulo').html('Nuevo Usuario')
    $('#usuario_form')[0].reset();
    $('#modal-usuario').modal('show')
});
function guardaryeditar (e) {
    e.preventDefault();
    var formData = new FormData($('#usuario_form')[0]);
    $.ajax({
        url:"../../controller/usuario.php?op=guardaryeditar",
        type:"POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data){
            $('#usuario_form')[0].reset();
            $('#modal-usuario').modal('hide');
            $('#usuario_data').DataTable().ajax.reload();
            swal("Correcto!", "Registrado Correctamente", "success");
        }
    });
}


init();