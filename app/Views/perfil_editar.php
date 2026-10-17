<?= view('cabecera', ['titulo' => lang('App.editarPerfil')]) ?>
<h1><?= esc(lang('App.editarPerfil')) ?></h1>
<?= validation_list_errors() ?>
<form class="formulario" method="post" action="<?= site_url('perfil/editar') ?>">
    <?= csrf_field() ?>
    <div>
        <label for="nombre"><?= esc(lang('App.nombre')) ?></label>
        <input type="text" id="nombre" name="nombre" value="<?= set_value('nombre', $usuario['nombre']) ?>">
    </div>
    <div>
        <label for="correo"><?= esc(lang('App.correo')) ?></label>
        <input type="email" id="correo" name="correo" value="<?= set_value('correo', $usuario['correo']) ?>">
    </div>
    <button class="boton" type="submit"><?= esc(lang('App.guardar')) ?></button>
    <a class="boton cancelar" href="<?= site_url('perfil') ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
