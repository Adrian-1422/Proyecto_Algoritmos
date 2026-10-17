<?php

namespace App\Controllers;

class Inicio extends BaseController
{
    public function index(): string
    {
        return view('bienvenida');
    }

    public function idioma(string $idioma)
    {
        if ($idioma === 'en' || $idioma === 'es') {
            session()->set('idioma', $idioma);
        }

        return redirect()->back();
    }
}
