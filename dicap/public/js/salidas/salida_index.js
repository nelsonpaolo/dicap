$(document).ready(function() {

    $('#tabla_salidas').dataTable({
        "bSort": false,      
        "language": {
            "sPaginationType": "full_numbers",
            "lengthMenu": "Mostrar _MENU_ Salidas por página",
            "zeroRecords": "No se encontró resultados",
            "sInfo": "Mostrando desde la Salida _START_ hasta la Salida _END_ de un Total de _TOTAL_ Salidas",
            "infoEmpty": "No hay Salidas habilitados",
            "sInfoFiltered": "(filtrado de un total de _MAX_ Salidas)",
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
    $('input[type=search]').prop('title','Escriba una palabra para busar en la lista de Salidas');

    $('select.input-sm').attr('data-toggle','tooltip');
    $('select.input-sm').prop('title','Indique el número de Salidas que desea que se muestren por cada página');
});
