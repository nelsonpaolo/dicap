$(document).ready(function() {

    var pass = $('#pass'),
        nuevopass = $('#nuevopass'),
        repass = $('#repass'),
        nuevo = $('#nuevo'),
        con = $('#con'),
        pas = $('#pas'),
        icon_nuevo = $('#icon_nuevo'),
        icon_con = $('#icon_con'),
        error_pas2 = $('#error_pas2'),
        error_nuevo2 = $('#error_nuevo2');

    $('#boton').click(function() {

    	nuevo.removeClass('has-error');
    	con.removeClass('has-error');
        pas.removeClass('has-error');
        error_pas2.hide();
    	error_nuevo2.hide();
        icon_con.hide();
        icon_nuevo.hide();

        if(nuevopass.val() != repass.val()) {
        	nuevo.addClass('has-error');
        	con.addClass('has-error');
            icon_con.show();
            icon_nuevo.show();
            nuevopass.val('');
            repass.val('');
            nuevopass.focus();
        	error_nuevo2.show();
        	return false;
        }

        if(validarCamposVacios()) {
            $.get(ajaxUrlPass, {pass: pass.val()}, function(data) {
                if(data.trim() === 'ok') {
                    $.post(ajaxUrlUpdatePost, {nuevopass: nuevopass.val()}, function(data) {
                        if(data.trim() === 'ok') {
                            $('#mensaje').slideDown();
                            pass.val('');
                            nuevopass.val('');
                            repass.val('');
                        }
                    });
                }
                if(data.trim() === 'duplicado') {
                    pas.addClass('has-error');
                    error_pas2.show();
                    return false;
                }
            });
        }
    });
});