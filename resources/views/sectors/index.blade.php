@extends('app')

@section('htmlheader_title')
    Administrar Sectores
@endsection
@section('contentheader_title')
    Administrar Sectores
    <a href="/sectores/create/" class="btn btn-primary btn-lg"><i class="ion ion-ios-bookmarks"></i> Crear Nuevo</a>
@endsection


@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                @include('flash::message')
                <div class="panel panel-default">
                    {{--<div class="panel-heading">Sectores</div>--}}

                    <div class="panel-body">
                        {{--Content--}}
                        <table class="table table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Email</th>
                                <th>Gerente del sector</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sectors as $sector)
                                <tr>
                                    <td>{{$sector->name}}</td>
                                    <td>{{$sector->description}}</td>
                                    <td>{{$sector->email}}</td>
                                    <td><a href="usuarios/{{$sector->manager->id}}">{{$sector->manager->name}}</a></td>
                                    <td align="right">
                                        <a href="sectores/{{$sector->id}}" class="btn btn-sm btn-default">Ver</a>
                                        <a href="sectores/{{$sector->id}}/edit" class="btn btn-sm btn-primary">Editar</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete" data-id="{{ $sector->id }}" data-name="{{$sector->name}}" data-model="sectores">Borrar</button>
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