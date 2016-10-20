@extends('app')

@section('htmlheader_title')
    Papelera
@endsection
@section('contentheader_title')
    Papelera
@endsection

@section('main-content')
    <div class="container" id="container">

        @include('flash::message')
        {{--S E C T O R E S --}}
        <div class="row" id="msjPapeleraVacia">
            <div class="col-sm-11" style="color: #616366"><p class="h2 text-center">La papelera está vacía</p></div>
        </div>
    @if(count($sectores)>0)
            <div class="row">
            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-heading">Sectores</div>
                    <div class="panel-body">
                        <table class="table table-hover" id="datatable_sectores">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha de Eliminación</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sectores as $sector)
                                <tr>
                                    <td>{{ $sector->name }}</td>
                                    <td>{{ $sector->deleted_at }}</td>
                                    <td class="text-right">
                                        <form action="/papelera/sector/" id="frmSector_{{ $sector->id }}">
                                            <button class="btn btn-primary" id="btn">Restaurar</button>
                                            <input type="hidden" id="sector_{{ $sector->id }}" value="{{ $sector->id }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        {{--F I N   S E C T O R E S --}}
        
        {{--A R E A S--}}
        @if( count($areas) > 0 )
        <div class="row">
            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-heading">Áreas</div>
                    <div class="panel-body">
                        <table class="table table-hover" id="datatable_areas">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Sector</th>
                                <th>Fecha de Eliminación</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($areas as $area)
                                <tr>
                                    <td>{{ $area->name }}</td>
                                    <td><a href="/sectores/{{ $area->sector->id }}">{{ $area->sector->name }}</a></td>
                                    <td>{{ $area->deleted_at }}</td>
                                    <td class="text-right">
                                        <form action="/papelera/area/" id="frmArea_{{ $area->id }}">
                                            <button class="btn btn-primary" id="btn">Restaurar</button>
                                            <input type="hidden" id="area_{{ $area->id }}" value="{{ $area->id }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        {{--F I N    A R E A S --}}
        
        {{--U S U A R I O S--}}
        @if( count($usuarios) > 0 )
            <div class="row">
                <div class="col-md-11">
                    <div class="panel panel-default">
                        <div class="panel-heading">Usuarios</div>
                        <div class="panel-body">
                            <table class="table table-hover" id="datatable_usuarios">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Sector</th>
                                    <th>Area</th>
                                    <th>Fecha de Eliminación</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->name }}</td>
                                        <td><a href="/sectores/{{ $usuario->area->sector->id }}">{{ $usuario->area->sector->name }}</a></td>
                                        <td><a href="/areas/{{ $usuario->area->id }}">{{ $usuario->area->name }}</a></td>
                                        <td>{{ $usuario->deleted_at }}</td>
                                        <td class="text-right">
                                            <form action="/papelera/user/" id="frmUsuario_{{ $usuario->id }}">
                                                <button class="btn btn-primary" id="btn">Restaurar</button>
                                                <input type="hidden" id="usuario_{{ $usuario->id }}" value="{{ $usuario->id }}">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{--F I N   U S U A R I O S--}}
        
        {{--E Q U I P O S --}}
        {{--F I N   E Q U I P O S --}}
        
    </div>
    {{--End Content--}}

@endsection

@section('additional-scripts')
    @include('trash.papelera_js')
@endsection