@extends('app')

@section('htmlheader_title')
    Page not found
@endsection

@section('contentheader_title')
    404 Error Page
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

<div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Página no existe</h3>
        <p>
            No se pudo encontrar la página que estás buscando.
            Puedes <a href='{{ url('/home') }}'>regresar al INICIO</a> o usar el menú de navegación.
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