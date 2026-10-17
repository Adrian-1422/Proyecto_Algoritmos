@extends('plantilla')

@section('titulo'){{ lang('App.nuevaContrasena') }}@endsection

@section('contenido')
<h1>{{ lang('App.nuevaContrasena') }}</h1>
@if(($error ?? '') !== '')
    <p class="error">{{ $error }}</p>
@endif
{!! validation_list_errors() !!}
<form class="formulario" method="post" action="{{ site_url('restablecer/' . $token) }}">
    {!! csrf_field() !!}
    <div>
        <label for="contrasena">{{ lang('App.nuevaContrasena') }}</label>
        <input type="password" id="contrasena" name="contrasena">
    </div>
    <div>
        <label for="repetir_contrasena">{{ lang('App.repetirContrasena') }}</label>
        <input type="password" id="repetir_contrasena" name="repetir_contrasena">
    </div>
    <button class="boton" type="submit">{{ lang('App.enviar') }}</button>
    <a class="boton cancelar" href="{{ site_url('/') }}">{{ lang('App.cancelar') }}</a>
</form>
@endsection
