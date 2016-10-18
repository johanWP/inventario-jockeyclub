@extends('app')

@section('htmlheader_title')
    Editar Equipo
@endsection
@section('contentheader_title')
    Editar Equipo
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="register-box-body">
                    @include('errors.validationErrors')
                    {!! Form::model($asset, ['method'=>'PUT', 'action'=>['AssetController@update', $asset->id]]) !!}
                        @include('assets.form', ['buttonText'=>'Actualizar equipo'])
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