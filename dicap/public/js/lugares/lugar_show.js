$(document).ready(function() {

    var input_clase,
        f_lugar = $('#f_lugar'),
        pdf = $('#pdf'),
        excel = $('#excel'),
        thisinput,
        total,
        i;

    calcularTotal();

    $('input.input-sm').keyup(calcularTotal);

    $('select.input-sm').on('change', calcularTotal);

    $('ul.pagination').on('click', calcularTotal);

    function calcularTotal() {

        input_clase = $('#tabla_productos input.suma');
        total = 0;
        for (i = 0; i < input_clase.length; i++) {
            thisinput = parseInt($(input_clase[i]).val());
            total = total + thisinput;
        }
        $('#tabla_productos tfoot .total').html(total);
    }

    pdf.on('click', generarPdf);
    
    excel.on('click', generarExcel);

    function generarPdf() {

        f_lugar.attr('action', urlPdf);
        f_lugar.submit();
    }    
    
    function generarExcel() {

        f_lugar.attr('action', urlExcel);
        f_lugar.submit();
    }
});