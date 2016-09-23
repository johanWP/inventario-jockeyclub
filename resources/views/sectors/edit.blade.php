@extends('app')

@section('htmlheader_title')
    Editar sector
@endsection

@section('contentheader_title')
    Editar sector
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="register-box-body">
                    {{--<p class="login-box-msg">Register a new membership</p>--}}
                    @include('errors.validationErrors')
                    {!! Form::model($sector, ['method'=>'PUT', 'action'=>['SectorController@update', $sector->id]]) !!}
                    @include('sectors.form', ['buttonText'=>'Actualizar sector'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection