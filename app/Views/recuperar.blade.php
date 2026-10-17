@extends('plantilla')

@section('titulo'){{ lang('App.olvide') }}@endsection

@section('contenido')
<h1>{{ lang('App.olvide') }}</h1>
@if(session('aviso'))
    <p class="aviso">{{ session('aviso') }}</p>
@endif
@if(session('error'))
    <p class="error">{{ session('error') }}</p>
@endif
@if(($aviso ?? '') !== '')
    <p class="aviso">{{ $aviso }}</p>
@endif
@if(($error ?? '') !== '')
    <p class="error">{{ $error }}</p>
@endif
{!! validation_list_errors() !!}
<form class="formulario" method="post" action="{{ site_url('recuperar') }}">
    {!! csrf_field() !!}
    <div>
        <label for="correo">{{ lang('App.correo') }}</label>
        <input type="email" id="correo" name="correo" value="{{ set_value('correo', '', false) }}">
    </div>
    <button class="boton" type="submit">{{ lang('App.enviar') }}</button>
    <a class="boton cancelar" href="{{ site_url('/') }}">{{ lang('App.cancelar') }}</a>
</form>
@endsection
