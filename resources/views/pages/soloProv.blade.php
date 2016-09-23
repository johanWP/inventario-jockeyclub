@extends('app')

@section('htmlheader_title')
    Proveedores
@endsection

@section('contentheader_title')
    Solo para proveedores
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Proveedores</div>

                    <div class="panel-body">
                        Esto es para proveedores
                        <div class="col-12">
                            {!! Form::model(['route'=> 'recordar', 'method'=>'PUT']) !!}
                            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
