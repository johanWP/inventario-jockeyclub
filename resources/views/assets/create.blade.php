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
                    @include('assets.form', ['buttonText'=>'Incluir equipos'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-scripts')
    <link href="/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script>
        $( document ).ready(function() {
            $('#fechaCompra').datepicker({
                autoclose: true,
                format: "yyyy/mm/dd",
                endDate: '0d'   // no se puede seleccionar una fecha después de hoy
            });


            $('#type_id').change(function() {
                var url = "/api/getNextSerial/" + $(this).val();
                var jqxhr = $.ajax( url )
                        .done(function(data) {

                            $('#serial').val(data).prop('readonly', true);
                        })
                        .fail(function() {
                            alert( "error" );
                        });
            });
        });  // fin del document.ready()

    </script>
@endsection