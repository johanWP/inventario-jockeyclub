@extends('app')

@section('htmlheader_title')
    Editar {{ $area->name }}
@endsection

@section('contentheader_title')
    Editar {{ $area->name }}
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="register-box-body">
                    @include('errors.validationErrors')
                    {!! Form::model($area, ['method'=>'PUT', 'action'=>['AreaController@update', $area->id]]) !!}
                    @include('areas.form', ['buttonText'=>'Actualizar área'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection