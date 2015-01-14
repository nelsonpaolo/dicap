$(document).ready(function() {

    var use = $('#use'),
        rol = $('#rol'),
        iduser = $('#iduser'),
        idrol = $('#idrol');

    $('#boton').click(function() {
        use.removeClass('has-error');
        rol.removeClass('has-error');

        if(validarCamposVacios()) {
            $.get(ajaxUrlAsignarRol, {idrol: idrol.val(), iduser: iduser.val()}, function(data) {
                if(data.trim() === 'ok') {
                    $('#f').submit();
                }
                if(data.trim() === 'duplicado') {
                    use.addClass('has-error');
                    rol.addClass('has-error');
                    $('#error_use2').show();
                    iduser.focus();
                    return false;
                }
            });
        }
    });
});