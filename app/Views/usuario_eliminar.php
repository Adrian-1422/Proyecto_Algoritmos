<?= view('cabecera', ['titulo' => lang('App.eliminar')]) ?>
<h1><?= esc(lang('App.eliminar')) ?></h1>
<p class="datos"><?= esc(lang('App.seguro')) ?></p>
<?php if (($error ?? '') !== ''): ?>
    <p class="error"><?= esc($error) ?></p>
<?php endif ?>
<form class="formulario" method="post" action="<?= site_url('usuarios/eliminar/' . $usuario['id']) ?>">
    <?= csrf_field() ?>
    <button class="boton" type="submit"><?= esc(lang('App.guardar')) ?></button>
    <a class="boton cancelar" href="<?= site_url('usuarios/' . $usuario['id']) ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
