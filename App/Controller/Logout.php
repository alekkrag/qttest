<?php


namespace App\Controller;

use App\Lib\BaseActionInterface;

class Logout extends BaseController implements BaseActionInterface
{

    public function indexAction()
    {
        session_unset();
        header('Location: /');
    }
}