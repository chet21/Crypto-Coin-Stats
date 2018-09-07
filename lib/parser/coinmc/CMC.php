<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.07.2018
 * Time: 15:07
 */

class CMC extends \Lib\Parser\BaseParser
{
    public static function update_list()
    {
        $code = new \System\ORM('coin');
        $code->select('code');
        $code_list = $code->run();

        foreach ($code_list as $v){
            $arr[] = $v['code'];
        }

        $list = [];

        $data = file_get_contents('https://api.coinmarketcap.com/v2/listings/');

        $data = json_decode($data);

        foreach ($data->data as $k => $item){
            if(!in_array($item->id, $arr)){
                $list[] = ['title' => $item->name, 'index' => $item->symbol, 'code' => $item->id];
            }
        }
        return $list;
    }
}