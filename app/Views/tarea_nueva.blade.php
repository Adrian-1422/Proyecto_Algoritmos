@extends('plantilla')

@section('titulo'){{ lang('App.nuevaTarea') }}@endsection

@section('contenido')
<h1>{{ lang('App.nuevaTarea') }}</h1>
{!! validation_list_errors() !!}
<form class="formulario" method="post" action="{{ site_url('tareas/nueva') }}">
    {!! csrf_field() !!}
    <div>
        <label for="descripcion">{{ lang('App.descripcion') }}</label>
        <input type="text" id="descripcion" name="descripcion" value="{{ set_value('descripcion', '', false) }}">
    </div>
    <button class="boton" type="submit">{{ lang('App.enviar') }}</button>
    <a class="boton cancelar" href="{{ site_url('tareas') }}">{{ lang('App.cancelar') }}</a>
</form>
@endsection
