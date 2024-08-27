function init() {
    $("#ticket_form").on("submit",function(e){
        Guardaryeditar(e);
    });
}
$(document).ready(function() {
    
});

function Guardaryeditar(e){
   
    
        e.preventDefault();
        var formData = new FormData($("#ticket_form")[0]);
        if ($('#ticket_desc').summernote('isEmpty') && $('#ticket_titulo').val() == '' && $('#cat_id').val() == 'Seleccione...' ) {
            swal("¡Advertencia!", "Los campos no pueden estar vacios", "warning");
        } else if ($('#ticket_titulo').val() == ''){
            swal("¡Advertencia!", "El título no puede estar vacío", "warning");
        } else if ($('#cat_id').val() == 'Seleccione...'){
            swal("¡Advertencia!", "La categoría no puede estar vacía", "warning");
        } else if ($('#ticket_desc').summernote('isEmpty')){
            swal("¡Advertencia!", "La descirpción no puede estar vacía", "warning");
        }else {
            var totalFiles = $('#fileElem').val().length;
            for (let index = 0; index < totalFiles; index++) {
              formData.append("files[]", $('#fileElem')[0].files[index]); 
                
            }
            $.ajax({
                url:"../../controller/ticket.php?op=insert",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos){
                    let selectCat = 0;
                    $.post("../../controller/categoria.php?op=combo&selectCat="+selectCat+"",function(data,status){
                        $('#cat_id').html(data);
                    });
                    $('#combo_2').addClass('hidde');
                    $('#combo_3').addClass('hidde');
                    $('#combo_4').addClass('hidde');
                    $('#ticket_titulo').val('');
                    $('#ticket_desc').summernote('reset');
                    swal("Correcto!", "Registrado Correctamente", "success");
                }
            });
        }
    
}
function agregarFila() {
    const tabla = document.getElementById('tablaCuerpo'); 
    const nuevaFila = tabla.insertRow(-1);

    const celdas = ['nombre[]', 'categoria[]', 'sueldo[]', 'horas_extras[]', 'sabado_domingo[]', 'total[]'];
    celdas.forEach((nombre, index) => {
        const nuevaCelda = nuevaFila.insertCell();
        let nuevoInput;

        if (nombre === 'categoria[]') {
            nuevoInput = document.createElement('select');
            nuevoInput.name = nombre;
            const opciones = ['Carpintero', 'Herrero', 'Otros'];
            opciones.forEach(opcion => {
                const opt = document.createElement('option');
                opt.value = opcion;
                opt.text = opcion;
                nuevoInput.appendChild(opt);
            });
        } else {
            nuevoInput = document.createElement('input');
            nuevoInput.type = (nombre === 'nombre[]') ? 'text' : 'number';
            nuevoInput.name = nombre;
            nuevoInput.oninput = () => { calcularTotal(nuevoInput); calcularTotalGeneral(); }; 
            if (nombre === 'total[]') {
                nuevoInput.readOnly = true;
            }
        }
        nuevaCelda.appendChild(nuevoInput);
    });
    calcularTotalGeneral(); 
}

function calcularTotal(input) {
    const fila = input.closest('tr');
    const sueldo = parseFloat(fila.cells[2].firstChild.value) || 0;
    const horasExtras = parseFloat(fila.cells[3].firstChild.value) || 0;
    const sabadoDomingo = parseFloat(fila.cells[4].firstChild.value) || 0;
    const total = sueldo + horasExtras + sabadoDomingo;
    fila.cells[5].firstChild.value = total;
}

function calcularTotalGeneral() {
    let totalGeneral = 0;
    const filas = document.querySelectorAll('tbody tr');
    filas.forEach(fila => {
        const totalFila = parseFloat(fila.cells[5].firstChild.value) || 0;
        totalGeneral += totalFila;
    });
    document.getElementById('totalGeneral').value = totalGeneral;
}
init();