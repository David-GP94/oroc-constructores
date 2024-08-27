var tabla;
var user_id = $('#user_id').val();
var user_role = $('#user_role').val();
function init(){
    $('#asignar_form').on("submit", function(e){
        guardar(e);
    });
}

$(document).ready(function(){
    $.post("../../controller/usuario.php?op=combo_soporte", function(data) {
        $('#usu_asig').html(data);
    });
    if (user_role == 1) {
        tabla = $('#ticket_data').dataTable({
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
                url: '../../controller/ticket.php?op=listar_x_usu',
                type: "post",
                dataType: "json",
                data:{ user_id : user_id},
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
                "sEmptyTable": "Ningún dato disponile en esta tabla",
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
    } else if (user_role == 2) {
        tabla = $('#ticket_data').dataTable({
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
                url: '../../controller/ticket.php?op=listar',
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
                "sInfo": "Mostrando un tptal de _TOTAL_ registros",
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
    }
    
});

function ver(ticket_id){
    console.log(ticket_id);
    window.open('http://localhost/exituscredithelpdesk/view/DetalleTicket/?Id='+ ticket_id +'');
}
function asignar(ticket_id){
    $('#ticket_id').val(ticket_id);
    $('#mdltitulo').html('Asignar Agente');
    $('#modal-asignar').modal('show');
}
function guardar(e){
 
    e.preventDefault();
    var formData = new FormData($('#asignar_form')[0]);
    $.ajax({
        url: "../../controller/ticket.php?op=update_asignacion_agente",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {

            $('#modal-asignar').modal('hide');
            $('#ticket_data').DataTable().ajax.reload();
        }
    });
}

init();