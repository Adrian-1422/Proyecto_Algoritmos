<?= view('cabecera', ['titulo' => lang('App.confirmarContrasena')]) ?>
<h1><?= esc(lang('App.confirmarContrasena')) ?></h1>
<?php if (($error ?? '') !== ''): ?>
    <p class="error"><?= esc($error) ?></p>
<?php endif ?>
<form class="formulario" method="post" action="<?= site_url('perfil/confirmar') ?>">
    <?= csrf_field() ?>
    <div>
        <label for="contrasena"><?= esc(lang('App.contrasena')) ?></label>
        <input type="password" id="contrasena" name="contrasena">
    </div>
    <button class="boton" type="submit"><?= esc(lang('App.enviar')) ?></button>
    <a class="boton cancelar" href="<?= site_url('perfil') ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
