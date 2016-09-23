@extends('app')

@section('htmlheader_title')
    Incluir nuevo sector
@endsection

@section('contentheader_title')
    Incluir nuevo sector
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('errors.validationErrors')
                <div class="register-box-body">
                    {{--<p class="login-box-msg">Register a new membership</p>--}}
                    {!! Form::open(['url'=>'sectores']) !!}

                    @include('sectors.form', ['buttonText'=>'Incluir nuevo sector'])

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
@endsection