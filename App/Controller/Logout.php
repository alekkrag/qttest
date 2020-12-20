<?php


namespace App\Controller;

class Logout extends BaseController
{

    public function indexAction()
    {
        session_unset();
        header('Location: /');
    }
}