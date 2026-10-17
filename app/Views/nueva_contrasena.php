<?= view('cabecera', ['titulo' => lang('App.nuevaContrasena')]) ?>
<h1><?= esc(lang('App.nuevaContrasena')) ?></h1>
<?php if (($error ?? '') !== ''): ?>
    <p class="error"><?= esc($error) ?></p>
<?php endif ?>
<?= validation_list_errors() ?>
<form class="formulario" method="post" action="<?= site_url('restablecer/' . $token) ?>">
    <?= csrf_field() ?>
    <div>
        <label for="contrasena"><?= esc(lang('App.nuevaContrasena')) ?></label>
        <input type="password" id="contrasena" name="contrasena">
    </div>
    <div>
        <label for="repetir_contrasena"><?= esc(lang('App.repetirContrasena')) ?></label>
        <input type="password" id="repetir_contrasena" name="repetir_contrasena">
    </div>
    <button class="boton" type="submit"><?= esc(lang('App.enviar')) ?></button>
    <a class="boton cancelar" href="<?= site_url('/') ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
