<?php


namespace App\Controller;

class Register extends BaseController
{
    public function indexAction()
    {
        echo $this->twig->render('register/index.html.twig');
    }

    public function registerAction()
    {
    }
}