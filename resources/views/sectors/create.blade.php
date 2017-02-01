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
                    {!! Form::open(['url'=>'/sectores']) !!}

                    @include('sectors.form', ['buttonText'=>'Incluir sector'])

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
@endsection