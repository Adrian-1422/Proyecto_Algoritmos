<?= view('cabecera', ['titulo' => lang('App.usuario')]) ?>
<h1><?= esc(lang('App.usuario')) ?></h1>
<p class="volver"><a href="<?= site_url('usuarios') ?>"><?= esc(lang('App.volverListado')) ?></a></p>
<div class="datos">
    <div><?= esc(lang('App.nombre')) ?></div>
    <div><?= esc($usuario['nombre']) ?></div>
    <div><?= esc(lang('App.correo')) ?></div>
    <div><?= esc($usuario['correo']) ?></div>
    <div><?= esc(lang('App.activo')) ?></div>
    <div><?= esc((int) $usuario['activo'] === 1 ? lang('App.si') : lang('App.no')) ?></div>
    <div><?= esc(lang('App.administrador')) ?></div>
    <div><?= esc((int) $usuario['administrador'] === 1 ? lang('App.si') : lang('App.no')) ?></div>
    <div><?= esc(lang('App.creado')) ?></div>
    <div><?= esc($usuario['creado_en']) ?></div>
    <div><?= esc(lang('App.actualizado')) ?></div>
    <div><?= esc($usuario['actualizado_en']) ?></div>
</div>
<div class="acciones">
    <a href="<?= site_url('usuarios/editar/' . $usuario['id']) ?>"><?= esc(lang('App.editar')) ?></a>
    <a href="<?= site_url('usuarios/eliminar/' . $usuario['id']) ?>"><?= esc(lang('App.eliminar')) ?></a>
</div>
<?= view('pie') ?>
