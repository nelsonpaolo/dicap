$(document).ready(function() {

    var error_use2 = $('#error_use2'),
        error_pas2 = $('#error_pas2'),
        use = $('#use'),
        pas = $('#pas'),
        con = $('#con'),
        icon_pas = $('#icon_pas'),
        icon_con = $('#icon_con'),
        icon_use = $('#icon_use'),
        username = $('#username'),
        password = $('#password'),
        repassword = $('#repassword');

    $('#boton').click(function() {

        error_use2.hide();
        error_pas2.hide();

        icon_pas.hide();
        icon_con.hide();
        icon_use.hide();

        use.removeClass('has-error');
        pas.removeClass('has-error');

        if(password.val() != '') {
            if(password.val() != repassword.val()) {
                pas.addClass('has-error');
                con.addClass('has-error');
                icon_pas.show();
                icon_con.show();
                error_pas2.show();
                password.val('');
                repassword.val('');
                password.focus();
                return false;
            }
        }
           
        if(validarCamposVacios()) {
            $.get(ajaxUrlUserEdit, {id: $('#iduser').val(), username: username.val()}, function(data) {
                if(data.trim() === 'ok') {
                    $('#f').submit();
                }
                if(data.trim() === 'duplicado') {
                    use.addClass('has-error');
                    icon_use.show();
                    error_use2.show();
                    username.focus();
                    return false;
                }
            });
        }
    });
});