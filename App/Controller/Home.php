<?php


namespace App\Controller;


class Home extends BaseController
{
    public function indexAction()
    {
        echo $this->twig->render('layouts/index.html.twig');
    }
}