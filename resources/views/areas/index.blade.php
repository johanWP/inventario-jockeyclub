@extends('app')

@section('htmlheader_title')
    Administrar Áreas
@endsection
@section('contentheader_title')
    Administrar Áreas
    {{--<a href="/areas/create/" class="btn btn-primary btn-lg"><i class="ion ion-ios-bookmarks"></i> Crear Nueva</a>--}}
@endsection


@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                @include('flash::message')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="/areas/create/" class="btn btn-primary" style="margin-bottom: -3em">
                            <i class="fa fa-plus"></i> Crear Nueva
                        </a>
                        <table class="table table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Email</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($areas as $area)
                                <tr>
                                    <td>{{$area->name}}</td>
                                    <td>{{$area->description}}</td>
                                    <td>{{$area->email}}</td>
                                    <td align="right">
                                        <a href="/areas/{{$area->id}}" class="btn btn-sm btn-default">Ver</a>
                                        <a href="/areas/{{$area->id}}/edit" class="btn btn-sm btn-primary">Editar</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#modalDelete" data-id="{{ $area->id }}"
                                                data-name="{{$area->name}}" data-model="areas"
                                                id="btn_{{ $area->id }}">Borrar
                                        </button>
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
                    search: "Buscar:&nbsp;",
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