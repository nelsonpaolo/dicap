$(document).ready(function() {

    var filas = $('#tabla_forms tbody tr').length;

    $('#tabla_forms').dataTable({
        "bSort": false,
        "language": {
            "sPaginationType": "full_numbers",
            "lengthMenu": "Mostrar _MENU_ formularios por página",
            "zeroRecords": "No se encontró resultados",
            "sInfo": "Mostrando desde el formulario _START_ hasta el formulario _END_ de un Total de _TOTAL_ formularios",
            "infoEmpty": "No hay formularios habilitados",
            "sInfoFiltered": "(filtrado de un total de _MAX_ formularios)",
            "sSearch": "Buscar: ",
            "oPaginate": {
              "sFirst":    "Primero",
              "sPrevious": "Anterior",
              "sNext":     "Siguiente",
              "sLast":     "Último"
            }
        }  
    });

    $('input[type=search]').attr('data-toggle','tooltip');
    $('input[type=search]').prop('title','Escriba una palabra para busar en la lista de Formularios');

    $('select.input-sm').attr('data-toggle','tooltip');
    $('select.input-sm').prop('title','Indique el número de Formularios que desea que se muestren por cada página');     

    if(filas == 0) {
        $('#tabla_forms_wrapper').hide();
        $('#tabla_forms').hide();
        $('#mensaje').slideDown();             
    }
});