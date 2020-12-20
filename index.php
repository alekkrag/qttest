<?php

include __DIR__ . "/vendor/autoload.php";


use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Lib\MySQLConnection;
use App\Controller\Home;
use App\Controller\Login;
use App\Controller\Logout;
use App\Controller\Register;
use App\Controller\Results;

//default route
Router::get('/', function () {
    (new Home())->indexAction();
});
Router::get('/login', function () {
    (new Login(new MySQLConnection))->indexAction();
});
Router::get('/logout', function () {
    (new Logout())->indexAction();
});
Router::post('/loginSubmit', function () {
    (new Login(new MySQLConnection))->loginAction();
});
Router::get('/register', function () {
    (new Register(new MySQLConnection))->indexAction();
});
Router::post('/registerSubmit', function () {
    (new Register(new MySQLConnection))->registerAction();
});
Router::post('/search', function () {
    (new Results(new MySQLConnection))->indexAction();
});

App::run();