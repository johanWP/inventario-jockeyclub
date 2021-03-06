<!DOCTYPE html>
<html lang="es">
<head>
    {{--<script src="{{ asset('/plugins/jQuery/jQuery-3.1.0.min.js') }}"></script>--}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    {{--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />--}}
    <style>
        body {
            font-family: 'Times New Roman', 'Helvetica Neue', Helvetica, serif;
            font-size: 14pt;
        }

    </style>
</head>
<body>
<div class="container">
    @yield('main-content')
</div>
</body>
</html>