@extends('app')

@section('htmlheader_title')
    Importar archivo CSV Avaya
@endsection

@section('contentheader_title')
    Importar Archivo CSV Avaya
@endsection

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">Importar Listado Avaya</div>
                <div class="panel-body">
                    <div id="loading" class="text-center">
                        <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                        <p class="text-muted text-center" style="margin-top: 3em"><i class="fa fa-coffee"></i> Espere...</p>
                    </div>
                    <div id="form">
                        {{ Form::open(['url'=>'/avaya/import','files'=>true, 'class' => '']) }}

                        <div class="form-group col-sm-4" style="padding-top: 3em;">
                            {{ Form::text('location', '' , ['id' => 'location', 'class' => 'form-control', 'placeholder' => 'Escriba la ubicación...', 'required' => 'required']) }}
                        </div>
                        <div class="form-group col-sm-4" id="divFile">
                            {{ Form::label('file','Seleccione: ',array('id'=>'','class'=>'')) }}
                            <p class="text-muted">Únicamente archivos con extensión <em>.csv</em></p>
                            <input type="file" name="file" id="file" accept="csv">
                        </div>
                        <div class="form-group col-sm-4" style="padding-top: 3em">
                            {{ Form::reset('Reset', ['class' => 'btn btn-default']) }}
                            {{ Form::submit('Subir Archivo', ['class' => 'btn btn-primary', 'id' => 'btnSubmit', 'disabled' => 'disabled']) }}
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