@extends('pdf.template')



@section('main-content')
    <div class="container" id="container" style="">
        <div class="row">
            <div class="col-md-11">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <!-- Logo -->
                    <tr>
                        <td style="width: 100%; margin: 0; padding: 0; text-align: center;">
                            <img src="{{ url('/img/logo-Jockey.png') }}">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <p class="h1 text-center" style="margin-bottom: 3em">Documento de Responsabilidad</p>
        <div class="row">
            <div class="col-md-11">
                <p>En la Ciudad de San Isidro, provincia de Buenos Aires a los {{ \Carbon\Carbon::now()->day }} días
                    del mes de {{ \Carbon\Carbon::now()->format('M') }} del año {{ \Carbon\Carbon::now()->year }},
                    se recibe de parte del área de Sistemas del Jockey Club A. C. el equipo que se especifica a continuación:
                </p>
                <p>Serial Interno: <strong>{{ $asset->serial }}</strong></p>
                <p>Serial del Fabricante: <strong>{{ $asset->serial_fabricante }}</strong></p>
                <p>Marca: <strong>{{ $asset->marca }}</strong></p>
                <p>Modelo: <strong>{{ $asset->modelo }}</strong></p>
                @if ($asset->type_id == 3 OR $asset->type_id == 3)
                    <p>Sistema Operativo: <strong>{{ $asset->nombreSistemaOperativo }}</strong></p>
                    <p>Disco Duro: <strong>{{ $asset->nombreDiscoDuro }}</strong></p>
                    <p>Procesador: <strong>{{ $asset->nombreProcesador }}</strong></p>
                @endif
                <p>Al momento de recibir el equipo aquí especificado se realizaron las pruebas de funcionamiento y
                    se encuentra en buen estado físico y de funcionamiento.</p>

            </div>
        </div>
    </div>

    <div class="row">
        <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 3em">
            <tr>
                <td>
                    <p class="text-center">Recibe el equipo</p>
                </td>
                <td>
                    <p class="text-center">Entrega el equipo</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="text-center">{{ $asset->owner->fullName }}</p>
                </td>
                <td> &nbsp; </td>
            </tr>
        </table>
    </div>
@endsection