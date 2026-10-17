<?= view('cabecera', ['titulo' => lang('App.tareas')]) ?>
<h1><?= esc(lang('App.tareas')) ?></h1>
<div class="acciones">
    <a class="boton azul" href="<?= site_url('tareas/nueva') ?>"><?= esc(lang('App.nuevaTarea')) ?></a>
</div>
<form class="formulario" method="get" action="<?= site_url('tareas') ?>">
    <div>
        <label for="q"><?= esc(lang('App.buscar')) ?></label>
        <input type="text" id="q" name="q" value="<?= esc($busqueda) ?>">
    </div>
</form>
<ul class="tareas">
    <?php foreach ($tareas as $tarea): ?>
        <li><a href="<?= site_url('tareas/' . $tarea['id']) ?>"><?= esc($tarea['descripcion']) ?></a></li>
    <?php endforeach ?>
</ul>
<?php
    $nuevos = ['pagina' => max(1, $pagina - 1)];
    $antiguos = ['pagina' => $pagina + 1];
    if ($busqueda !== '') {
        $nuevos['q'] = $busqueda;
        $antiguos['q'] = $busqueda;
    }
?>
<div class="paginas">
    <a class="boton azul" href="<?= site_url('tareas?' . http_build_query($nuevos)) ?>"><?= esc(lang('App.nuevos')) ?></a>
    <a class="boton azul" href="<?= site_url('tareas?' . http_build_query($antiguos)) ?>"><?= esc(lang('App.antiguos')) ?></a>
</div>
<?= view('pie') ?>
