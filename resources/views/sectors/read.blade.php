@extends('app')

@section('htmlheader_title')
    Detalles de {{ $sector->name }}
@endsection

@section('contentheader_title')
    Detalles de {{ $sector->name }}
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-sm-2"><b>Nombre:</b></div>
            <div class="col-sm-10">{{ $sector->name }}</div>
        </div>

        <div class="row">
            <div class="col-sm-2"><b>Descripción:</b></div>
            <div class="col-sm-10">{{ $sector->description }}</div>
        </div>

        <div class="row">
            <div class="col-sm-2"><b>Email:</b></div>
            <div class="col-sm-10">{{ $sector->email }}</div>
        </div>

        <div class="row">
            <div class="col-sm-2"><b>Fax:</b></div>
            <div class="col-sm-10">{{ $sector->fax }}</div>
        </div>

        <div class="row">
            <div class="col-sm-2"><b>Área:</b></div>
            <div class="col-sm-10"><a href="/areas/{{$sector->area->id}}">{{$sector->area->name}}</a></div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <a style="margin-top: 20px" class="btn btn-default" href="#" onclick="history.back()">
                    <i class="fa fa-arrow-left"></i> Volver
                </a>
            </div>

        </div>
    </div>
    @include('partials.modalDelete')

@endsection
