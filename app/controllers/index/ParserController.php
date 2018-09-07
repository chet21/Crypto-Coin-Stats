<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.07.2018
 * Time: 16:39
 */

namespace App\Controllers;


use Helper\DateHelp;
use Lib\Parser\BaseParser;
use Lib\User\User;
use System\Log;
use System\ORM;
use Twig\Parser;


class ParserController extends \BaseCoinParser
{
    public function indexAction()
    {
        $start = microtime(true).'<br>';
        $list_coins = new ORM('coin');
        $list_coins->select('title');
        $list_coins = $list_coins->run();

        $list_obj = array();


        foreach ($list_coins as $k => $v){
            if(file_exists(__DIR__.'/../../../lib/parser/coin/'.$v['title'].'.php')){
                $obj = new $v['title'];
                $list_obj['obj'][] = $obj->post_update();
                $list_obj['price'][] = $obj->price_update();
            }else{
//                file_put_contents('updatelog.txt', DateHelp::time_log().' Class '.$v['title'].' coin not find!!'.PHP_EOL, FILE_APPEND);
                Log::write(' Class '.$v['title'].' coin not find!!');
                break;
            }
        }

        foreach ($list_obj['price'] as $item){
            $index = $item['index'];
            unset($item['index']);
            $price = new ORM('coin');
            $price->update($item);
            $price->where('`index` = '.'\''.$index.'\'');
            $price->run();
        }
        foreach ($list_obj['obj'] as $items){
            foreach ($items as $item){
                if(!empty($item)){
                    $address = $item['address'];
                    unset($item['address']);
                    $n = new ORM('post');
                    $n->update($item);
                    $n->where('address = '.$address);
                    $n->run();
                }
            }
        }
        $stop = microtime(true);
        $time = $stop - $start;

        Log::write($time.' s');
    }

    public function messageAction(){
        $obj = new ORM(array('post', 'user'));
        $obj->select('*', ORM::LEFT_JOIN);
        $data = $obj->run();





    }

    public function coinmcAction()
    {
        $x = new \Pegas();
        var_dump($x->price_update());
    }
}