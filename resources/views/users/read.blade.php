@extends('app')

@section('htmlheader_title')
    Detalle de {{ $user->name }}
@endsection

@section('contentheader_title')
    Detalles de {{ $user->name }}
@endsection

@section('main-content')
<div class="container">
    <section class="content" id="content">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <user_box user_id="{{ $user->id }}"></user_box>
                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Equipos Asignados</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    @if($user->inventario->count() > 0)
                        <ul class="list-unstyled">
                        @foreach($user->inventario as $equipo)
                            <li><a href="/equipos/{{ $equipo->id }}">{{ $equipo->marca }} {{ $equipo->modelo }}</a></li>
                        @endforeach
                        </ul>
                        <hr>
                        <p><a href="/movimientos/create" class="btn btn-primary">Asignar Nuevo Equipo</a></p>
                    @else
                        <p class="text-center text-muted">No tiene equipos asignados</p>
                    @endif
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#inventario" data-toggle="tab">Inventario</a></li>
                        <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                        <li><a href="#mensaje" data-toggle="tab">Mensaje Rápido</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="inventario">
                        @if($user->inventario->count() == 0)
                            <div class="text-center">
                                <p class="text-muted">No hay movimientos para mostrar</p>
                            </div>
                        @else
                        <?php $type = '';?>
                            @foreach($user->inventario->sortBy('type_id') as $equipo)
                            <!-- Post -->
                                <div class="post">
                                @if($type != $equipo->type_id)
                                <?php $type = $equipo->type_id ?>
                                    <div class="user-block"><h4>{{ $equipo->type->name }}</h4></div>
                                    @endif
                                    <div>
                                        <a href="/equipos/{{ $equipo->id }}">
                                            {{ $equipo->marca }} -
                                            {{ $equipo->modelo }}
                                        </a>
                                    </div>
                                    <p>{{ $equipo->nota }}</p>
                                </div> <!-- /.post -->
                            @endforeach
                        @endif
                        </div>

                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            @if($user->inventario->count() == 0)
                                <div class="text-center">
                                    <p class="text-muted">No hay movimientos para mostrar</p>
                                </div>
                            @else
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                            <?php $fecha= ''?>
                            @foreach($user->moves as $move)
                                @if($fecha != $move->created_at)
                                    <!-- timeline time label -->
                                        <li class="time-label">
                                            <span class="bg-red">{{ $move->created_at->format('d-M-Y H:i') }}</span>
                                        </li>
                                    <?php $fecha = $move->created_at ?>
                                    <!-- /.timeline-label -->
                                @endif
                                <!-- timeline item -->
                                    <li>
                                        @if($user->id != $move->origen)
                                            <i class="fa fa-arrow-right bg-aqua"></i>
                                        @else
                                            <i class="fa fa-arrow-left bg-orange"></i>
                                        @endif
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-user"></i> {{ $move->hechoPor->name }}</span>

                                            <h3 class="timeline-header">
                                                <a href="/equipos/{{ $move->asset->id }}">
                                                    {{ $move->asset->marca }}  {{ $move->asset->modelo }}, Serial: {{ $move->asset->serial }}
                                                </a>
                                            </h3>

                                            <div class="timeline-body">
                                                @if($user->id != $move->origen)
                                                    Recibido desde
                                                    <a href="/usuarios/{{ $move->usuarioOrigen->id }}">
                                                        {{ $move->usuarioOrigen->name }}
                                                    </a>
                                                @else
                                                    Enviado a
                                                    <a href="/usuarios/{{ $move->usuarioDestino->id }}">
                                                        {{ $move->usuarioDestino->name }}
                                                    </a>
                                                @endif
                                                <span class="pull-right"><a class="btn btn-primary btn-xs" href="/equipos/{{ $move->asset->id }}">Ver detalles</a></span>
                                            </div>
                                            {{--<div class="timeline-footer">--}}
                                            {{--</div>--}}
                                        </div>
                                    </li>
                                    <!-- END timeline item -->
                                @endforeach
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i> <span class="pull-right">Usuario creado {{ $user->created_at->format('d-M-Y h:i') }}</span>
                                </li>
                            </ul>
                            @endif
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="mensaje">
                            <div class="box box-default">
                                <div class="box-header ui-sortable-handle">
                                    <i class="fa fa-envelope"></i>

                                    <h3 class="box-title">Enviar Mensaje</h3>
                                </div>
                                <div class="box-body">
                                    <textarea id="textarea" placeholder="Esto no envía nada. No lo intente..." class="form-control"></textarea>
                                </div>
                                <div class="box-footer clearfix">
                                    <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                                        <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection
@section('footer-scripts')
    <!-- Bootstrap WYSIHTML5 -->
    <link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#textarea').wysihtml5();

            $('#sendEmail').on('click', function () {
                swal("Here's a message!")
                //TODO:  Enviar el email
            });
        })

    </script>
    <script type="x-template" id="user_box-template">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    @if(file_exists('img/userImages/'.$user->username.'.jpg'))
                        <img style="margin: 0 auto; width: 96px; height: 96px" class="profile-user-img img-responsive img-circle" src="/img/userImages/{{$user->username}}.jpg" alt="{{ $user->name }}">
                    @else
                        <img style="margin: 0 auto; width: 96px; height: 96px" class="profile-user-img img-responsive img-circle" src="/img/userImages/drand.jpg" alt="{{ $user->name }}">
                    @endif
                    <form action="frmUserDetails" v-show="editing">
                        <p class="text-danger text-center">@{{ error }}</p>
                        <div class="form-group">
                            <input type="text" v-show="editing" v-model="name"  class="form-control" style="margin-top: 2em">
                        </div>
                        <div class="form-group">
                            <input type="text" v-show="editing" v-model="position"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input v-model="email" v-show="editing" type="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" v-show="editing" id="ext" v-model="ext" class="form-control">
                        </div>
                        <div class="col-xs-6">
                            <button @click.prevent="edit" class="center-block btn btn-default">Cancelar</button>
                        </div>
                        <div class="col-xs-6">
                            <button @click.prevent="save" class="center-block btn btn-primary">Guardar</button>
                        </div>


                    </form>
                        <h3 v-show="!editing" v-model="name" class="profile-username text-center">@{{ name }}</h3>
                        <p class="text-muted text-center" v-show="!editing" v-model="position">@{{ position }}</p>
                        <ul class="list-group" v-show="!editing" >
                            <li class="list-group-item" style="border: none">
                                <a href="#">@{{ email }}</a>
                            </li>
                            <li class="list-group-item"  style="border: none">
                                <span v-model="ext" ><b>Interno: </b> @{{ ext }}</span>
                            </li>
                            <li class="list-group-item"  style="border: none">
                                <a href="/sectores/{{ $user->area->sector->id }}">{{ $user->area->sector->name }}</a>
                                -
                                <a href="/areas/{{ $user->area->id }}">{{ $user->area->name }}</a>
                            </li>
                        </ul>

                    <button v-show="!editing" @click.prevent="edit" class="center-block btn btn-primary">Edición Rápida</button>


                </div>
                <!-- /.box-body -->
            </div>
    </script>
    <script src="{{ asset('/js/vue/user-box-component.js') }}"></script>

@endsection