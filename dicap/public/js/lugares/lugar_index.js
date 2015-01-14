$(document).ready(function() {

    $('#tabla_lugares').dataTable({
        "bSort": false,      
        "language": {
            "sPaginationType": "full_numbers",
            "lengthMenu": "Mostrar _MENU_ Lugares por página",
            "zeroRecords": "No se encontró resultados",
            "sInfo": "Mostrando desde el Lugar _START_ hasta el Lugar _END_ de un Total de _TOTAL_ Lugares",
            "infoEmpty": "No hay Lugares habilitados",
            "sInfoFiltered": "(filtrado de un total de _MAX_ Lugares)",
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
    $('input[type=search]').prop('title','Escriba una palabra para busar en la lista de Lugares');

    $('select.input-sm').attr('data-toggle','tooltip');
    $('select.input-sm').prop('title','Indique el número de Lugares que desea que se muestren por cada página');
});

function borrar(id) {

    var datos = id.split('^');

    $.get(ajaxUrlLugarBuscar, {id: datos[0]}, function(data) {
        if(data.trim() === 'ok') {
            bootbox.confirm('¿Seguro de eliminar el Lugar: <strong>'+datos[1]+'</strong> ?', function(result) {
                if(result == true){
                    $('#'+datos[0]).submit();
                }
            });
        }
        if(data.trim() === 'no_se_puede') {
            bootbox.alert('El lugar <strong>'+datos[1]+'</strong> está siendo usado en algún movimiento y NO puede ser Eliminado');
        }
    });            
}

