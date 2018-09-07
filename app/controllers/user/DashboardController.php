<?php
namespace App\Controllers;

use System\ORM;

class DashboardController extends BaseUserController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $all_coins = new ORM(array('post', 'coin', 'user'));
        $all_coins->select('*, post.id as post_id', ORM::LEFT_JOIN);
        $all_coins->where('user.id = '.$this->getUserID());
        $res = $all_coins->run();

        $total = 0;
        $t = array();
        foreach ($res as $item){
            $total += $item['amount'] * $item['price'];
            $t[$item['index']][] = $item;
        }

        echo $this->twig->render('index/index', array('data' => $res, 'total' => number_format($total, 2)));
    }
}