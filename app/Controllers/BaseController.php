<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;

    protected $helpers = ['url', 'form', 'cookie'];

    /**
     * @param CLIRequest|IncomingRequest $request
     *
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        $idioma = session()->get('idioma');
        if ($idioma === 'en' || $idioma === 'es') {
            $this->request->setLocale($idioma);
            service('language')->setLocale($idioma);
        }

        $recordarme = get_cookie('recordarme');
        if (! session()->get('usuario_id') && is_string($recordarme) && $recordarme !== '') {
            $usuario = model(\App\Models\UsuarioModel::class)
                ->where('token_recordarme', hash('sha256', $recordarme))
                ->where('activo', 1)
                ->first();

            if ($usuario) {
                session()->set([
                    'usuario_id'     => $usuario['id'],
                    'usuario_nombre' => $usuario['nombre'],
                ]);
            } else {
                delete_cookie('recordarme');
            }
        }

        // Preload any models, libraries, etc, here.
        // $this->session = service('session');
    }
}
