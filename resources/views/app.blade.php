<!DOCTYPE html>
<html lang="es">
@yield('additional-scripts')
@include('partials.htmlheader')
@include('partials.scripts')

<body class="skin-green sidebar-mini">
<div class="wrapper" id="wrapper">

    @include('partials.mainheader')

    @include('partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include('partials.contentheader')

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
{{--            @include('partials.flash')--}}
            @yield('main-content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('partials.controlsidebar')

    @include('partials.footer')

</div><!-- ./wrapper -->


@include('partials.flash')
@yield('footer-scripts')
</body>
</html>