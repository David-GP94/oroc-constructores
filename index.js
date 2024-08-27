function init(){

}
$(document).ready(function(){

});
$(document).on("click","#btnsoporte", function() {
    if ($('#rol_id').val() == 1) {
        $('#lbltitulo').html("Acceso Soporte");
        $('#btnsoporte').html("Acceso Usuario");
        $('#rol_id').val(2);
        $('#img-profile').attr("src", "public/img/2.png");
    }else{
        $('#lbltitulo').html("Acceso Usuario");
        $('#btnsoporte').html("Acceso Soporte");
        $('#rol_id').val(1);
        $('#img-profile').attr("src", "public/img/1.png");
    }
 
});

init();