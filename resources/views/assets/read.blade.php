@extends('app')

@section('htmlheader_title')
    Detalle del equipo
@endsection

@section('contentheader_title')
    Detalles del equipo
@endsection

@section('main-content')
    <div class="container">
<div class="col-sm-6">
    <div class="row">

        <div class="col-sm-4"><b>Fecha de Compra:</b></div>
        <div class="col-sm-8">{{ $asset->fechaCompra }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Proveedor:</b></div>
        <div class="col-sm-8">{{ $asset->proveedor }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Orden de Compra:</b></div>
        <div class="col-sm-8">{{ $asset->orden_compra }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Tipo de equipo:</b></div>
        <div class="col-sm-8">{{ $asset->type->name }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Marca:</b></div>
        <div class="col-sm-8">{{ $asset->marca }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Modelo:</b></div>
        <div class="col-sm-8">{{ $asset->modelo }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Serial:</b></div>
        <div class="col-sm-8">{{ $asset->serial }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Precio:</b></div>
        <div class="col-sm-8">${{ $asset->precio }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Asignado a:</b></div>
        <div class="col-sm-8"><a href="/usuarios/{{$asset->owner->id}}">{{ $asset->owner->name }}</a></div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Notas:</b></div>
        <div class="col-sm-8">{{ $asset->nota }}</div>
    </div>


</div>
<div class="col-sm-4">
    <div class="col-sm-4">
        <div class="col-sm-4">
            @if(!file_exists('qr/'.$asset->id.'.png'))
{{--                {!! QrCode::format('png')->size(200)->generate(Request::url(), 'qr/'.$asset->id.'.png') !!}--}}
                <?php
                 $info = 'Fecha de compra: '.$asset->fechaCompra.
            ', Marca: '.$asset->marca.
            ', Modelo: '.$asset->modelo.
            ', Serial: '.$asset->serial.
            ', Tipo: '.$asset->type->name.
            ', Precio: '.$asset->precio.
            ', Nota: '.$asset->nota;
                ?>
            {!! QrCode::format('png')->size(200)->generate($info, 'qr/'.$asset->id.'.png') !!}


            @endif
                <img src="/qr/{{$asset->id}}.png" width="200" height="200">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-11">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>Origen</th>
                    <th>&nbsp;</th>
                    <th>Destino</th>
                    <th>Fecha</th>
                    <th>Realizado por</th>
                </tr>
                </thead>
                <tbody>

                @foreach($moves as $move)
                <tr>
                    <td>{!! $move->usuarioOrigen->name !!}</td>
                    <td><i class="fa fa-arrow-right"></i></td>
                    <td>{!! $move->usuarioDestino->name !!}</td>
                    <td>{!! $move->created_at !!}</td>
                    <td>{!! $move->hechoPor->name !!}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <a style="margin-top: 20px" class="btn btn-default" href="#" onclick="history.back()">Volver</a>
    </div>
</div>
</div>
@endsection
