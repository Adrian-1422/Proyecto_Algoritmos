<!DOCTYPE html>
<html lang="{{ service('request')->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{ base_url('css/estilos.css') }}">
</head>
<body>
@include('menu')
@yield('contenido')
</body>
</html>
