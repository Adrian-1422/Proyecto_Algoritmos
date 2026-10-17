<?= view('cabecera', ['titulo' => lang('App.olvide')]) ?>
<h1><?= esc(lang('App.olvide')) ?></h1>
<?php if (session('aviso')): ?>
    <p class="aviso"><?= esc(session('aviso')) ?></p>
<?php endif ?>
<?php if (session('error')): ?>
    <p class="error"><?= esc(session('error')) ?></p>
<?php endif ?>
<?php if (($aviso ?? '') !== ''): ?>
    <p class="aviso"><?= esc($aviso) ?></p>
<?php endif ?>
<?php if (($error ?? '') !== ''): ?>
    <p class="error"><?= esc($error) ?></p>
<?php endif ?>
<?= validation_list_errors() ?>
<form class="formulario" method="post" action="<?= site_url('recuperar') ?>">
    <?= csrf_field() ?>
    <div>
        <label for="correo"><?= esc(lang('App.correo')) ?></label>
        <input type="email" id="correo" name="correo" value="<?= set_value('correo') ?>">
    </div>
    <button class="boton" type="submit"><?= esc(lang('App.enviar')) ?></button>
    <a class="boton cancelar" href="<?= site_url('/') ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
