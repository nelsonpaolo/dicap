$(document).ready(function() {

    var error_cat2 = $('#error_cat2'),
        cat = $('#cat'),
        mar = $('#mar'),
        icon_cat = $('#icon_cat'),
        icon_mar = $('#icon_mar'),
        nombre = $('#nombre'),
        marca = $('#marca'),
        cadena;
    
    $('#boton').click(clickBoton);

    function clickBoton() {

        error_cat2.hide();
        icon_cat.hide();
        icon_mar.hide();

        cat.removeClass('has-error');
        mar.removeClass('has-error');

        cadena = (nombre.val()).toUpperCase();

        if(validarCamposVacios()) {
            $.get(ajaxUrlCategoriaAlta, {nombre: cadena, marca: marca.val()}, function(data) {
                if(data.trim() === 'ok') {
                    $('#f').submit();
                }
                if(data.trim() === 'duplicado') {
                    cat.addClass('has-error');
                    mar.addClass('has-error');
                    error_cat2.show();
                    icon_cat.show();
                    icon_mar.show();
                    nombre.focus();
                    return false;
                }
            });
        }
    }
});