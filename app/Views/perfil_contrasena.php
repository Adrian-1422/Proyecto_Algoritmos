<?= view('cabecera', ['titulo' => lang('App.cambiarContrasena')]) ?>
<h1><?= esc(lang('App.cambiarContrasena')) ?></h1>
<?php if (($error ?? '') !== ''): ?>
    <p class="error"><?= esc($error) ?></p>
<?php endif ?>
<?= validation_list_errors() ?>
<form class="formulario" method="post" action="<?= site_url('perfil/contrasena') ?>">
    <?= csrf_field() ?>
    <div>
        <label for="contrasena_actual"><?= esc(lang('App.contrasenaActual')) ?></label>
        <input type="password" id="contrasena_actual" name="contrasena_actual">
    </div>
    <div>
        <label for="contrasena"><?= esc(lang('App.nuevaContrasena')) ?></label>
        <input type="password" id="contrasena" name="contrasena">
    </div>
    <div>
        <label for="repetir_contrasena"><?= esc(lang('App.repetirContrasena')) ?></label>
        <input type="password" id="repetir_contrasena" name="repetir_contrasena">
    </div>
    <button class="boton" type="submit"><?= esc(lang('App.guardar')) ?></button>
    <a class="boton cancelar" href="<?= site_url('perfil') ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
