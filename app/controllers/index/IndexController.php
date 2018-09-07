<?php

namespace App\Controllers;
use System\DB;
use System\ORM;

class IndexController extends BaseIndexController
{

    public function indexAction()
    {
        echo $this->twig->render('sign/enter', array());
    }

}
