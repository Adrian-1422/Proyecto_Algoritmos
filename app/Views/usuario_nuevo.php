<?= view('cabecera', ['titulo' => lang('App.nuevoUsuario')]) ?>
<h1><?= esc(lang('App.nuevoUsuario')) ?></h1>
<p class="volver"><a href="<?= site_url('usuarios') ?>"><?= esc(lang('App.volverListado')) ?></a></p>
<?= validation_list_errors() ?>
<form class="formulario" method="post" action="<?= site_url('usuarios/nuevo') ?>">
    <?= csrf_field() ?>
    <div>
        <label for="nombre"><?= esc(lang('App.nombre')) ?></label>
        <input type="text" id="nombre" name="nombre" value="<?= set_value('nombre') ?>">
    </div>
    <div>
        <label for="correo"><?= esc(lang('App.correo')) ?></label>
        <input type="email" id="correo" name="correo" value="<?= set_value('correo') ?>">
    </div>
    <div>
        <label for="contrasena"><?= esc(lang('App.contrasena')) ?></label>
        <input type="password" id="contrasena" name="contrasena">
    </div>
    <div>
        <label for="repetir_contrasena"><?= esc(lang('App.repetirContrasena')) ?></label>
        <input type="password" id="repetir_contrasena" name="repetir_contrasena">
    </div>
    <button class="boton" type="submit"><?= esc(lang('App.guardar')) ?></button>
    <a class="boton cancelar" href="<?= site_url('usuarios') ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
