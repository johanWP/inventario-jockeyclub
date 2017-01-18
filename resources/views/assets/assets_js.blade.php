<script>
    $( document ).ready(function() {
        $('div[name=pc]').hide()
        $('#fechaCompra').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            endDate: '0d'   // no se puede seleccionar una fecha después de hoy
        });


        $('#type_id').change(function() {
            var url = "/api/getNextSerial/" + $(this).val();
            var jqxhr = $.ajax( url )
                    .done(function(data) {
                        $('#serial').val(data);
                    })
                    .fail(function() {
                        alert( "error" );
                    });
            if($(this).val() == '3')    // Si el tipo es PC
            {
                $('div[name=pc]').show();
            } else {
                $('div[name=pc]').hide();
            }

        });
    });  // fin del document.ready()
</script>
