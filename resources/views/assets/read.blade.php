@extends('app')

@section('htmlheader_title')
    Detalle del equipo
@endsection

@section('contentheader_title')
    Detalles del equipo
@endsection

@section('main-content')
<div class="container">
    <div class="panel panel-default col-sm-11">
        <div class="panel-body">

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
                @if ($asset->type_id == '3')
                    <div class="row">
                        <div class="col-sm-4"><b>Sistema Operativo:</b></div>
                        <div class="col-sm-8">{{ $asset->nombreSistemaOperativo }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><b>Procesador:</b></div>
                        <div class="col-sm-8">{{ $asset->nombreProcesador }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><b>Disco Duro:</b></div>
                        <div class="col-sm-8">{{ $asset->nombreDiscoDuro }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><b>Motherboard:</b></div>
                        <div class="col-sm-8">{{ $asset->nombreMotherboard }}</div>
                    </div>
                @endif

            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-4"><b>Serial Interno:</b></div>
                    <div class="col-sm-8">{{ $asset->serial }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Serial del Fabricante:</b></div>
                    <div class="col-sm-8">{{ $asset->serial_fabricante }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Precio:</b></div>
                    <div class="col-sm-8">${{ $asset->precio }}</div>
                </div>

                <div class="row">
                    <div class="col-sm-4"><b>Asignado a:</b></div>
                    <div class="col-sm-8"><a href="/usuarios/{{$asset->owner->id}}">{{ $asset->owner->fullName }}</a></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"><b>Notas:</b></div>
                    <div class="col-sm-8">{{ $asset->nota }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <b><p class="text-left">Documento de responsabilidad:</p></b>
                    </div>
                    <div class="col-sm-8">
                        <span><a href="/html/responsabilidad/{{ $asset->id }}">HTML <i class="fa fa-file fa-2x"></i></a></span>
                        <span style="margin-left: 2em"><a href="/pdf/responsabilidad/{{ $asset->id }}">PDF <i class="fa fa-file-pdf-o fa-2x"></i></a></span></div>
                </div>
            </div>

            <div class="col-sm-12" style="margin-top: 2em">
            </div>

            <div class="col-sm-12" style="margin-top: 2em">
                <p class="h2">Historial de Movimientos</p>
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
                            <td>{!! $move->usuarioOrigen->fullName !!}</td>
                            <td><i class="fa fa-arrow-right"></i></td>
                            <td>{!! $move->usuarioDestino->fullName !!}</td>
                            <td>{!! $move->created_at !!}</td>
                            <td>{!! $move->hechoPor->fullName !!}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-sm-12">
                <a style="margin-top: 20px" class="btn btn-default" href="#" onclick="history.back()"><i class="fa fa-arrow-left"></i> Volver</a>

            </div>
        </div>
    </div>
</div>

@endsection
