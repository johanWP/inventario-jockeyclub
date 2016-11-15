@extends('app')

@section('htmlheader_title')
    Importar archivo XML Avaya
@endsection
@section('contentheader_title')
    Importar archivo XML Avaya
@endsection

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">Importar listado Avaya</div>
                <div class="panel-body">
                    <div id="form">
                        {{ Form::open(['url'=>'/avaya/import','files'=>true, 'class' => 'form-inline']) }}
                        <div class="form-group">
                            {{ Form::label('file','Seleccione: ',array('id'=>'','class'=>'')) }}
                            <p class="text-muted">Únicamente archivos con extensión <em>.csv</em></p>
                            {{ Form::file('file','',array('id'=>'file','class'=>'form-control')) }}
                        </div>
                        <div class="form-group" style="padding-top: 3em">
                        <!-- reset buttons -->
                        {{ Form::reset('Reset', ['class' => 'btn btn-default']) }}
                        <!-- submit buttons -->
                            {{ Form::submit('Subir Archivo', ['class' => 'btn btn-primary']) }}
                        </div>


                        <br/>



                        {{ Form::close() }}
                    </div>
                    <div id="loading" class="text-center">
                        <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                        <p class="text-muted text-center" style="margin-top: 3em"><i class="fa fa-coffee"></i> Espere...</p>
                    </div>
                </div> {{-- fin del panel body--}}
            </div>
        </div>
    </div>
</div>
{{--End Content--}}
@endsection

@section('footer-scripts')
<script src="{{ asset('/plugins/fine-uploader/fine-uploader.core.js') }}"></script>
<script>
    $(function () {
        $('#loading').hide();
        $('.panel-body form').on('submit', function(){
            $('#form').fadeOut(500, function () {
                $('#loading').fadeIn(500);
            });
        })
    }); // fin del document.ready()
</script>

@endsection