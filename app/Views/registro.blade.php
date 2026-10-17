@extends('plantilla')

@section('titulo'){{ lang('App.registro') }}@endsection

@section('contenido')
<h1>{{ lang('App.registro') }}</h1>
@if(($error ?? '') !== '')
    <p class="error">{{ $error }}</p>
@endif
{!! validation_list_errors() !!}
<form class="formulario" method="post" action="{{ site_url('registro') }}">
    {!! csrf_field() !!}
    <div>
        <label for="nombre">{{ lang('App.nombre') }}</label>
        <input type="text" id="nombre" name="nombre" value="{{ set_value('nombre', '', false) }}">
    </div>
    <div>
        <label for="correo">{{ lang('App.correo') }}</label>
        <input type="email" id="correo" name="correo" value="{{ set_value('correo', '', false) }}">
    </div>
    <div>
        <label for="contrasena">{{ lang('App.contrasena') }}</label>
        <input type="password" id="contrasena" name="contrasena">
    </div>
    <div>
        <label for="repetir_contrasena">{{ lang('App.repetirContrasena') }}</label>
        <input type="password" id="repetir_contrasena" name="repetir_contrasena">
    </div>
    <button class="boton" type="submit">{{ lang('App.registro') }}</button>
    <a class="boton cancelar" href="{{ site_url('/') }}">{{ lang('App.cancelar') }}</a>
</form>
@endsection
