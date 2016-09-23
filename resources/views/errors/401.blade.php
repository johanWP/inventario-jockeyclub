@extends('app')

@section('htmlheader_title')
    Permisos Insuficientes
@endsection

@section('contentheader_title')
    Permisos Insuficientes
@endsection

@section('$contentheader_description')
    esta es la descripcion del cntenent header
@endsection

@section('main-content')

    <div class="error-page">
        <h2 class="headline text-yellow"> 401</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> No deberías estar aquí</h3>
            <p>
                Permisos insuficientes.
                Regresa al <a href='{{ url('/home') }}'>Escritorio</a> y usa el menu para navegar las opciones disponibles.
            </p>

            {{--<form class='search-form'>--}}
                {{--<div class='input-group'>--}}
                    {{--<input type="text" name="search" class='form-control' placeholder="Search"/>--}}
                    {{--<div class="input-group-btn">--}}
                        {{--<button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>--}}
                    {{--</div>--}}
                {{--</div><!-- /.input-group -->--}}
            {{--</form>--}}

        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
@endsection