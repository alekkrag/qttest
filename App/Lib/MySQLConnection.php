<?php


namespace App\Lib;

use  Simplon\Mysql\PDOConnector;
use  Simplon\Mysql\Mysql;

class MySQLConnection implements DBConnectionInterface
{
    private $params;

    public function __construct()
    {
        $this->params = Config::get('connectionDatabaseParams', '');
    }

    public function connect()
    {
        $pdo = new PDOConnector(
            $this->params['host'],
            $this->params['user'],
            $this->params['password'],
            $this->params['database']
        );
        $pdoConn = $pdo->connect('utf8', []);
        $dbConn = new Mysql($pdoConn);
        return $dbConn;
    }
}