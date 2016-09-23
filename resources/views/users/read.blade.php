@extends('app')

@section('htmlheader_title')
    Usuario
@endsection

@section('contentheader_title')
    Detalles del Usuario
@endsection

@section('main-content')
    <div class="container">
<div class="col-sm-6">
    <div class="row">

        <div class="col-sm-4"><b>Nombre de usuario:</b></div>
        <div class="col-sm-8">{{ $user->username }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Nombre:</b></div>
        <div class="col-sm-8">{{ $user->name }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Email:</b></div>
        <div class="col-sm-8">{{ $user->email }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Extensión:</b></div>
        <div class="col-sm-8">{{ $user->ext }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Sector:</b></div>
        <div class="col-sm-8">{{ $user->area->sector->name }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Area:</b></div>
        <div class="col-sm-8">{{ $user->area->name }}</div>
    </div>
    <div class="row">
        <div class="col-sm-4"><b>Cargo:</b></div>
        <div class="col-sm-8">{{ $user->position }}</div>
    </div>

</div>
<div class="col-sm-4">
    <div class="col-sm-4">
        @if(file_exists('img/userImages/'.$user->username.'.jpg'))
            <img src="/img/userImages/{{$user->username}}.jpg">
        @else
            &nbsp;
        @endif
    </div>
</div>
<div class="row">

    <div class="col-sm-11">
        <ul>
        @foreach($user->inventario as $item)
                <li><a href="/equipos/{{$item->id}}">{{$item->type->name}} - {{ $item->serial }}</a></li>
        @endforeach
        </ul>
    </div>


</div>
<div class="row">
    <div class="col-sm-12">
        <a style="margin-top: 20px" class="btn btn-default" href="#" onclick="history.back()">Volver</a>
    </div>
</div>
</div>
@endsection
