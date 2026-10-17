@extends('plantilla')

@section('titulo'){{ lang('App.confirmarContrasena') }}@endsection

@section('contenido')
<h1>{{ lang('App.confirmarContrasena') }}</h1>
@if(($error ?? '') !== '')
    <p class="error">{{ $error }}</p>
@endif
<form class="formulario" method="post" action="{{ site_url('perfil/confirmar') }}">
    {!! csrf_field() !!}
    <div>
        <label for="contrasena">{{ lang('App.contrasena') }}</label>
        <input type="password" id="contrasena" name="contrasena">
    </div>
    <button class="boton" type="submit">{{ lang('App.enviar') }}</button>
    <a class="boton cancelar" href="{{ site_url('perfil') }}">{{ lang('App.cancelar') }}</a>
</form>
@endsection
