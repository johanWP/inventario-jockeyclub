@extends('pdf.template')

@section('htmlheader_title')
    Guía de Contactos
@endsection
@section('contentheader_title')
    Guía de Contactos
@endsection

@section('main-content')
    <div class="container" id="container">
        <div class="row">
            <div class="col-md-11">
                <div class="panel panel-default">
                    {{--<div class="panel-heading">Áreas</div>--}}
                    <div class="panel-body">
                        <?php $nombreSector = ''; $nombreArea = ''; ?>
                        @foreach($sectores as $sector)

                            @if( $sector->name != $nombreSector )
                                <h1>{{ $sector->name }}</h1>
                                <?php $nombreSector = $sector->name ?>
                            @endif

                            @foreach($sector->areas as $area)
                                @if($nombreArea != $area->name)
                                    <h2>{{ $area->name }}</h2>
                                    <?php $nombreArea = $area->name ?>
                                    <table class="table table-hover" id="datatable_areas">
                                        <thead>
                                        <tr>
                                            <th width="35%">Nombre</th>
                                            <th width="25%">Cargo</th>
                                            <th width="15%">Extensión</th>
                                            <th width="25%">Email</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @endif
                                        @foreach($area->users as $user)
                                            @if($user->user_type != 'V')
                                            <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->position }}</td>
                                            <td>{{ $user->ext }}</td>
                                            <td>{{ $user->email }}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--End Content--}}

@endsection