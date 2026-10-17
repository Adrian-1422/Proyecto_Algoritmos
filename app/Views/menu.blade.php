@php
    $seccion = service('uri')->getSegment(1);
@endphp
<nav class="barra">
    <div>
        <a href="{{ site_url('/') }}">{{ lang('App.inicio') }}</a>
        <a href="{{ site_url('idioma/en') }}">English</a>
        <a href="{{ site_url('idioma/es') }}">Español</a>
    </div>
    <div>
        @if(session()->get('usuario_id'))
            <span class="saludo">{{ lang('App.hola') }}, {{ session()->get('usuario_nombre') }}</span>
            <a href="{{ site_url('perfil') }}"@if($seccion === 'perfil') class="activo"@endif>{{ lang('App.perfil') }}</a>
            @if(session()->get('es_administrador'))
                <a href="{{ site_url('usuarios') }}"@if($seccion === 'usuarios') class="activo"@endif>{{ lang('App.usuarios') }}</a>
            @endif
            <a href="{{ site_url('tareas') }}"@if($seccion === 'tareas') class="activo"@endif>{{ lang('App.tareas') }}</a>
            <a href="{{ site_url('salir') }}">{{ lang('App.salir') }}</a>
        @else
            <a href="{{ site_url('registro') }}">{{ lang('App.registro') }}</a>
            <a href="{{ site_url('entrar') }}">{{ lang('App.entrar') }}</a>
        @endif
    </div>
</nav>
