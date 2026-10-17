@extends('plantilla')

@section('titulo'){{ lang('App.tarea') }}@endsection

@section('contenido')
<h1>{{ lang('App.tarea') }}</h1>
<p class="volver"><a href="{{ site_url('tareas') }}">{{ lang('App.volverListado') }}</a></p>
<div class="datos">
    <div>{{ lang('App.id') }}</div>
    <div>{{ $tarea['id'] }}</div>
    <div>{{ lang('App.descripcion') }}</div>
    <div>{{ $tarea['descripcion'] }}</div>
    <div>{{ lang('App.creado') }}</div>
    <div>{{ $tarea['creado_en'] }}</div>
    <div>{{ lang('App.actualizado') }}</div>
    <div>{{ $tarea['actualizado_en'] }}</div>
</div>
<div class="acciones">
    <a href="{{ site_url('tareas/editar/' . $tarea['id']) }}">{{ lang('App.editar') }}</a>
    <a href="{{ site_url('tareas/eliminar/' . $tarea['id']) }}">{{ lang('App.eliminar') }}</a>
</div>
@endsection
