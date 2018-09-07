<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.07.2018
 * Time: 19:28
 */

namespace App\Controllers;


use System\ORM;

class ApiController
{
    public function coininfoAction($id){

        $coin = new ORM('coin');
        $coin->select();
        $coin->where('id = '.$id[0]);
        $coin = $coin->run();

//        echo json_encode($coin[0], JSON_PRETTY_PRINT);
        echo (json_encode($coin[0]));
    }
}