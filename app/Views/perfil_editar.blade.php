@extends('plantilla')

@section('titulo'){{ lang('App.editarPerfil') }}@endsection

@section('contenido')
<h1>{{ lang('App.editarPerfil') }}</h1>
{!! validation_list_errors() !!}
<form class="formulario" method="post" action="{{ site_url('perfil/editar') }}">
    {!! csrf_field() !!}
    <div>
        <label for="nombre">{{ lang('App.nombre') }}</label>
        <input type="text" id="nombre" name="nombre" value="{{ set_value('nombre', $usuario['nombre'], false) }}">
    </div>
    <div>
        <label for="correo">{{ lang('App.correo') }}</label>
        <input type="email" id="correo" name="correo" value="{{ set_value('correo', $usuario['correo'], false) }}">
    </div>
    <button class="boton" type="submit">{{ lang('App.guardar') }}</button>
    <a class="boton cancelar" href="{{ site_url('perfil') }}">{{ lang('App.cancelar') }}</a>
</form>
@endsection
