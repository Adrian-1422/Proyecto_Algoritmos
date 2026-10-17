<?= view('cabecera', ['titulo' => lang('App.nuevaTarea')]) ?>
<h1><?= esc(lang('App.nuevaTarea')) ?></h1>
<?= validation_list_errors() ?>
<form class="formulario" method="post" action="<?= site_url('tareas/nueva') ?>">
    <?= csrf_field() ?>
    <div>
        <label for="descripcion"><?= esc(lang('App.descripcion')) ?></label>
        <input type="text" id="descripcion" name="descripcion" value="<?= set_value('descripcion') ?>">
    </div>
    <button class="boton" type="submit"><?= esc(lang('App.enviar')) ?></button>
    <a class="boton cancelar" href="<?= site_url('tareas') ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
