<script>
    $( document ).ready(function() {
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
        });
    });  // fin del document.ready()
</script>
