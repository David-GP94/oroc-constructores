function init() {
    $("#ticket_form").on("submit",function(e){
        // Guardaryeditar(e);
        GuardarNomina(e);
    });
}
$(document).ready(function() {
    $('#ticket_desc').summernote({
        height: 250,
        lang: "es-ES",
        popover: {
            image: [],
            link: [],
            air: []
        },
        callbacks: {
            onImageUpload: function(image) {
                console.log("Image detect...");
                console.log(image[0]);
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
    let selectCat = 0;
    $.post("../../controller/categoria.php?op=combo&selectCat="+selectCat+"",function(data,status){
        $('#cat_id').html(data);
    });
});

function GetCombo2() {
    let selectCat = document.getElementById("cat_id").value;
    $('#combo_3').addClass('hidde');
    $('#combo_4').addClass('hidde');
    $.post("../../controller/categoria.php?op=combo&selectCat="+selectCat+"",function(data,status){
        if (data.length > 0) {
            $('#cat_id_2').html(data);
            $('#combo_2').removeClass('hidde');
        }
        
    });
}
function GetCombo3() {
    let selectCat = document.getElementById("cat_id_2").value;
    $('#combo_4').addClass('hidde');
    $.post("../../controller/categoria.php?op=combo&selectCat="+selectCat+"",function(data,status){
        if (data.length > 0) {
            $('#cat_id_3').html(data);
            $('#combo_3').removeClass('hidde');
        }
        
    });
}
function GetCombo4() {
    let selectCat = document.getElementById("cat_id_3").value;
    $.post("../../controller/categoria.php?op=combo&selectCat="+selectCat+"",function(data,status){
        if (data.length > 0) {
            $('#cat_id_4').html(data);
            $('#combo_4').removeClass('hidde');
        }
        
    });
}
// function Guardaryeditar(e){
   
    
//         e.preventDefault();
//         var formData = new FormData($("#ticket_form")[0]);
//         if ($('#ticket_desc').summernote('isEmpty') && $('#ticket_titulo').val() == '' && $('#cat_id').val() == 'Seleccione...' ) {
//             swal("¡Advertencia!", "Los campos no pueden estar vacios", "warning");
//         } else if ($('#ticket_titulo').val() == ''){
//             swal("¡Advertencia!", "El título no puede estar vacío", "warning");
//         } else if ($('#cat_id').val() == 'Seleccione...'){
//             swal("¡Advertencia!", "La categoría no puede estar vacía", "warning");
//         } else if ($('#ticket_desc').summernote('isEmpty')){
//             swal("¡Advertencia!", "La descirpción no puede estar vacía", "warning");
//         }else {
//             var totalFiles = $('#fileElem').val().length;
//             for (let index = 0; index < totalFiles; index++) {
//               formData.append("files[]", $('#fileElem')[0].files[index]); 
                
//             }
//             $.ajax({
//                 url:"../../controller/ticket.php?op=insert",
//                 type: "POST",
//                 data: formData,
//                 contentType: false,
//                 processData: false,
//                 success: function(datos){
//                     let selectCat = 0;
//                     $.post("../../controller/categoria.php?op=combo&selectCat="+selectCat+"",function(data,status){
//                         $('#cat_id').html(data);
//                     });
//                     $('#combo_2').addClass('hidde');
//                     $('#combo_3').addClass('hidde');
//                     $('#combo_4').addClass('hidde');
//                     $('#ticket_titulo').val('');
//                     $('#ticket_desc').summernote('reset');
//                     swal("Correcto!", "Registrado Correctamente", "success");
//                 }
//             });
//         }
    
// }
function GuardarNomina (e) {
    e.preventDefault();
    $.post("../../controller/ticket.php?op=insertnomina&nombre=David&apellido=Garcia",function(data,status){
        console.log(data);
    });
}
init();