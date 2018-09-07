<?php

namespace App\Controllers;

use System\Error;
use Lib\User\User;

class BaseSecureController extends BaseController
{
    protected $user;

    public function __construct()
    {
        parent::__construct();
//
//        if(!$_POST){
//            Error::E404();
//        }
//        $this->user = new User();
    }
}