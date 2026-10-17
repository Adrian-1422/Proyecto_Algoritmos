@extends('plantilla')

@section('titulo'){{ lang('App.usuario') }}@endsection

@section('contenido')
<h1>{{ lang('App.usuario') }}</h1>
<p class="volver"><a href="{{ site_url('usuarios') }}">{{ lang('App.volverListado') }}</a></p>
<div class="datos">
    <div>{{ lang('App.nombre') }}</div>
    <div>{{ $usuario['nombre'] }}</div>
    <div>{{ lang('App.correo') }}</div>
    <div>{{ $usuario['correo'] }}</div>
    <div>{{ lang('App.activo') }}</div>
    <div>@if((int) $usuario['activo'] === 1){{ lang('App.si') }}@else{{ lang('App.no') }}@endif</div>
    <div>{{ lang('App.administrador') }}</div>
    <div>@if((int) $usuario['administrador'] === 1){{ lang('App.si') }}@else{{ lang('App.no') }}@endif</div>
    <div>{{ lang('App.creado') }}</div>
    <div>{{ $usuario['creado_en'] }}</div>
    <div>{{ lang('App.actualizado') }}</div>
    <div>{{ $usuario['actualizado_en'] }}</div>
</div>
<div class="acciones">
    <a href="{{ site_url('usuarios/editar/' . $usuario['id']) }}">{{ lang('App.editar') }}</a>
    <a href="{{ site_url('usuarios/eliminar/' . $usuario['id']) }}">{{ lang('App.eliminar') }}</a>
</div>
@endsection
