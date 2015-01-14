$(document).ready(function() {

    $('#tabla_ingresos').dataTable({
        "bSort": false,      
        "language": {
            "sPaginationType": "full_numbers",
            "lengthMenu": "Mostrar _MENU_ Ingresos por página",
            "zeroRecords": "No se encontró resultados",
            "sInfo": "Mostrando desde el Ingreso _START_ hasta el Ingreso _END_ de un Total de _TOTAL_ Ingresos",
            "infoEmpty": "No hay Ingresos habilitados",
            "sInfoFiltered": "(filtrado de un total de _MAX_ Ingresos)",
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
    $('input[type=search]').prop('title','Escriba una palabra para busar en la lista de Ingresos');

    $('select.input-sm').attr('data-toggle','tooltip');
    $('select.input-sm').prop('title','Indique el número de Ingresos que desea que se muestren por cada página');
});
