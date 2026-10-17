<?= view('cabecera', ['titulo' => lang('App.tarea')]) ?>
<h1><?= esc(lang('App.tarea')) ?></h1>
<p class="volver"><a href="<?= site_url('tareas') ?>"><?= esc(lang('App.volverListado')) ?></a></p>
<div class="datos">
    <div><?= esc(lang('App.id')) ?></div>
    <div><?= esc($tarea['id']) ?></div>
    <div><?= esc(lang('App.descripcion')) ?></div>
    <div><?= esc($tarea['descripcion']) ?></div>
    <div><?= esc(lang('App.creado')) ?></div>
    <div><?= esc($tarea['creado_en']) ?></div>
    <div><?= esc(lang('App.actualizado')) ?></div>
    <div><?= esc($tarea['actualizado_en']) ?></div>
</div>
<div class="acciones">
    <a href="<?= site_url('tareas/editar/' . $tarea['id']) ?>"><?= esc(lang('App.editar')) ?></a>
    <a href="<?= site_url('tareas/eliminar/' . $tarea['id']) ?>"><?= esc(lang('App.eliminar')) ?></a>
</div>
<?= view('pie') ?>
