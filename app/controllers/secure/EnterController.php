<?php

namespace App\Controllers;


use Lib\User\User;

class EnterController extends BaseSecureController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
//        echo $this->user->enterUser($_POST['login'], $_POST['password']);
        echo $this->twig->render('sign/enter', array());
//        echo $_POST;
    }

    public function sendAction()
    {
        $user = new User($_POST['login'], $_POST['password']);
        $res = $user->enterUser();

        echo $res;
    }
}