@extends('app')

@section('htmlheader_title')
    Administrar usuarios
@endsection
@section('contentheader_title')
    Administrar usuarios
@endsection


@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                @include('flash::message')

                <div class="panel panel-default">
                    {{--<div class="panel-heading">Usuarios</div>--}}

                    <div class="panel-body">
                        <a href="/usuarios/create/" class="btn btn-primary" style="margin-bottom: -3em">
                            <i class="ion ion-person-add"></i> Crear Nuevo
                        </a>
                        <table class="table table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Sector</th>
                                <th>Área</th>
                                {{--<th>Ext</th>--}}
                                <th>Email</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><a href="/usuarios/{{ $user->id }}">{{ $user->fullName }}</a></td>
                                    <td><a href="/sectores/{{ $user->area->sector->id }}">{{ $user->area->sector->name }}</a></td>
                                    <td><a href="/areas/{{ $user->area->id }}">{{ $user->area->name }}</a></td>
                                    {{--<td>{{ $user->ext }}</td>--}}
                                    <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                    <td align="right">
{{--                                        <a href="usuarios/{{$user->id}}" class="btn btn-sm btn-default">Ver</a>--}}
                                        <a href="usuarios/{{$user->id}}/edit" class="btn btn-sm btn-primary">Editar</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete" data-id="{{ $user->id }}" data-name="{{$user->name}}" data-model="usuarios">Borrar</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div><i class="fa fa-print"></i><a href="/pdf/guia" target="_blank"> Version Imprimible</a></div>
                        </div>
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