@extends('plantilla')

@section('titulo'){{ lang('App.eliminarFoto') }}@endsection

@section('contenido')
<h1>{{ lang('App.eliminarFoto') }}</h1>
<p class="datos">{{ lang('App.seguro') }}</p>
<form class="formulario" method="post" action="{{ site_url('perfil/eliminar') }}">
    {!! csrf_field() !!}
    <button class="boton" type="submit">{{ lang('App.guardar') }}</button>
    <a class="boton cancelar" href="{{ site_url('perfil') }}">{{ lang('App.cancelar') }}</a>
</form>
@endsection
