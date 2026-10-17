@extends('plantilla')

@section('titulo'){{ lang('App.entrar') }}@endsection

@section('contenido')
<h1>{{ lang('App.entrar') }}</h1>
@if(session('aviso'))
    <p class="aviso">{{ session('aviso') }}</p>
@endif
@if(session('error'))
    <p class="error">{{ session('error') }}</p>
@endif
@if(($error ?? '') !== '')
    <p class="error">{{ $error }}</p>
@endif
{!! validation_list_errors() !!}
<form class="formulario" method="post" action="{{ site_url('entrar') }}">
    {!! csrf_field() !!}
    <div>
        <label for="correo">{{ lang('App.correo') }}</label>
        <input type="email" id="correo" name="correo" value="{{ set_value('correo', '', false) }}">
    </div>
    <div>
        <label for="contrasena">{{ lang('App.contrasena') }}</label>
        <input type="password" id="contrasena" name="contrasena">
    </div>
    <div class="casilla">
        <label>
            <input type="checkbox" name="recordarme" value="1">
            {{ lang('App.recordarme') }}
        </label>
    </div>
    <p><a href="{{ site_url('recuperar') }}">{{ lang('App.olvide') }}</a></p>
    <button class="boton" type="submit">{{ lang('App.entrar') }}</button>
    <a class="boton cancelar" href="{{ site_url('/') }}">{{ lang('App.cancelar') }}</a>
</form>
@endsection
