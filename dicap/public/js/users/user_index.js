$(document).ready(function() {
    $('table.paginacion').dataTable({
        "bSort": false,      
        "language": {
            "sPaginationType": "full_numbers",
            "lengthMenu": "Mostrar _MENU_ usuarios por página",
            "zeroRecords": "No se encontró resultados",
            "sInfo": "Mostrando desde el usuario _START_ hasta el usuario _END_ de un Total de _TOTAL_ usuarios",
            "infoEmpty": "No hay usuarios habilitados",
            "sInfoFiltered": "(filtrado de un total de _MAX_ usuarios)",
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
    $('input[type=search]').prop('title','Escriba una palabra para busar en la lista de Usuarios');

    $('select.input-sm').attr('data-toggle','tooltip');
    $('select.input-sm').prop('title','Indique el número de Usuarios que desea que se muestren por cada página');     
});

