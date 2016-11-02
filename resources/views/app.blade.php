<!DOCTYPE html>
<html lang="es">

@include('partials.htmlheader')
@include('partials.scripts')
@yield('additional-scripts')
{{--
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
--}}
<body class="skin-green sidebar-mini">
<div class="wrapper">

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
</body>
</html>