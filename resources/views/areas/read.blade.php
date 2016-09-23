@extends('app')

@section('htmlheader_title')
    Usuario
@endsection

@section('contentheader_title')
    Detalles del área
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-sm-2"><b>Nombre:</b></div>
            <div class="col-sm-10">{{ $area->name }}</div>
        </div>
        <div class="row">
            <div class="col-sm-2"><b>Descripción:</b></div>
            <div class="col-sm-10">{{ $area->description }}</div>
        </div>
        <div class="row">
            <div class="col-sm-2"><b>Email:</b></div>
            <div class="col-sm-10">{{ $area->email }}</div>
        </div>
        <div class="row">
            <div class="col-sm-2"><b>Fax:</b></div>
            <div class="col-sm-10">{{ $area->fax }}</div>
        </div>
        <div class="row">
            <div class="col-sm-2"><b>Sector:</b></div>
            <div class="col-sm-10"><a href="/sectores/{{$area->sector->id}}">{{$area->sector->name}}</a></div>
        <div class="row">
            <div class="col-sm-2">
                <a style="margin-top: 20px" class="btn btn-default" href="#" onclick="history.back()">Volver</a>
            </div>

        </div>
    </div>
    @include('partials.modalDelete')

@endsection
