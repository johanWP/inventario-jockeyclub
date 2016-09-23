@extends('app')

@section('htmlheader_title')
    Editar Contacto
@endsection
@section('contentheader_title')
    Editar Contacto
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="register-box-body">
                    {{--<p class="login-box-msg">Register a new membership</p>--}}
                    @include('errors.validationErrors')
                    {!! Form::model($user, ['files'=> 'true','method'=>'PUT', 'action'=>['UserController@update', $user->id]]) !!}
                        @include('users.form', ['buttonText'=>'Actualizar usuario'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection