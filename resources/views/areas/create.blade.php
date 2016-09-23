@extends('app')

@section('htmlheader_title')
    Incluir nueva área
@endsection

@section('contentheader_title')
    Incluir nueva área
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('errors.validationErrors')
                <div class="register-box-body">
                    {{--<p class="login-box-msg">Register a new membership</p>--}}
                    {!! Form::open(['url'=>'areas']) !!}

                    @include('areas.form', ['buttonText'=>'Incluir área'])

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
@endsection