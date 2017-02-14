@extends('app')

@section('htmlheader_title')
    Administrar Areas
@endsection
@section('contentheader_title')
    Administrar Areas
    {{--<a href="/areas/create/" class="btn btn-primary btn-lg"><i class="ion ion-ios-pricetag"></i> Crear Nueva</a>--}}
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                @include('flash::message')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="/sectores/create/" class="btn btn-primary" style="margin-bottom: -3em">
                            <i class="fa fa-plus"></i> Crear Nuevo
                        </a>
                        <table class="table table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Sector</th>
                                <th>Email</th>
                                <th>Fax</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sectors as $sector)
                                <tr>
                                    <td><a href="/sectores/{{ $sector->id }}">{{ $sector->name }}</a></td>
                                    <td><a href="/areas/{{ $sector->area->id }}">{{ $sector->area->name }}</a></td>
                                    <td><a href="mailto:{{ $sector->email }}">{{ $sector->email }}</a></td>
                                    <td>{{ $sector->fax }}</td>
                                    <td align="right">
                                        <a href="/sector/{{$sector->id}}" class="btn btn-sm btn-default">Ver</a>
                                        <a href="/sector/{{$sector->id}}/edit" class="btn btn-sm btn-primary">Editar</a>
                                        <button type="button" class="btn btn-sm btn-danger"
                                                data-toggle="modal"
                                                data-target="#modalDelete"
                                                data-id="{{ $sector->id }}"
                                                data-name="{{$sector->name}}"
                                                data-model="sectores">Borrar
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