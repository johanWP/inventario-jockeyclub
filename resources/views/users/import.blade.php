@extends('app')

@section('htmlheader_title')
    Importar archivo CSV De Usuarios
@endsection

@section('contentheader_title')
    Importar Archivo CSV de Usuarios
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                @include('flash::message')
                <div class="panel panel-default">
                    <div class="panel-heading">Importar Listado de Usuarios</div>
                    <div class="panel-body">
                        <p class="text-muted">Recuerde seguir el formato de <a href="/ejemplo_importar_usuarios.csv">este archivo</a>
                         con los campos separados por <b>;</b></p>
                        <p class="text-muted">Sector ; Area ; Cargo o Puesto ; Apellido ; Nombre ; Teléfono interno ; Email ; Email Grupal</p>

                        <div id="loading" class="text-center">
                            <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                            <span class="sr-only">Loading...</span>
                            <p class="text-muted text-center" style="margin-top: 3em"><i class="fa fa-coffee"></i> Espere...</p>
                        </div>
                        <div id="form">
                            {{ Form::open(['url'=>'/usuarios/import','files'=>true, 'class' => '']) }}

                            <div class="form-group col-sm-6" id="divFile">
                                {{ Form::label('file','Seleccione: ', ['id'=>'','class'=>'']) }}
                                <p class="text-muted">Únicamente archivos con extensión <em>.csv</em></p>
                                <input type="file" name="file" id="file" accept="csv">
                            </div>
                            <div class="form-group col-sm-6" style="padding-top: 3em">
                                {{ Form::reset('Reset', ['class' => 'btn btn-default']) }}
                                {{ Form::submit('Subir Archivo', ['class' => 'btn btn-primary', 'id' => 'btnSubmit']) }}
{{--                                {{ Form::submit('Subir Archivo', ['class' => 'btn btn-primary', 'id' => 'btnSubmit', 'disabled' => 'disabled']) }}--}}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div> {{-- fin del panel body--}}
                </div>
            </div>
        </div>
    </div>
    {{--End Content--}}
@endsection

@section('footer-scripts')
    <script>
        $(function () {
            $('#loading').hide();
            $('#file').on('change', function (  ) {
                var ext = $('#file').val();
                if ( ext.indexOf('.csv') > 0 ) {
                    $('#btnSubmit').attr('disabled', false)
                    $('#divFile').removeClass('has-error');
                } else {
                    $('#btnSubmit').attr('disabled', 'disabled');
                    $('#divFile').addClass('has-error');
                }
            });
            $('.panel-body form').on('submit', function(){
                $('#form').fadeOut(500, function () {
                    $('#loading').fadeIn(500);
                });
            })
        }); // fin del document.ready()
    </script>

@endsection