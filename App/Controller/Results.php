<?php


namespace App\Controller;

use App\Lib\BaseActionInterface;
use App\Lib\DBConnectionInterface;
use App\Model;
use Rakit\Validation\Validator;

class Results extends BaseController implements BaseActionInterface
{
    private $dbConnection;

    public function __construct(DBConnectionInterface $dbConnection)
    {
        parent::__construct();
        $this->dbConnection = $dbConnection->connect();
    }

    public function indexAction()
    {
        $validator = new Validator;
        $validation = $validator->validate($_POST + $_FILES, [
            'searchCriteria' => 'required'
        ]);
        if($_SESSION['user_login']){
            if (!$validation->fails()) {
                // validation passes
                $store = new Model\UserStore($this->dbConnection);
                $users = $store->customMethod($_POST['searchCriteria']);
                echo $this->twig->render('results/index.html.twig', ['users' => $users]);
                die();
            } else {
                header('Location: /');
                die();
            }
        }
        $_SESSION["user_login_error"] = "Please login";
        header('Location: /login');
    }
}