$(document).ready(function() {

    $('#tabla_productos').dataTable({
        "bSort": false,      
        "language": {
            "sPaginationType": "full_numbers",
            "lengthMenu": "Mostrar _MENU_ Productos por página",
            "zeroRecords": "No se encontró resultados",
            "sInfo": "Mostrando desde el Producto _START_ hasta el Producto _END_ de un Total de _TOTAL_ Productos",
            "infoEmpty": "No hay Productos habilitados",
            "sInfoFiltered": "(filtrado de un total de _MAX_ Productos)",
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
    $('input[type=search]').prop('title','Escriba una palabra para busar en la lista de Productos');

    $('select.input-sm').attr('data-toggle','tooltip');
    $('select.input-sm').prop('title','Indique el número de Productos que desea que se muestren por cada página');
});

function borrar(id) {

    var datos = id.split('^');

    $.get(ajaxUrlProductoBuscar, {id: datos[0]}, function(data) {
        if(data.trim() === 'ok') {
            bootbox.confirm('¿Seguro de eliminar el Producto: <strong>'+datos[1]+'</strong> ?', function(result) {
                if(result == true){
                    $('#'+datos[0]).submit();
                }
            });
        }
        if(data.trim() === 'no_se_puede') {
            bootbox.alert('El producto <strong>'+datos[1]+'</strong> está siendo usado en algún movimiento y NO puede ser Eliminado');
        }
    });            
}

