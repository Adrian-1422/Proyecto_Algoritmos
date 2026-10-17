@extends('plantilla')

@section('titulo'){{ lang('App.editarTarea') }}@endsection

@section('contenido')
<h1>{{ lang('App.editarTarea') }}</h1>
{!! validation_list_errors() !!}
<form class="formulario" method="post" action="{{ site_url('tareas/editar/' . $tarea['id']) }}">
    {!! csrf_field() !!}
    <div>
        <label for="descripcion">{{ lang('App.descripcion') }}</label>
        <input type="text" id="descripcion" name="descripcion" value="{{ set_value('descripcion', $tarea['descripcion'], false) }}">
    </div>
    <button class="boton" type="submit">{{ lang('App.guardar') }}</button>
    <a class="boton cancelar" href="{{ site_url('tareas/' . $tarea['id']) }}">{{ lang('App.cancelar') }}</a>
</form>
@endsection
