@extends('app')

@section('htmlheader_title')
    Nuevo movimiento de equipo
@endsection

@section('contentheader_title')
    Nuevo movimiento de equipo
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('errors.validationErrors')
                <div class="register-box-body">
                    {{--<p class="login-box-msg">Register a new membership</p>--}}
                    {!! Form::open(['url'=>'movimientos']) !!}

                    @include('moves.form', ['buttonText'=>'Mover equipo'])

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-scripts')
    <script src="/plugins/select2/select2.min.js"></script>
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#origen').change(function()
            {
                var user = $('#origen').val();
                $('#asset_id').empty();
                $.ajax({
                    method: "GET",
                    url: "/api/getAssets/"+user,
                    dataType: 'json'
                })
                .done(function( msg )
                {
                    for(var k in msg)
                    {
                        $('#asset_id').append('<option value="'+msg[k].id+'">'+msg[k].serial+'</option>')
                    }

                })
                .fail(function(msg)
                {
                    alert('Ocurrió un error al cargar el inventario');
                });
            });

            $('#asset_id').select2(
            {
                placeholder: "Seleccione..."
            });

        })  //  Fin del document.ready

    </script>
@endsection