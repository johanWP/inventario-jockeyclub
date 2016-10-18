@extends('app')

@section('htmlheader_title')
    Incluir nuevo equipo
@endsection

@section('contentheader_title')
    Incluir nuevo Equipo
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('errors.validationErrors')
                <div class="register-box-body">
                    {!! Form::open(['url'=>'equipos']) !!}
                    @include('assets.form', ['buttonText'=>'Incluir equipos'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional-scripts')
    <link href="/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
    @include('assets.assets_js')
@endsection