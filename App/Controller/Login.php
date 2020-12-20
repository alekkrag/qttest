<?php


namespace App\Controller;


class Login extends BaseController
{

    public function indexAction()
    {
        echo $this->twig->render('login/index.html.twig');
    }

    public function loginAction()
    {
    }
}