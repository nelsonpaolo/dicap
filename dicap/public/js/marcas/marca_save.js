$(document).ready(function() {

    var error_mar2 = $('#error_mar2'),
        mar = $('#mar'),
        icon_mar = $('#icon_mar'),
        nombre = $('#nombre'),
        cadena;
    
    $('#boton').click(clickBoton);

    function clickBoton() {

        error_mar2.hide();
        icon_mar.hide();

        mar.removeClass('has-error');

        cadena = (nombre.val()).toUpperCase();

        if(validarCamposVacios()) {
            $.get(ajaxUrlMarcaAlta, {nombre: cadena}, function(data) {
                if(data.trim() === 'ok') {
                    $('#f').submit();
                }
                if(data.trim() === 'duplicado') {
                    mar.addClass('has-error');
                    icon_mar.show();
                    error_mar2.show();
                    nombre.focus();
                    return false;
                }
            });
        }
    }
});