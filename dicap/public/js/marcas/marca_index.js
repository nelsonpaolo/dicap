$(document).ready(function() {

    $('#tabla_marcas').dataTable({
        "bSort": false,      
        "language": {
            "sPaginationType": "full_numbers",
            "lengthMenu": "Mostrar _MENU_ Marcas por página",
            "zeroRecords": "No se encontró resultados",
            "sInfo": "Mostrando desde la Marca _START_ hasta la Marca _END_ de un Total de _TOTAL_ Marcas",
            "infoEmpty": "No hay Marcas habilitadas",
            "sInfoFiltered": "(filtrado de un total de _MAX_ Marcas)",
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
    $('input[type=search]').prop('title','Escriba una palabra para busar en la lista de Marcas');

    $('select.input-sm').attr('data-toggle','tooltip');
    $('select.input-sm').prop('title','Indique el número de Marcas que desea que se muestren por cada página');
});

function borrar(id) {

    var datos = id.split('^');

    $.get(ajaxUrlMarcaBuscar, {id: datos[0]}, function(data) {
        if(data.trim() === 'ok') {
            bootbox.confirm('¿Seguro de eliminar la Marca: <strong>'+datos[1]+'</strong> ?', function(result) {
                if(result == true){
                    $('#'+datos[0]).submit();
                }
            });
        }
        if(data.trim() === 'no_se_puede') {
            bootbox.alert('La marca <strong>'+datos[1]+'</strong> está siendo usada en algún producto y/o categoría y NO puede ser Eliminada');
        }
    });            
}

