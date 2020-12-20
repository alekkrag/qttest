<?php


namespace App\Controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class BaseController
{
    protected $twig;

    public function __construct()
    {
        session_start();
        $this->twig = new Environment(new FilesystemLoader(__DIR__ . '/../Views/'), [
            'debug' => true
        ]);
        $this->twig->addGlobal('session', $_SESSION);
        $this->twig->addExtension(new DebugExtension());
    }
}