@extends('plantilla')

@section('titulo'){{ lang('App.eliminar') }}@endsection

@section('contenido')
<h1>{{ lang('App.eliminar') }}</h1>
<p class="datos">{{ lang('App.seguro') }}</p>
@if(($error ?? '') !== '')
    <p class="error">{{ $error }}</p>
@endif
<form class="formulario" method="post" action="{{ site_url('usuarios/eliminar/' . $usuario['id']) }}">
    {!! csrf_field() !!}
    <button class="boton" type="submit">{{ lang('App.guardar') }}</button>
    <a class="boton cancelar" href="{{ site_url('usuarios/' . $usuario['id']) }}">{{ lang('App.cancelar') }}</a>
</form>
@endsection
