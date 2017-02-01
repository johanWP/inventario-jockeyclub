@extends('app')

@section('htmlheader_title')
    Editar {{ $sector->name }}
@endsection

@section('contentheader_title')
    Editar {{ $sector->name }}
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="register-box-body">
                    @include('errors.validationErrors')
                    {!! Form::model($sector, ['method'=>'PUT', 'action'=>['SectorController@update', $sector->id]]) !!}
                        @include('sectors.form', ['buttonText'=>'Actualizar sector'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection