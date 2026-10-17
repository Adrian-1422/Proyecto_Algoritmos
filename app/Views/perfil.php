<?= view('cabecera', ['titulo' => lang('App.perfil')]) ?>
<h1><?= esc(lang('App.perfil')) ?></h1>
<?php if (session('aviso')): ?>
    <p class="aviso"><?= esc(session('aviso')) ?></p>
<?php endif ?>
<img class="foto" src="<?= esc(empty($usuario['foto']) ? base_url('img/defecto.svg') : base_url('fotos/' . $usuario['foto'])) ?>" alt="<?= esc(lang('App.foto')) ?>">
<div class="acciones">
    <a class="boton cancelar" href="<?= site_url('perfil/eliminar') ?>"><?= esc(lang('App.eliminarFoto')) ?></a>
</div>
<div class="datos">
    <div><?= esc(lang('App.nombre')) ?></div>
    <div><?= esc($usuario['nombre']) ?></div>
    <div><?= esc(lang('App.correo')) ?></div>
    <div><?= esc($usuario['correo']) ?></div>
</div>
<div class="acciones">
    <a class="boton azul" href="<?= site_url('perfil/confirmar') ?>"><?= esc(lang('App.editar')) ?></a>
    <a class="boton azul" href="<?= site_url('perfil/contrasena') ?>"><?= esc(lang('App.cambiarContrasena')) ?></a>
    <a class="boton azul" href="<?= site_url('perfil/foto') ?>"><?= esc(lang('App.cambiarFoto')) ?></a>
</div>
<?= view('pie') ?>
