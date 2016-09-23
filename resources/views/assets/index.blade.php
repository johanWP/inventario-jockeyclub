@extends('app')

@section('htmlheader_title')
    Listado de Equipos
@endsection
@section('contentheader_title')
    Listado de Equipos
    <a href="/equipos/create/" class="btn btn-primary btn-lg"><i class="ion ion-ios-pricetag"></i> Crear Nuevo</a>
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                @include('flash::message')
                <div class="panel panel-default">
                    {{--<div class="panel-heading">Áreas y Departamentos</div>--}}
                    <div class="panel-body">
                        <table class="table table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Asignado a</th>
                                <th>Fecha de compra</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($assets as $asset)
                                <tr>
                                    <td>{{ $asset->serial }}</td>
                                    <td>{{$asset->type->name}}</td>
                                    <td>{{$asset->marca}}</td>
                                    <td>{{$asset->modelo}}</td>
                                    <td>{{$asset->user->name}}</td>
                                    <td>{{$asset->fechaCompra}}</td>
                                    <td align="right">
                                        <a href="equipos/{{$asset->id}}" class="btn btn-sm btn-default">Ver</a>
                                        <a href="equipos/{{$asset->id}}/edit/" class="btn btn-sm btn-primary">Editar</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete" data-id="{{ $asset->id }}" data-name="{{$asset->serial}}" data-model="equipos">Borrar</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Content--}}
    @include('partials.modalDelete')
    <script>
        $(function () {
            $("#dataTable").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "language": {
                    processing: "Espera...",
                    search: "Buscar&nbsp;:",
                    info:   "Mostrando registros _START_ a _END_ de _TOTAL_ en total",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Ultimo"
                    }
                }
            });
        });
    </script>
@endsection