function init () {

}
$(document).ready(function(){
    var usu_id = $('#user_id').val();
    var rol_id = $('#rol_id').val();
    if (rol_id == 1) {
        $.post("../../controller/usuario.php?op=total", { usu_id : usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotal').html(data[0].TOTAL);
    
        });
        $.post("../../controller/usuario.php?op=totalabiertos", { usu_id : usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotalabiertos').html(data[0].TOTAL);
    
        });
        $.post("../../controller/usuario.php?op=totalcerrados", { usu_id : usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotalcerrados').html(data[0].TOTAL);
    
        });    
    }else {
        $.post("../../controller/ticket.php?op=total", function (data) {
            data = JSON.parse(data);
            $('#lbltotal').html(data[0].TOTAL);
    
        });
        $.post("../../controller/ticket.php?op=totalabiertos", function (data) {
            data = JSON.parse(data);
            $('#lbltotalabiertos').html(data[0].TOTAL);
    
        });
        $.post("../../controller/ticket.php?op=totalcerrados", function (data) {
            data = JSON.parse(data);
            $('#lbltotalcerrados').html(data[0].TOTAL);
    
        }); 
    }
    
});

init();