$(document).ready(function() {

    var error_prov2 = $('#error_prov2'),
        prov = $('#prov'),
        icon_prov = $('#icon_prov'),
        nombre = $('#nombre'),
        idproveedor = $('#idproveedor'),
        cadena;
    
    $('#boton').click(clickBoton);

    function clickBoton() {

        error_prov2.hide();
        icon_prov.hide();

        prov.removeClass('has-error');

        cadena = (nombre.val()).toUpperCase();

        if(validarCamposVacios()) {
            $.get(ajaxUrlProveedorEdit, {id: idproveedor.val(), nombre: cadena}, function(data) {
                if(data.trim() === 'ok') {
                    $('#f').submit();
                }
                if(data.trim() === 'duplicado') {
                    prov.addClass('has-error');
                    icon_prov.show();
                    error_prov2.show();
                    nombre.focus();
                    return false;
                }
            });
        }
    }
});