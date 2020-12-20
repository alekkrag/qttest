<?php


namespace App\Controller;

use App\Lib\BaseActionInterface;

class Home extends BaseController implements BaseActionInterface
{
    public function indexAction()
    {
        echo $this->twig->render('layouts/index.html.twig');
    }
}