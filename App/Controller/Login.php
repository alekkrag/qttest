<?php


namespace App\Controller;


use App\Lib\BaseActionInterface;
use App\Lib\DBConnectionInterface;

class Login extends BaseController implements BaseActionInterface
{

    private $dbConnection;

    public function __construct(DBConnectionInterface $dbConnection)
    {
        parent::__construct();
        $this->dbConnection = $dbConnection->connect();
    }

    public function indexAction()
    {
        echo $this->twig->render('login/index.html.twig');
    }

    public function loginAction()
    {
    }
}