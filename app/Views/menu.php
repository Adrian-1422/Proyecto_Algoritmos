<nav class="barra">
    <div>
        <a href="<?= site_url('/') ?>"><?= esc(lang('App.inicio')) ?></a>
        <a href="<?= site_url('idioma/en') ?>">English</a>
        <a href="<?= site_url('idioma/es') ?>">Español</a>
    </div>
    <div>
        <?php if (session()->get('usuario_id')): ?>
            <span class="saludo"><?= esc(lang('App.hola')) ?>, <?= esc(session()->get('usuario_nombre')) ?></span>
            <a href="<?= site_url('perfil') ?>"<?><?= esc(lang('App.perfil')) ?></a>
            <a href="<?= site_url('salir') ?>"><?= esc(lang('App.salir')) ?></a>
        <?php else: ?>
            <a href="<?= site_url('registro') ?>"><?= esc(lang('App.registro')) ?></a>
            <a href="<?= site_url('entrar') ?>"><?= esc(lang('App.entrar')) ?></a>
        <?php endif ?>
    </div>
</nav>
