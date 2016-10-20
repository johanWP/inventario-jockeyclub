<script>
    $(function () {
        var opciones = {
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            'language': {
                processing: 'Espera...',
                search: 'Buscar:&nbsp;',
                info: 'Mostrando registros _START_ a _END_ de _TOTAL_ en total',
                paginate: {
                    first: 'Primero',
                    previous: 'Anterior',
                    next: 'Siguiente',
                    last: 'Ultimo'
                }
            }
        };
        $('#datatable_areas').DataTable(opciones);
        $('#datatable_sectores').DataTable(opciones);
        $('#msjPapeleraVacia').hide();
        $('#container .btn-primary').click(function(e){
            e.preventDefault();
            var url = $(this).closest('form').attr('action');
            var id = $(this).siblings("input[type='hidden']").val();
            var tr = $(this).closest('tr');
            tr.animate({'backgroundColor':'#fb6c6c'},300);
//            tr.fadeOut(1000, afterFadeOut(this));

            var jqxhr =  $.ajax({
                method: "POST",
                headers: { 'X-CSRF-Token': '{{ csrf_token() }}' },
                url: url + id
            })
                .done(function(data) {
                        tr.fadeOut(1000, afterFadeOut(this));
                    })
                    .fail(function() {
                        $('#container').prepend('<div class="col-sm-11"><div class="alert alert-danger">El item no pudo restaurarse</div></div>');
                    })
                    .always(function() {
//                        alert( "complete" );
                   });

        });  // fin del click
        if ($('#container table').length < 1)
        {
            $('#msjPapeleraVacia').show();
        }
        function afterFadeOut(tr) {
            $(this).remove();
//            tr.remove();
            $('#container').prepend('<div class="col-sm-11"><div class="alert alert-info">Se restauró el item</div></div>');
            $( "#container table" ).each(function() {
                var tabla_id = $( this ).attr('id');
                console.log(tabla_id + ': ' +$(tabla_id + ' tr').length);
//                if( $(tabla_id + ' tr').length < 2 ) {
//                    $( this ).closest('.panel').fadeOut(500, function(){
//                        $( this ).closest('.panel').remove();
//                    })
//                }

            });
//            var tabla_id = $(this).closest('table').attr('id');
//            console.log(tabla_id);
//            if ($('#' + tabla_id + ' tr').length <= 1)
//            {
//                tr.closest('.row').remove();
//            }
        }
    }); // fin decument.ready
</script>