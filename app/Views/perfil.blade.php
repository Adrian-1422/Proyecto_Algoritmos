@extends('plantilla')

@section('titulo'){{ lang('App.perfil') }}@endsection

@section('contenido')
<h1>{{ lang('App.perfil') }}</h1>
@if(session('aviso'))
    <p class="aviso">{{ session('aviso') }}</p>
@endif
@if(empty($usuario['foto']))
    <img class="foto" src="{{ base_url('img/defecto.svg') }}" alt="{{ lang('App.foto') }}">
@else
    <img class="foto" src="{{ base_url('fotos/' . $usuario['foto']) }}" alt="{{ lang('App.foto') }}">
@endif
<div class="acciones">
    <a class="boton cancelar" href="{{ site_url('perfil/eliminar') }}">{{ lang('App.eliminarFoto') }}</a>
</div>
<div class="datos">
    <div>{{ lang('App.nombre') }}</div>
    <div>{{ $usuario['nombre'] }}</div>
    <div>{{ lang('App.correo') }}</div>
    <div>{{ $usuario['correo'] }}</div>
</div>
<div class="acciones">
    <a class="boton azul" href="{{ site_url('perfil/confirmar') }}">{{ lang('App.editar') }}</a>
    <a class="boton azul" href="{{ site_url('perfil/contrasena') }}">{{ lang('App.cambiarContrasena') }}</a>
    <a class="boton azul" href="{{ site_url('perfil/foto') }}">{{ lang('App.cambiarFoto') }}</a>
</div>
@endsection
