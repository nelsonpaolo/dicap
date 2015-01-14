
//cambiar el idioma del datepicker a español
$.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: 'Anterior',
    nextText: 'Siguiente',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd-M-yy',
    //dateFormat: 'yy-mm-dd',
    firstDay: 1,
    isRTL: false,
    changeMonth: true,
    changeYear: true,
    showMonthAfterYear: false,
    yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['es']);

$(document).ready(function() {

    var link_efecto1 = $('#nav_opc a'),
        link_efecto2 = $('#nav_opc a.efecto');

    link_efecto1.mouseenter(efecto);

    link_efecto1.mouseleave(normal);

    function efecto() {
        $(this).animate({fontSize:'18px'}, "fast");
    }

    function normal() {
        $(this).animate({fontSize:'14px'}, "fast");
    }

    link_efecto2.mouseenter(efecto2);

    link_efecto2.mouseleave(normal2);

    function efecto2() {
        $(this).animate({color: '#FF7C00', fontSize:'17px'}, "fast");
    }

    function normal2() {
        $(this).animate({color: '#5A6AD2', fontSize:'14px'}, "fast");
    }

    //ACTIVAR LOS ESTILOS EN TODOS LOS TOOLTIPS
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });   

    //FONDO BLANCO AL BACKGROUND DEL CONTENIDO DEL TBODY DE TODAS LAS TABLAS
    $('tbody tr').css( "background-color", "white" );

    //TITÚLOS DE CADA SECCIÓN RESALTADOS CON COLOR PLOMO
    $('.titulo').css( "background-color", "#A4A4A4" );

    //AJUSTE DE LOS DEDIMALES
    ajustarDecimales();
    $('input.decimal').on('change', ajustarDecimales);
});

function validarCamposVacios() {
    var notempty = true,
        inputnotempy = $('div.notempty'),
        thisinput,
        i,
        id_div,
        id_input,
        id_pass,
        id_select,
        id_textarea,
        id_span,
        id_span_icon;

    for (i = 0; i < inputnotempy.length; i++) {
        thisinput = $(inputnotempy[i]);
        id_div = thisinput.attr('id');
        id_input = $('#'+id_div+' input[type=text]').attr('id');
        id_pass = $('#'+id_div+' input[type=password]').attr('id');
        id_select = $('#'+id_div+' select').attr('id');
        id_textarea = $('#'+id_div+' textarea').attr('id');
        id_span = 'error_'+id_div;
        id_span_icon = 'icon_'+id_div;
        if($('#'+id_input).val() == '' || $('#'+id_input).val() == '0' || $('#'+id_pass).val() == '' || $('#'+id_pass).val() == '0' || $('#'+id_select).val() == '' || $('#'+id_textarea).val() == '') {
            $('#'+id_div).addClass('has-error');
            $('#'+id_span).show();
            $('#'+id_span_icon).show();
            notempty = false;
        }
        else {
            $('#'+id_div).removeClass('has-error'); 
            $('#'+id_span).hide();
            $('#'+id_span_icon).hide();
        }
    }
    return notempty;
}

function validarCamposAlAgregar(seccion) {
    var notempty = true,
        inputnotempy = $('div.notempty'+seccion),
        thisinput,
        i,
        id_div,
        id_input,
        id_select,
        id_span,
        id_span_icon;

    for (i = 0; i < inputnotempy.length; i++) {
        thisinput = $(inputnotempy[i]);
        id_div = thisinput.attr('id');
        id_input = $('#'+id_div+' input[type=text]').attr('id');
        id_select = $('#'+id_div+' select').attr('id');
        id_span = 'error_'+id_div;
        id_span_icon = 'icon_'+id_div;
        if($('#'+id_input).val() == '' || $('#'+id_input).val() == '0' || $('#'+id_select).val() == '') {
            $('#'+id_div).addClass('has-error');
            $('#'+id_span).show();
            $('#'+id_span_icon).show();
            notempty = false;
        }
        else {
           $('#'+id_div).removeClass('has-error'); 
           $('#'+id_span).hide();
           $('#'+id_span_icon).hide();
        }
    }        
    return notempty;
}


