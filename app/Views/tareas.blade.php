@extends('plantilla')

@section('titulo'){{ lang('App.tareas') }}@endsection

@section('contenido')
<h1>{{ lang('App.tareas') }}</h1>
<div class="acciones">
    <a class="boton azul" href="{{ site_url('tareas/nueva') }}">{{ lang('App.nuevaTarea') }}</a>
</div>
<form class="formulario" method="get" action="{{ site_url('tareas') }}">
    <div>
        <label for="q">{{ lang('App.buscar') }}</label>
        <input class="buscar" type="text" id="q" name="q" value="{{ $busqueda }}">
    </div>
</form>
<ul class="tareas">
    @foreach($tareas as $tarea)
        <li><a href="{{ site_url('tareas/' . $tarea['id']) }}">{{ $tarea['descripcion'] }}</a></li>
    @endforeach
</ul>
@php
    $nuevos = ['pagina' => max(1, $pagina - 1)];
    $antiguos = ['pagina' => $pagina + 1];
@endphp
@if($busqueda !== '')
    @php
        $nuevos['q'] = $busqueda;
        $antiguos['q'] = $busqueda;
    @endphp
@endif
<div class="paginas">
    <a class="boton azul" href="{{ site_url('tareas?' . http_build_query($nuevos)) }}">{{ lang('App.nuevos') }}</a>
    <a class="boton azul" href="{{ site_url('tareas?' . http_build_query($antiguos)) }}">{{ lang('App.antiguos') }}</a>
</div>
@endsection
