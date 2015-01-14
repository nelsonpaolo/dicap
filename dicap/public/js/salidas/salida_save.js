$(document).ready(function() {

    var error_cod2 = $('#error_cod2'),
        cod = $('#cod'),
        icon_cod = $('#icon_cod'),
        codigo = $('#codigo'),
        fecha = $('#fecha'),
        idproveedor = $('#idproveedor'),
        agregar_producto = $('#agregar_producto'),
        tabla_foot = $('#tabla_productos tfoot'),
        tabla_body = $('#tabla_productos tbody'),
        error_agrpro = $('#error_agrpro'),
        producto = $('#producto'),
        error_prod2 = $('#error_prod2'),
        error_prod3 = $('#error_prod3'),
        prod = $('#prod'),
        icon_prod = $('#icon_prod'),
        lugar = $('#lugar'),
        filasprod = $('#filasprod'),
        agrpro = $('#agrpro'),
        flagprod = filasprod.val(),
        codigo_i,
        lugar_i,
        cadena,
        json_obj,
        i,
        valido,
        body_codigo,
        body_nombre,
        body_lugar,
        body_stock,
        body_precio,
        body_cantidad,
        body_total,
        body_quitar;

    fecha.datepicker();
    fecha.keydown(function(event) {
        event.preventDefault();
    });

    tabla_foot.hide();

    agregar_producto.on('click', clickAgregar);

    function clickAgregar() {
        if(validarCamposAlAgregar('PRO')) {
            error_prod2.hide();
            error_prod3.hide();
            icon_prod.hide();
            prod.removeClass('has-error');
            agregar_producto.button('loading');
            $.get(ajaxUrlGetDatosProdLug, {codigo: producto.val(), idlugar: lugar.val()}, function(data) {
                json_obj = $.parseJSON(data);
                if(json_obj.producto == 'no_registrado') {
                    error_prod2.show();
                    icon_prod.show();
                    prod.addClass('has-error');
                    producto.focus();
                    
                }
                else if(json_obj.producto == 'no_hay') {
                    error_prod3.show();
                    icon_prod.show();
                    prod.addClass('has-error');
                    producto.focus();
                }
                else {
                    for (i = 1; i <= flagprod; i++) {
                        codigo_i = $('#codigo'+i);
                        lugar_i = $('#lugar'+i);
                        if((producto.val()).toUpperCase() == codigo_i.val() && lugar.val() == lugar_i.val()) {
                            bootbox.alert('Ya agregaste el producto: <strong>'+json_obj.producto+'</strong> en el lugar: <strong>'+json_obj.lugar+'</strong> a la lista.');
                            producto.val('');
                            lugar.val('');
                            return false;
                        }
                    }
                    flagprod++;
                    agrpro.removeClass('has-error');
                    error_agrpro.hide();
                    tabla_foot.show();
                    body_codigo = '<td><input type="hidden" name="codigo'+flagprod+'" id="codigo'+flagprod+'" value="'+(producto.val()).toUpperCase()+'" />'+(producto.val()).toUpperCase()+'</td>';
                    body_nombre = '<td><input type="hidden" name="producto'+flagprod+'" value="'+json_obj.idproducto+'" />'+json_obj.producto+'</td>';
                    body_lugar = '<td><input type="hidden" name="lugar'+flagprod+'" id="lugar'+flagprod+'" value="'+lugar.val()+'" />'+json_obj.lugar+'</td>';
                    body_stock = '<td align="center"><input type="hidden" name="stock'+flagprod+'" id="stock-'+flagprod+'" value="'+json_obj.stock+'" />'+json_obj.stock+'</td>';
                    body_precio = '<td><div class="form-group notempty has-feedback" id="pre'+flagprod+'"><input type="text" class="form-control decimal calc" name="precio'+flagprod+'" id="precio-'+flagprod+'" value="'+json_obj.precio+'" placeholder="Precio Ven." data-toggle="tooltip" title="Precio Unitario de Venta" onkeypress="return validarDecimales(event, this.id)" onchange="calculosProductos()"/><span style="display:none;" id="icon_pre'+flagprod+'" class="glyphicon glyphicon-remove form-control-feedback"></span><span style="display:none;" class="help-block" id="error_pre'+flagprod+'">Indique el Precio Unitario de Compra.</span></div></td>';
                    body_cantidad = '<td><div class="form-group notempty has-feedback" id="can'+flagprod+'"><input type="text" class="form-control" name="cantidad'+flagprod+'" id="cantidad-'+flagprod+'" placeholder="Cantidad" data-toggle="tooltip" title="Cantidad" onkeypress="return validarNumeros(event)" onchange="cambioCantidad(this.id, this.value)"/><span style="display:none;" id="icon_can'+flagprod+'" class="glyphicon glyphicon-remove form-control-feedback"></span><span style="display:none;" class="help-block" id="error_can'+flagprod+'">Indique la Cantidad.</span></div></td>';
                    body_total = '<td><div class="form-group" id="tot'+flagprod+'"><input type="text" class="form-control" name="total'+flagprod+'" id="total-'+flagprod+'" placeholder="Sub Total" data-toggle="tooltip" title="Sub Total" readonly/></div></td>';
                    body_quitar = '<td align="center"><a onclick="eliminar(this.id);" id="flagprod'+flagprod+'" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Click aquí para quitar esta fila de la lista"><span class="glyphicon glyphicon-trash"></span> <strong>Quitar</strong></a></td>';
                    tabla_body.append('<tr class="flagprod'+flagprod+'" style="background-color: rgb(255, 255, 255);">'+body_codigo+body_nombre+body_lugar+body_stock+body_precio+body_cantidad+body_total+body_quitar+'</tr>');

                    producto.val('');
                    lugar.val('');
                    filasprod.val(flagprod);
                    ajustarDecimales();
                }

            }).always(function () {
                agregar_producto.button('reset')
            });                
        }
    }
    
    $('#boton').click(clickBoton);

    function clickBoton() {

        valido = true;

        error_cod2.hide();
        icon_cod.hide();

        cod.removeClass('has-error');

        cadena = (codigo.val()).toUpperCase();

        if(!validarCamposVacios()) {
            valido = false;
        }

        if(!validarTablasVacias()) {
            valido = false;
        }

        if(valido) {
            $.get(ajaxUrlSalidaAlta, {codigo: cadena}, function(data) {
                if(data.trim() === 'ok') {
                    bootbox.confirm('Cuando los datos de la Salida se registren NO prodrán ser <strong>Editados</strong> o <strong>Eliminados</strong> <br> ¿Desea proceder con el Registro de la Salida?', function(result) {
                        if(result == true){
                            $('#f').submit();
                        }
                    });
                }
                if(data.trim() === 'duplicado') {
                    cod.addClass('has-error');
                    icon_cod.show();
                    error_cod2.show();
                    codigo.focus();
                    return false;
                }
            });
        }
    }
});

