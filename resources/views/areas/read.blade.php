@extends('app')

@section('htmlheader_title')
    Detalles del área {{ $area->name }}
@endsection

@section('contentheader_title')
    Detalles del área {{ $area->name }}
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
            <div class="col-sm-2"><b>Sectores:</b></div>
            <div class="col-sm-10">
                <ul>
                @foreach($sectores as $sector)
                    <li><a href="/areas/{{$sector->id}}">{{ $sector->name }}</a></li>
                @endforeach
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <a style="margin-top: 20px" class="btn btn-default" href="#" onclick="history.back()">
                    <i class="fa fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>

    </div>

@endsection
