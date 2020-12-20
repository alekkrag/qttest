<?php


namespace App\Controller;

use App\Lib\DBConnectionInterface;
use App\Model;
use Simplon\Mysql\QueryBuilder\ReadQueryBuilder;
use App\Lib\BaseActionInterface;
use Rakit\Validation\Validator;

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
        //I did not have a time for this but this should be in service
        $validator = new Validator;
        $validation = $validator->validate($_POST + $_FILES, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (!$validation->fails()) {
            // validation passes
            $store = new Model\UserStore($this->dbConnection);
            $user = $store->readOne(
                (new ReadQueryBuilder())->addCondition(Model\UserModel::COLUMN_EMAIL, $_POST['email'])
            );
            $_SESSION["user_login_error"] = 'Wrong username or password';
            if ($user) {
                $validPassword = password_verify($_POST['password'], $user->getPassword());
                if ($validPassword) {
                    // Start the session
                    $_SESSION["user_login"] = $user->getName();
                    header('Location: /');
                    die();
                }
            }
        }else {
            $_SESSION["user_login_error"] = $validation->errors()->firstOfAll();
        }
        header('Location: /login');
    }
}