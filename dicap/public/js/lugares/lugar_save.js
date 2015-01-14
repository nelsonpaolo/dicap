$(document).ready(function() {

    var error_lug2 = $('#error_lug2'),
        lug = $('#lug'),
        icon_lug = $('#icon_lug'),
        nombre = $('#nombre'),
        cadena;
    
    $('#boton').click(clickBoton);

    function clickBoton() {

        error_lug2.hide();
        icon_lug.hide();

        lug.removeClass('has-error');

        cadena = (nombre.val()).toUpperCase();

        if(validarCamposVacios()) {
            $.get(ajaxUrlLugarAlta, {nombre: cadena}, function(data) {
                if(data.trim() === 'ok') {
                    $('#f').submit();
                }
                if(data.trim() === 'duplicado') {
                    lug.addClass('has-error');
                    icon_lug.show();
                    error_lug2.show();
                    nombre.focus();
                    return false;
                }
            });
        }
    }
});