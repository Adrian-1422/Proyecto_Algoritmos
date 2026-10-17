<?= view('cabecera', ['titulo' => lang('App.usuarios')]) ?>
<h1><?= esc(lang('App.usuarios')) ?></h1>
<div class="acciones">
    <a class="boton azul" href="<?= site_url('usuarios/nuevo') ?>"><?= esc(lang('App.nuevoUsuario')) ?></a>
</div>
<table class="lista">
    <tr>
        <th><?= esc(lang('App.nombre')) ?></th>
        <th><?= esc(lang('App.correo')) ?></th>
        <th><?= esc(lang('App.activo')) ?></th>
        <th><?= esc(lang('App.administrador')) ?></th>
        <th><?= esc(lang('App.creado')) ?></th>
    </tr>
    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><a href="<?= site_url('usuarios/' . $usuario['id']) ?>"><?= esc($usuario['nombre']) ?></a></td>
            <td><?= esc($usuario['correo']) ?></td>
            <td><?= esc((int) $usuario['activo'] === 1 ? lang('App.si') : lang('App.no')) ?></td>
            <td><?= esc((int) $usuario['administrador'] === 1 ? lang('App.si') : lang('App.no')) ?></td>
            <td><?= esc($usuario['creado_en']) ?></td>
        </tr>
    <?php endforeach ?>
</table>
<div class="paginas">
    <a class="boton azul" href="<?= site_url('usuarios?pagina=' . max(1, $pagina - 1)) ?>"><?= esc(lang('App.nuevos')) ?></a>
    <a class="boton azul" href="<?= site_url('usuarios?pagina=' . ($pagina + 1)) ?>"><?= esc(lang('App.antiguos')) ?></a>
</div>
<?= view('pie') ?>
