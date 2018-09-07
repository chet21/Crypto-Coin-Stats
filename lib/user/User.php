<?php

namespace Lib\User;


use App\Configuration\BaseConfiguration;
use Helper\Hash;
use System\ORM;

class User
{
    private $conf;
    private $orm;
    private $login;
    private $password;
    private $hash;

    public function __construct($login, $password)
    {
        $this->conf = new BaseConfiguration();
        $this->orm = new ORM(array('token', 'user'));
        $this->login = $login  = htmlspecialchars($login);
        $this->password = md5(htmlspecialchars($password).$this->conf->get('sold'));
        $this->hash = Hash::get();
    }

    public function enterUser()
    {
        if($this->checkUserOriginal())
        {
            $_SESSION['token'] = $this->hash;
            $_SESSION['id'] = $this->checkUserOriginal();
            $_SESSION['login'] = $this->login;

            $orm = new ORM('token');
            $orm->insert(array('hash' => $this->hash, 'id_user' => $this->checkUserOriginal()));
            $orm->run();
            return true;
        }
        return false;
    }

    public function addUser()
    {
        if($this->checkUserOriginal())
        {
            $orm = new ORM('user');
            $orm->insert(array('login' => $this->login, 'password' => $this->password));
            $orm->run();
            return $orm::lastID();
        } else{
            return false;
        }
    }

    public function checkUserOriginal()
    {
        $query = 'SHOW TABLES FROM '.$this->conf->get('db_name').' LIKE \'user\'';

        $this->orm->query = $query;
        $table = $this->orm->run();
        if ($table)
        {
            $orm = new ORM(array('token', 'user'));
            $orm->select('user.id', ORM::RIGHT_JOIN);
            $orm->where("login = '$this->login' AND password = '$this->password'");
            $res = $orm->run();

            $res = (!empty($res)) ? $res[0]['id'] : null;
            return $res;
        }else{
            throw new \Exception('Table \'user\' or \'token\' not exist, check them and repeat! ');
        }
    }
}