@extends('app')

@section('htmlheader_title')
    Administrar Roles
@endsection
@section('contentheader_title')
    Administrar Roles
@endsection


@section('main-content')
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{--Content--}}
                        <table class="table table-hover" id="dataTable">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                @foreach($roles as $role)
                                    <th>{{ $role->name }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($users as $user)
                            <tr>
                               <form method="post" action="{{route('roles')}}">
                                   {{csrf_field()}}
                                   <input type="hidden" name="username" value="{{$user->username}}">
                                <td>{{$user->name}}</td>
                                {{--<td>{{date('F d, Y', strtotime($user->created_at))}}</td>--}}
                               @foreach($roles as $role)
                                <td><input type="checkbox" {{$user->hasRole($role->name) ? 'checked' : ''}} name="{{$role->name}}"></td>
                                @endforeach
                                <td><button type="submit" class="btn btn-sm">Actualizar</button> </td>
                               </form>
                            </tr>
                             @endforeach
                            </tbody>
                        </table>

                        {{--End Content--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
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
