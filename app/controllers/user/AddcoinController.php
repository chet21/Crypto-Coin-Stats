<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.07.2018
 * Time: 15:02
 */

namespace App\Controllers;


use System\ORM;

class AddcoinController extends BaseUserController
{
    public function formAction()
    {
        $coin_list = new ORM('coin');
        $coin_list->select();
        $coin_list = $coin_list->run();

        echo $this->twig->render('addcoin/addcoin', array('coins' => $coin_list));
    }

    public function addAction()
    {
        if(isset($_POST) && $_POST != null)
        {
            unset($_POST['submit']);
            unset($_POST['index']);
            unset($_POST['price']);
            unset($_POST['note']);

            $_POST['id_user'] = $_SESSION['id'];

            $new_coin = new ORM('post');
            $new_coin->insert($_POST);
            $new_coin->run();

            unset($_POST);
        }

    }

    public function removeAction(){
        if(isset($_POST) && $_POST != null)
        {
            $new_coin = new ORM('post');
            $new_coin->delete();
            $new_coin->where('id = '.$_POST['id']);
            $new_coin->run();

            $sum = new ORM('');
            $sum->query = 'SELECT SUM(amount * price) as sum FROM post LEFT JOIN coin ON post.id_coin = coin.id';
            $sum = $sum->run();

            unset($_POST);

            echo round($sum[0]['sum'], 2);


        }
    }

}