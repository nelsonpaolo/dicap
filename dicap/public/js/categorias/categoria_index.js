$(document).ready(function() {

    $('#tabla_categorias').dataTable({
        "bSort": false,      
        "language": {
            "sPaginationType": "full_numbers",
            "lengthMenu": "Mostrar _MENU_ Categorias por página",
            "zeroRecords": "No se encontró resultados",
            "sInfo": "Mostrando desde la Categoria _START_ hasta la Categoria _END_ de un Total de _TOTAL_ Categorias",
            "infoEmpty": "No hay Categorias habilitadas",
            "sInfoFiltered": "(filtrado de un total de _MAX_ Categorias)",
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
    $('input[type=search]').prop('title','Escriba una palabra para busar en la lista de Categorias');

    $('select.input-sm').attr('data-toggle','tooltip');
    $('select.input-sm').prop('title','Indique el número de Categorias que desea que se muestren por cada página');
});

function borrar(id) {

    var datos = id.split('^');

    $.get(ajaxUrlCategoriaBuscar, {id: datos[0]}, function(data) {
        if(data.trim() === 'ok') {
            bootbox.confirm('¿Seguro de eliminar la Categoria: <strong>'+datos[1]+'</strong> de la Marca: <strong>"'+datos[2]+'"</strong>?', function(result) {
                if(result == true){
                    $('#'+datos[0]).submit();
                }
            });
        }
        if(data.trim() === 'no_se_puede') {
            bootbox.alert('La categoria <strong>'+datos[1]+'</strong> está siendo usada en algún producto y NO puede ser Eliminada');
        }
    });            
}

