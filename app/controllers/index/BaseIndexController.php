<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.07.2018
 * Time: 17:32
 */

namespace App\Controllers;


class BaseIndexController extends BaseController
{
    public function __construct()
    {

        parent::__construct();

        if($this->verification() == true){
            header('Location: /dashboard');
        }
    }
}