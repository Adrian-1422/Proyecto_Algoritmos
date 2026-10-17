<?= view('cabecera', ['titulo' => lang('App.eliminarFoto')]) ?>
<h1><?= esc(lang('App.eliminarFoto')) ?></h1>
<p class="datos"><?= esc(lang('App.seguro')) ?></p>
<form class="formulario" method="post" action="<?= site_url('perfil/eliminar') ?>">
    <?= csrf_field() ?>
    <button class="boton" type="submit"><?= esc(lang('App.guardar')) ?></button>
    <a class="boton cancelar" href="<?= site_url('perfil') ?>"><?= esc(lang('App.cancelar')) ?></a>
</form>
<?= view('pie') ?>
