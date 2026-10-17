@extends('plantilla')

@section('titulo'){{ lang('App.eliminar') }}@endsection

@section('contenido')
<h1>{{ lang('App.eliminar') }}</h1>
<p class="datos">{{ lang('App.seguro') }}</p>
<form class="formulario" method="post" action="{{ site_url('tareas/eliminar/' . $tarea['id']) }}">
    {!! csrf_field() !!}
    <button class="boton" type="submit">{{ lang('App.guardar') }}</button>
    <a class="boton cancelar" href="{{ site_url('tareas/' . $tarea['id']) }}">{{ lang('App.cancelar') }}</a>
</form>
@endsection
