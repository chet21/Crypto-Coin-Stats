<?php

namespace App\Controllers;


class RegistrationController extends BaseSecureController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        if(!$this->user->checkUserInform('login', $_POST['login']) && !$this->user->checkUserInform('email', $_POST['email']))
        $this->user->addUser($_POST['login'], $_POST['password'], $_POST['email']);
    }

    public function validLoginAction()
    {
        if($this->user->checkUserInform('login', $_POST['login'])) return true;

    }

    public function validEmailAction()
    {
        if($this->user->checkUserInform('email', $_POST['email'])) return true;
    }
}