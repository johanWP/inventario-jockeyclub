@extends('app')

@section('htmlheader_title')
    Administrar usuarios
@endsection
@section('contentheader_title')
    Administrar usuarios
    <a href="/usuarios/create/" class="btn btn-primary btn-lg"><i class="ion ion-person-add"></i> Crear Nuevo</a>
@endsection


@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                @include('flash::message')

                <div class="panel panel-default">
                    {{--<div class="panel-heading">Usuarios</div>--}}

                    <div class="panel-body">
                        <table class="table table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Sector</th>
                                <th>Área</th>
                                <th>Ext</th>
                                <th>Email</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                  <td>{{$user->area->sector->name}}</td>
                                      <td>{{$user->area->name}}</td>
                                    <td>{{$user->ext}}</td>
                                    <td>{{$user->email}}</td>
                                    <td align="right">
                                        <a href="usuarios/{{$user->id}}" class="btn btn-sm btn-default">Ver</a>
                                        <a href="usuarios/{{$user->id}}/edit" class="btn btn-sm btn-primary">Editar</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete" data-id="{{ $user->id }}" data-name="{{$user->name}}" data-model="usuarios">Borrar</button>
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