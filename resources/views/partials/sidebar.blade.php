<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                {{--<img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />--}}
                @if(file_exists('img/userImages/'.Auth::user()->username.'.jpg'))
                    <img src="/img/userImages/{{Auth::user()->username}}.jpg" class="img-circle" alt="{{Auth::user()->username}}"/>
                @else
                    <img src="/img/user2-160x160.jpg" class="img-circle" alt="{{Auth::user()->username}}"/>
                @endif
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                {{--<input type="text" name="q" class="form-control" placeholder="Search..."/>--}}
              <span class="input-group-btn">
                {{--<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>--}}
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>Home</span></a></li>
            @if(Auth::user()->hasRole('Admin'))
            {{--<li><a href="/rolesAdmin/"><i class='fa fa-user-md'></i> <span>Roles Admin</span></a></li>--}}
            @endif
            {{--<li><a href="/proveedores/"><i class='fa fa-link'></i> <span>Solo Proveedores</span></a></li>--}}
            <li class="treeview">
                <a href="#"><i class='fa fa-pie-chart'></i> <span>Sectores</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/sectores/create">Crear nuevo</a></li>
                    <li><a href="/sectores">Ver Todos</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class='fa fa-area-chart'></i> <span>Areas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/areas/create">Crear nueva</a></li>
                    <li><a href="/areas">Ver Todas</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class='fa fa-desktop'></i> <span>Equipos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/equipos/create">Crear nuevo</a></li>
                    <li><a href="/equipos">Ver Todos</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class='fa fa-exchange'></i> <span>Movimientos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/movimientos/create">Crear nuevo</a></li>
                    <li><a href="/movimientos">Ver Todos</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class='fa fa-phone'></i> <span>Directorio Telefónico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/avaya/import">Importar</a></li>
                    <li><a href="/directorio" target="_blank">Ver Directorio</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/usuarios/create">Crear nuevo</a></li>
                    <li><a href="/usuarios/import">Importar desde CSV</a></li>
                    <li><a href="/usuarios">Ver Todos</a></li>
                </ul>
            </li>

            {{--<li><a href="/papelera"><i class='fa fa-trash'></i> <span>Papelera</span></a></li>--}}
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
