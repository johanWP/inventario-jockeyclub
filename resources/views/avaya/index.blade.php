@extends('auth.auth')

@section('htmlheader_title')
    Directorio Telefónico
@endsection

@section('content')
<body class="login-page">
    <div class="login-logo">
        <a href="{{ url('/home') }}"><img src="/img/logo-Jockey.png"></a>
    </div><!-- /.login-logo -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default center">
                <div class="panel-heading">Directorio Telefónico</div>
                <div class="panel-body">
                    @if($phones->count() > 0)
                    <table class="table table-hover" id="dataTable">
                        <thead>
                        <tr>
                            <th>Número Interno</th>
                            <th>Asignado a</th>
                            <th>Ubicación</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($phones as $phone)
                            <tr>
                                <td>{{ $phone->number }}</td>
                                <td>{{ $phone->place }}</td>
                                <td>{{ $phone->location }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <p class="text-muted text-center">No hay teléfonos registrados</p>
                    @endif
                </div> {{-- fin del panel body--}}
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
</body>

@endsection
