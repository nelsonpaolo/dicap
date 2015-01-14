$(document).ready(function() {

    var error_pro2 = $('#error_pro2'),
        pro = $('#pro'),
        icon_pro = $('#icon_pro'),
        codigo = $('#codigo'),
        idproducto = $('#idproducto'),
        marca = $('#marca'),
        categoria = $('#categoria'),
        cadena,
        optionSelect,
        json_obj,
        i;

    marca.on('change', cambioMarca);

    function cambioMarca() {

        optionSelect = '';
        categoria.html('<option value="">Seleccione una Categoría</option>');
        $.get(ajaxUrlGetCategorias, {marca: marca.val()}, function(data) {
            json_obj = $.parseJSON(data);
            for (i in json_obj) {
                if (!json_obj.hasOwnProperty(i)) continue;
                optionSelect = optionSelect + '<option value="'+json_obj[i].id+'">'+json_obj[i].nombre+'</option>';
            }
            categoria.append(optionSelect);
        });
    }
    
    $('#boton').click(clickBoton);

    function clickBoton() {

        error_pro2.hide();
        icon_pro.hide();

        pro.removeClass('has-error');

        cadena = (codigo.val()).toUpperCase();

        if(validarCamposVacios()) {
            $.get(ajaxUrlProductoEdit, {id: idproducto.val(), codigo: cadena}, function(data) {
                if(data.trim() === 'ok') {
                    $('#f').submit();
                }
                if(data.trim() === 'duplicado') {
                    pro.addClass('has-error');
                    icon_pro.show();
                    error_pro2.show();
                    codigo.focus();
                    return false;
                }
            });
        }
    }
});