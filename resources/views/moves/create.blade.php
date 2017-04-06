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
        <div class="col-md-5 col-md-offset-1">
            <div class="row">
                <div class="panel panel-default" id="inventario-panel-origen">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span id="inventario-titulo-origen"></span>
                        </h3>
                    </div>
                    <div class="panel-body" id="inventario-body-origen">
                        <ul id="inventario-list-origen"></ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="row">
                <div class="panel panel-default" id="inventario-panel-destino">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span id="inventario-titulo-destino"></span>
                        </h3>
                    </div>
                    <div class="panel-body" id="inventario-body-destino">
                        <ul id="inventario-list-destino"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
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

            $('#destino').on('change', function(){
                var userId = $('#destino').val();
                var html = '';
                var userName = $('#destino option:selected').text();

                if(userName == 'Seleccione...') {
                    $('#inventario-list-destino').fadeOut();
                    $('#inventario-panel-destino').fadeOut();
                } else {
                    $('#inventario-panel-destino').fadeIn();
                    $('#inventario-list-destino').fadeOut();
                    $('#inventario-titulo-destino').html( 'Inventario de ' + userName);
                    $.ajax({
                        method: "GET",
                        url: "/api/getAssets/" + userId,
                        dataType: 'json'
                    })
                            .done(function( msg )
                            {
                                $('#inventario-list-destino').empty();
                                html = '';
                                for(var k in msg)
                                {
                                    $('#inventario-list-destino').append('' +
                                        '<li>'  +
                                        '<a href= "/equipos/' + msg[k].id + '">' +
                                            msg[k].marca + ' ' +
                                            msg[k].modelo +
                                            ' (' + msg[k].serial + ')' +
                                        '</a></li>'
                                    );
                                }
                                $('#inventario-list-destino').fadeIn();
                            })
                            .fail(function(msg)
                            {
                                alert('Ocurrió un error al cargar el inventario del destino');
                            });
                }
            });   // fin del destino.onChange()

            $('#origen').on('change', function(){
                var userId = $('#origen').val();
                var html = '';
                var userName = $('#origen option:selected').text();

                if(userName == 'Seleccione...') {
                    $('#inventario-list-origen').fadeOut();
                    $('#inventario-panel-origen').fadeOut();
                } else {
                    $('#inventario-panel-origen').fadeIn();
                    $('#inventario-list-origen').fadeOut();
                    $('#inventario-titulo-origen').html( 'Inventario de ' + userName);
                    $.ajax({
                        method: "GET",
                        url: "/api/getAssets/" + userId,
                        dataType: 'json'
                    })
                        .done(function( msg )
                        {
                            $('#inventario-list-origen').empty();
                            html = '';
                            for(var k in msg)
                            {
                                $('#inventario-list-origen').append('' +
                                    '<li>'  +
                                    '<a href= "/equipos/' + msg[k].id + '">' +
                                    msg[k].marca + ' ' +
                                    msg[k].modelo +
                                    ' (' + msg[k].serial + ')' +
                                    '</a></li>'
                                );
                            }
                            $('#inventario-list-origen').fadeIn();
                            console.info('si');
                        })
                        .fail(function(msg)
                        {
                            alert('Ocurrió un error al cargar el inventario del destino');
                        });
                }
            });   // fin del origen.onChange()

        });  //  Fin del document.ready

    </script>
@endsection