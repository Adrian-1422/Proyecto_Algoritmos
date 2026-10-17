@extends('plantilla')

@section('titulo'){{ lang('App.editarFoto') }}@endsection

@section('contenido')
<h1>{{ lang('App.editarFoto') }}</h1>
@if(($error ?? '') !== '')
    <p class="error">{{ $error }}</p>
@endif
{!! validation_list_errors() !!}
<form class="formulario" method="post" action="{{ site_url('perfil/foto') }}" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <div>
        <label for="foto">{{ lang('App.foto') }}</label>
        <input type="file" id="foto" name="foto" accept="image/jpeg,image/png">
    </div>
    <button class="boton" type="submit">{{ lang('App.guardar') }}</button>
    <a class="boton cancelar" href="{{ site_url('perfil') }}">{{ lang('App.cancelar') }}</a>
</form>
@endsection
