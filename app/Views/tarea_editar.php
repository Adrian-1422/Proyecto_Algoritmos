<?= view('cabecera', ['titulo' => lang('App.editarTarea')]) ?>
<h1><?= esc(lang('App.editarTarea')) ?></h1>
<?= validation_list_errors() ?>
<form class="formulario" method="post" action="<?= site_url('tareas/editar/' . $tarea['id']) ?>">
    <?= csrf_field() ?>
    <div>
        <label for="descripcion"><?= esc(lang('App.descripcion')) ?></label>
        <input type="text" id="descripcion" name="descripcion" value="<?= set_value('descripcion', $tarea['descripcion']) ?>">
    </div>
    <button class="boton" type="submit"><?= esc(lang('App.guardar')) ?></button>
    <a class="boton cancelar" href="<?= site_url('tareas/' . $tarea['id']) ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
