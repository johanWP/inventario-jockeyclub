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
        <br>
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="panel panel-default" id="inventario-panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span id="inventario-titulo"></span> </h3>
                    </div>
                    <div class="panel-body" id="inventario-body">
                        <ul id="inventario-list"></ul>
                    </div>
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
            $('#inventario-panel').hide();
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

            $('#destino').on('change', function(){
                var userId = $('#destino').val();
                var html = '';
                var userName = $('#destino option:selected').text();

                if(userName == 'Seleccione...') {
                    $('#inventario-list').fadeOut();
                    $('#inventario-panel').fadeOut();
                } else {
                    $('#inventario-panel').fadeIn();
                    $('#inventario-list').fadeOut();
                    $('#inventario-titulo').html( 'Inventario de ' + userName);
                    $.ajax({
                        method: "GET",
                        url: "/api/getAssets/" + userId,
                        dataType: 'json'
                    })
                            .done(function( msg )
                            {
                                $('#inventario-list').empty();
                                html = '';
                                for(var k in msg)
                                {
                                    $('#inventario-list').append('' +
                                            '<li>'  +
                                            '<a href= "/equipos/' + msg[k].id + '">' + msg[k].marca + ' ' + msg[k].modelo + ' (' + msg[k].serial + ')' +
                                            '</a></li>'
                                    );
                                }
                                $('#inventario-list').fadeIn();
                            })
                            .fail(function(msg)
                            {
                                alert('Ocurrió un error al cargar el inventario del destino');
                            });
                }
            });   // fin del destino.onChange()

        });  //  Fin del document.ready

    </script>
@endsection