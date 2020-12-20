<?php


namespace App\Controller;

use App\Lib\BaseActionInterface;

class Register extends BaseController implements BaseActionInterface
{
    public function indexAction()
    {
        echo $this->twig->render('register/index.html.twig');
    }

    public function registerAction()
    {
    }
}