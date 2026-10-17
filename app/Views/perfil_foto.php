<?= view('cabecera', ['titulo' => lang('App.editarFoto')]) ?>
<h1><?= esc(lang('App.editarFoto')) ?></h1>
<?php if (($error ?? '') !== ''): ?>
    <p class="error"><?= esc($error) ?></p>
<?php endif ?>
<?= validation_list_errors() ?>
<form class="formulario" method="post" action="<?= site_url('perfil/foto') ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div>
        <label for="foto"><?= esc(lang('App.foto')) ?></label>
        <input type="file" id="foto" name="foto" accept="image/jpeg,image/png">
    </div>
    <button class="boton" type="submit"><?= esc(lang('App.guardar')) ?></button>
    <a class="boton cancelar" href="<?= site_url('perfil') ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
