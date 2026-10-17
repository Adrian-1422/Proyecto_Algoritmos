@extends('plantilla')

@section('titulo'){{ lang('App.editarUsuario') }}@endsection

@section('contenido')
<h1>{{ lang('App.editarUsuario') }}</h1>
<p class="volver"><a href="{{ site_url('usuarios') }}">{{ lang('App.volverListado') }}</a></p>
{!! validation_list_errors() !!}
<form class="formulario" method="post" action="{{ site_url('usuarios/editar/' . $usuario['id']) }}">
    {!! csrf_field() !!}
    <div>
        <label for="nombre">{{ lang('App.nombre') }}</label>
        <input type="text" id="nombre" name="nombre" value="{{ set_value('nombre', $usuario['nombre'], false) }}">
    </div>
    <div>
        <label for="correo">{{ lang('App.correo') }}</label>
        <input type="email" id="correo" name="correo" value="{{ set_value('correo', $usuario['correo'], false) }}">
    </div>
    <div>
        <label for="contrasena">{{ lang('App.contrasena') }}</label>
        <input type="password" id="contrasena" name="contrasena">
    </div>
    <div>
        <label for="repetir_contrasena">{{ lang('App.repetirContrasena') }}</label>
        <input type="password" id="repetir_contrasena" name="repetir_contrasena">
    </div>
    <div class="casilla">
        <label>
            <input type="checkbox" name="activo" value="1"{!! set_checkbox('activo', '1', (int) $usuario['activo'] === 1) !!}>
            {{ lang('App.activo') }}
        </label>
    </div>
    <div class="casilla">
        <label>
            <input type="checkbox" name="administrador" value="1"{!! set_checkbox('administrador', '1', (int) $usuario['administrador'] === 1) !!}>
            {{ lang('App.administrador') }}
        </label>
    </div>
    <button class="boton" type="submit">{{ lang('App.guardar') }}</button>
    <a class="boton cancelar" href="{{ site_url('usuarios/' . $usuario['id']) }}">{{ lang('App.cancelar') }}</a>
</form>
@endsection
