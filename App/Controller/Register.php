<?php


namespace App\Controller;

use App\Model;
use App\Lib\BaseActionInterface;
use App\Lib\DBConnectionInterface;
use Rakit\Validation\Validator;
use Simplon\Mysql\QueryBuilder\ReadQueryBuilder;
use Simplon\Mysql\QueryBuilder\CreateQueryBuilder;

class Register extends BaseController implements BaseActionInterface
{

    private $dbConnection;

    public function __construct(DBConnectionInterface $dbConnection)
    {
        parent::__construct();
        $this->dbConnection = $dbConnection->connect();
    }

    public function indexAction()
    {
        echo $this->twig->render('register/index.html.twig');
    }

    public function registerAction()
    {
        //I did not have a time for this but this should be in service
        $validator = new Validator;
        $validation = $validator->validate($_POST + $_FILES, [
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        if (!$validation->fails()) {
            // validation passes
            $store = new Model\UserStore($this->dbConnection);
            $user = $store->readOne(
                (new ReadQueryBuilder())->addCondition(Model\UserModel::COLUMN_EMAIL, $_POST['email'])
            );
            if (!$user) {
                $store->create(
                    (new CreateQueryBuilder())->setModel(
                        (new Model\UserModel())
                            ->setName($_POST['name'])
                            ->setEmail($_POST['email'])
                            ->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT))
                    )
                );
                header('Location: /');
                die();
            } else {
                $_SESSION["user_register_error"] = 'User exist';
            }
        } else {
            $_SESSION["user_register_error"] = $validation->errors()->firstOfAll();
        }
        header('Location: /register');
    }
}