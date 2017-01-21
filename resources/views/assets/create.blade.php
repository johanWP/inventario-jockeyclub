@extends('app')

@section('htmlheader_title')
    Incluir nuevo equipo
@endsection

@section('contentheader_title')
    Incluir nuevo Equipo
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('errors.validationErrors')
                <div class="register-box-body">
                    {!! Form::open(['url'=>'equipos']) !!}
                    @include('assets.form', ['buttonText'=>'Incluir equipo'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <link href="/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
{{--    @include('assets.assets_js')--}}
    <script>

        $( document ).ready(function() {
            $ ('div[name=pc]').hide ();
            $('#fechaCompra').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                endDate: '0d'   // no se puede seleccionar una fecha después de hoy
            });

            if ( $('#type_id').val() == '3' || $('#type_id').val() == '7') {
                $('div[name=pc]').show();
            } else {
                // Si es una PC o Notebook
                $('div[name=pc]').hide();
            }

            $('#type_id').change(function() {
                var url = "/api/getNextSerial/" + $ ( this ).val ();
                var jqxhr = $.ajax ( url )
                        .done ( function ( data ) {
                            $ ( '#serial' ).val ( data );
                        } )
                        .fail ( function () {
                            alert ( "error" );
                        } );
                if ( $(this).val () == '3' || $(this).val () == '7')    // Si el tipo es PC o Notebook
                {
                    $ ('div[name=pc]').show ();
                } else {
                    $ ('div[name=pc]').hide ();
                }
            });
        });
    </script>


@endsection