@extends('app')

@section('htmlheader_title')
    Listado de movimientos
@endsection
@section('contentheader_title')
    Listado de movimientos
    <a href="/movimientos/create/" class="btn btn-primary btn-lg"><i class="ion ion-ios-pricetag"></i> Crear Nuevo</a>
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                @include('flash::message')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Serial</th>
                                <th>Marca / Modelo</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($moves as $move)
                                <tr>
                                    <td>{{$move->updated_at->diffForHumans() }}</td>
                                    <td>{{$move->usuarioOrigen->name}}</td>
                                    <td>{{$move->usuarioDestino->name}}</td>
                                    <td>{{$move->asset->serial}}</td>
                                    <td>{{$move->asset->marca}} / {{$move->asset->modelo}}</td>
                                    <td align="right">
                                        <a href="assets/" class="btn btn-sm btn-default">Ver</a>
                                        <a href="assets/edit" class="btn btn-sm btn-primary">Editar</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete" data-id="{{ $move->id }}" data-name="{{$move->serial}}" data-model="moves">Borrar</button>
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