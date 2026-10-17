<?= view('cabecera', ['titulo' => lang('App.eliminar')]) ?>
<h1><?= esc(lang('App.eliminar')) ?></h1>
<p class="datos"><?= esc(lang('App.seguro')) ?></p>
<form class="formulario" method="post" action="<?= site_url('tareas/eliminar/' . $tarea['id']) ?>">
    <?= csrf_field() ?>
    <button class="boton" type="submit"><?= esc(lang('App.guardar')) ?></button>
    <a class="boton cancelar" href="<?= site_url('tareas/' . $tarea['id']) ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
