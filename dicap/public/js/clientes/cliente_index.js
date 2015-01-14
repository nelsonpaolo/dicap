$(document).ready(function() {

    $('#tabla_clientes').dataTable({
        "bSort": false,      
        "language": {
            "sPaginationType": "full_numbers",
            "lengthMenu": "Mostrar _MENU_ Clientes por página",
            "zeroRecords": "No se encontró resultados",
            "sInfo": "Mostrando desde el Cliente _START_ hasta el Cliente _END_ de un Total de _TOTAL_ Clientes",
            "infoEmpty": "No hay Clientes habilitados",
            "sInfoFiltered": "(filtrado de un total de _MAX_ Clientes)",
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
    $('input[type=search]').prop('title','Escriba una palabra para busar en la lista de Clientes');

    $('select.input-sm').attr('data-toggle','tooltip');
    $('select.input-sm').prop('title','Indique el número de Clientes que desea que se muestren por cada página');
});

function borrar(id) {

    var datos = id.split('^');

    $.get(ajaxUrlClienteBuscar, {id: datos[0]}, function(data) {
        if(data.trim() === 'ok') {
            bootbox.confirm('¿Seguro de eliminar el Cliente: <strong>'+datos[1]+'</strong> ?', function(result) {
                if(result == true){
                    $('#'+datos[0]).submit();
                }
            });
        }
        if(data.trim() === 'no_se_puede') {
            bootbox.alert('El cliente <strong>'+datos[1]+'</strong> está siendo usado en algún movimiento y NO puede ser Eliminado');
        }
    });            
}

