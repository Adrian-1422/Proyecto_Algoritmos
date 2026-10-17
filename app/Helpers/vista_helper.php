<?php

use eftec\bladeone\BladeOne;

function vista(string $nombre, array $datos = []): string
{
    $cache = WRITEPATH . 'cache/blade';
    if (! is_dir($cache)) {
        mkdir($cache, 0755, true);
    }

    $blade = new BladeOne(APPPATH . 'Views', $cache, BladeOne::MODE_AUTO);

    return $blade->run($nombre, $datos);
}
