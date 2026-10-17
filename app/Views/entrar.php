<?= view('cabecera', ['titulo' => lang('App.entrar')]) ?>
<h1><?= esc(lang('App.entrar')) ?></h1>
<?php if (session('aviso')): ?>
    <p class="aviso"><?= esc(session('aviso')) ?></p>
<?php endif ?>
<?php if (session('error')): ?>
    <p class="error"><?= esc(session('error')) ?></p>
<?php endif ?>
<?php if (($error ?? '') !== ''): ?>
    <p class="error"><?= esc($error) ?></p>
<?php endif ?>
<?= validation_list_errors() ?>
<form class="formulario" method="post" action="<?= site_url('entrar') ?>">
    <?= csrf_field() ?>
    <div>
        <label for="correo"><?= esc(lang('App.correo')) ?></label>
        <input type="email" id="correo" name="correo" value="<?= set_value('correo') ?>">
    </div>
    <div>
        <label for="contrasena"><?= esc(lang('App.contrasena')) ?></label>
        <input type="password" id="contrasena" name="contrasena">
    </div>
    <div class="casilla">
        <label>
            <input type="checkbox" name="recordarme" value="1">
            <?= esc(lang('App.recordarme')) ?>
        </label>
    </div>
    <button class="boton" type="submit"><?= esc(lang('App.entrar')) ?></button>
    <a class="boton cancelar" href="<?= site_url('/') ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
