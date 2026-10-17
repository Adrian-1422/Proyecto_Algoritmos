<!DOCTYPE html>
<html lang="<?= esc(service('request')->getLocale()) ?>">
<head>
    <meta charset="UTF-8">
    <title><?= esc($titulo) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/estilos.css') ?>">
</head>
<body>
<?= view('menu') ?>
