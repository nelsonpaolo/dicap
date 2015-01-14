$(document).ready(function() {

    var error_cli2 = $('#error_cli2'),
        cli = $('#cli'),
        icon_cli = $('#icon_cli'),
        nombre = $('#nombre'),
        idcliente = $('#idcliente'),
        cadena;
    
    $('#boton').click(clickBoton);

    function clickBoton() {

        error_cli2.hide();
        icon_cli.hide();

        cli.removeClass('has-error');

        cadena = (nombre.val()).toUpperCase();

        if(validarCamposVacios()) {
            $.get(ajaxUrlClienteEdit, {id: idcliente.val(), nombre: cadena}, function(data) {
                if(data.trim() === 'ok') {
                    $('#f').submit();
                }
                if(data.trim() === 'duplicado') {
                    cli.addClass('has-error');
                    icon_cli.show();
                    error_cli2.show();
                    nombre.focus();
                    return false;
                }
            });
        }
    }
});