function eliminar(datos) {

    $('.'+datos).hide('slow', function() {
        $('.'+datos).remove();
        if($('#tabla_productos tbody tr').length == 0) {
            $('#tabla_productos tfoot').hide();
        }
        calculosProductos();
    });
}

function cambioCantidad(id, value) {

    var datos = id.split('-'),
        stock = $('#stock-'+datos[1]).val();

    if(parseInt(value) > parseInt(stock)) {
        $('#'+id).val(stock);
    }
    calculosProductos();
}

function calculosProductos() {

    var input_clase = $('#tabla_productos input.calc'),
        costo = $('#costo'),
        inputprecio,
        inputcantidad,
        inputtotal,
        idinput,
        datos,
        suma_precio = 0,
        i;

    ajustarDecimales();

    for (i = 0; i < input_clase.length; i++) {

        inputprecio = $(input_clase[i]);
        idinput = inputprecio.attr('id');
        datos = idinput.split('-');
        inputcantidad = $('#cantidad-'+datos[1]);
        inputtotal = $('#total-'+datos[1]);

        if(inputprecio.val() != '' && inputcantidad.val() != '') {
            total_valor = Math.round(inputprecio.val() * inputcantidad.val() * 100) / 100;
            if(total_valor > 0) {
                inputtotal.val(total_valor);
            }
            else {
                inputtotal.val('');
            }
            suma_precio = suma_precio + parseFloat(inputtotal.val());
        }
        else {
            inputtotal.val('');
        }
    }

    if(suma_precio > 0) {
        costo.val(Math.round(suma_precio * 100) / 100);
    }
    else {
        costo.val('');   
    }
}