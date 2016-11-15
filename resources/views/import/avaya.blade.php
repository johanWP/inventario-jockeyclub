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
                    {{ Form::open(array('url'=>'/import/avaya','files'=>true)) }}

                    {{ Form::label('file','Seleccione: ',array('id'=>'','class'=>'')) }}
                    <p class="text-muted">Únicamente archivos con extensión <em>.csv</em></p>
                    {{ Form::file('file','',array('id'=>'file','class'=>'form-control')) }}
                    <br/>
                    <!-- reset buttons -->
                    {{ Form::reset('Reset', ['class' => 'btn btn-default']) }}
                <!-- submit buttons -->
                    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}


                    {{ Form::close() }}
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
    }); // fin del document.ready()
</script>

@endsection