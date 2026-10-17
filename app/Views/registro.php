<?= view('cabecera', ['titulo' => lang('App.registro')]) ?>
<h1><?= esc(lang('App.registro')) ?></h1>
<?php if (($error ?? '') !== ''): ?>
    <p class="error"><?= esc($error) ?></p>
<?php endif ?>
<?= validation_list_errors() ?>
<form class="formulario" method="post" action="<?= site_url('registro') ?>">
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
    <button class="boton" type="submit"><?= esc(lang('App.registro')) ?></button>
    <a class="boton cancelar" href="<?= site_url('/') ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