function validarMarcados() {
    var marcados = true,
        inputmarcados = $('div.marcados'),
        thisinput,
        i,
        id_div,
        marcados_check,
        marcados_radio,
        id_span;

    for (i = 0; i < inputmarcados.length; i++) {
        thisinput = $(inputmarcados[i]);
        id_div = thisinput.attr('id');
        marcados_check = $('#'+id_div+' input[type=checkbox]:checked').length;
        marcados_radio = $('#'+id_div+' input[type=radio]:checked').length;
        id_span = 'error_'+id_div;
        if(marcados_check == 0 && marcados_radio == 0) {
            $('#'+id_div).addClass('has-error');
            $('#'+id_span).show();
            marcados = false;
        }
        else {
           $('#'+id_div).removeClass('has-error'); 
           $('#'+id_span).hide();
        }
    }
    return marcados;
}


function validarTablasVacias() {
    var filas = true,
        inputfilas = $('div.rowreq'),
        thisinput,
        i,
        id_div,
        numfilas,
        id_span;

    for (i = 0; i < inputfilas.length; i++) {
        thisinput = $(inputfilas[i]);
        id_div = thisinput.attr('id');
        numfilas = $('#'+id_div+' table tbody tr').length;
        id_span = 'error_'+id_div;
        if(numfilas == 0) {
             $('#'+id_div).addClass('has-error');
             $('#'+id_span).show();
             filas = false;   
        }
        else {
             $('#'+id_div).removeClass('has-error'); 
             $('#'+id_span).hide();
        }
    }
    return filas;
}

function validarLetrasNumeros(e) {
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890.,_-;:' ";
   especiales = "8-37-39-46";

   tecla_especial = false
   for(var i in especiales){
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if(letras.indexOf(tecla)==-1 && !tecla_especial) {
        return false;
    }
}

function validarLetras(e) {
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
   especiales = "8-37-39-46";

   tecla_especial = false
   for(var i in especiales){
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if(letras.indexOf(tecla)==-1 && !tecla_especial) {
        return false;
    }
}

function validarNumeros(e) {
    var expresion=/^-?[0-9]+([,\.][0-9]*)?$/;
    return expresion.test(String.fromCharCode(e.which));
}

function validarDecimales(e, id) {
    //var expresion=/^(\d|-)?(\d|)*\.?\d*$/;
    //return expresion.test(String.fromCharCode(e.which));
    var key = e.keyCode;
    cadena = $('#'+id).val();

    if(cadena.indexOf('.') == 0) {
        cadena = '0'+cadena;
        $('#'+id).val(cadena);
        return (key <= 13 || (key >= 48 && key <= 57));
    }
    else {
        if(cadena.indexOf('.') == -1) {
            return (key <= 13 || (key >= 48 && key <= 57) || key == 46);
        }
        else {
            return (key <= 13 || (key >= 48 && key <= 57));
        }
    }
}

function ajustarDecimales() {
    var inputsDecimales = $('input.decimal'),
        i,
        thisinput,
        cadena;

    for(i = 0; i<inputsDecimales.length; i++) {
        thisinput = $(inputsDecimales[i]);
        cadena = thisinput.val();
        if(cadena.indexOf('.') == cadena.length-1) {
            cadena = cadena.substr(0, cadena.length-1);
        }
        if(cadena.indexOf('.') == 0) {
            cadena = '0'+cadena;
        }
        cadena = Math.round(cadena * 100) / 100;
        if(cadena > 0) {
            thisinput.val(cadena);
        }
        else {
            thisinput.val('');
        }        
    }
}

/**
 * función que recibe un string que es la fecha en formato dd-M-yy y la convierte al formato yy-mm-dd
 * @param  string fecha esta es la fecha que se recibe
 * @return string resultado es la fecha que se decuelve en el nuevo formato
 */
function formatoFecha(fecha) {
    var abrev = { Ene:'01', Feb:'02', Mar:'03', Abr:'04', May:'05', Jun:'06', Jul:'07', Ago:'08', Sep:'09', Oct:'10', Nov:'11', Dic:'12' },
        datos = fecha.split('-'),
        resultado;

    resultado = datos[2]+'-'+abrev[datos[1]]+'-'+datos[0];

    return resultado;
}