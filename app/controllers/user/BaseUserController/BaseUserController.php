<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.02.2018
 * Time: 15:53
 */

namespace App\Controllers;

use System\ORM;
use Twig\Node\Expression\Binary\OrBinary;

class BaseUserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if($this->verification() == null) {
            header('Location: /');
        }

    }

    protected function getUserID()
    {
        $id = new ORM( 'token');
        $id->select('id_user as id');
        $id->where('token.hash = \''.$_SESSION['token'].'\'');
        $id = $id->run();

        return $id[0]['id'];
    }

}