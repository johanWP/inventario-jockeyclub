@extends('app')

@section('htmlheader_title')
    Listado de Equipos
@endsection
@section('contentheader_title')
    Listado de Equipos
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                @include('flash::message')
                <div class="panel panel-default">
                    {{--<div class="panel-heading">Áreas y Departamentos</div>--}}
                    <div class="panel-body">
                        <a href="/equipos/create/" class="btn btn-primary" style="margin-bottom: -3em">
                            <i class="ion ion-person-add"></i> Crear Nuevo
                        </a>
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
                                    <td><a href="/equipos/{{ $asset->id }}">{{ $asset->serial }}</a></td>
                                    <td>{{ $asset->type->name }}</td>
                                    <td>{{ $asset->marca }}</td>
                                    <td>{{ $asset->modelo }}</td>
                                    <td><a href="/usuarios/{{ $asset->owner->id }}">{{$asset->owner->fullName}}</a></td>
                                    <td>{{$asset->fechaCompra}}</td>
                                    <td align="right">
                                        <a href="equipos/{{ $asset->id }}" class="btn btn-sm btn-default">Ver</a>
                                        <a href="equipos/{{ $asset->id }}/edit/" class="btn btn-sm btn-primary">Editar</a>
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
                    search: "Buscar: &nbsp;",
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