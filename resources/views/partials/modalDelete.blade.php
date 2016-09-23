<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="Borrar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLabel">Confirmar</h4>
            </div>
            {!! Form::open(['id'=>'frmDelete', 'method'=>'DELETE', ]) !!}
            <div class="modal-body">
                <span id="spanMensaje"></span>

                    {!! Form::hidden('id') !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('Borrar', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script>
    $('#modalDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('name') // nombre del registro que se quiere borrar
        var id = button.data('id') // id del registro
        var model = button.data('model') // ruta del index Ejemplo: /areas
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Borrar ' + name);
        modal.find('.modal-body input').val(id);
        modal.find('#spanMensaje').html('<p>¿Estás seguro de borrar '+ name +'?</p>');
        var form = modal.find('#frmDelete');
        form.attr('action', model + '/' + id)
    })
</script>