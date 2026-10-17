@extends('plantilla')

@section('titulo'){{ lang('App.usuarios') }}@endsection

@section('contenido')
<h1>{{ lang('App.usuarios') }}</h1>
<div class="acciones">
    <a class="boton azul" href="{{ site_url('usuarios/nuevo') }}">{{ lang('App.nuevoUsuario') }}</a>
</div>
<table class="lista">
    <tr>
        <th>{{ lang('App.nombre') }}</th>
        <th>{{ lang('App.correo') }}</th>
        <th>{{ lang('App.activo') }}</th>
        <th>{{ lang('App.administrador') }}</th>
        <th>{{ lang('App.creado') }}</th>
    </tr>
    @foreach($usuarios as $usuario)
        <tr>
            <td><a href="{{ site_url('usuarios/' . $usuario['id']) }}">{{ $usuario['nombre'] }}</a></td>
            <td>{{ $usuario['correo'] }}</td>
            <td>@if((int) $usuario['activo'] === 1){{ lang('App.si') }}@else{{ lang('App.no') }}@endif</td>
            <td>@if((int) $usuario['administrador'] === 1){{ lang('App.si') }}@else{{ lang('App.no') }}@endif</td>
            <td>{{ $usuario['creado_en'] }}</td>
        </tr>
    @endforeach
</table>
<div class="paginas">
    <a class="boton azul" href="{{ site_url('usuarios?pagina=' . max(1, $pagina - 1)) }}">{{ lang('App.nuevos') }}</a>
    <a class="boton azul" href="{{ site_url('usuarios?pagina=' . ($pagina + 1)) }}">{{ lang('App.antiguos') }}</a>
</div>
@endsection
