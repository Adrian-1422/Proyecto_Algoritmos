@extends('plantilla')

@section('titulo'){{ lang('App.bienvenida') }}@endsection

@section('contenido')
<h1>{{ lang('App.bienvenida') }}</h1>
<p class="datos">{{ lang('App.mensajeBienvenida') }}</p>
@endsection
