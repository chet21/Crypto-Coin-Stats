<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.07.2018
 * Time: 13:34
 */

class Aura extends \Lib\Parser\BaseParser
{
//    private $price_link = 'https://api.coinmarketcap.com/v2/ticker/';
    private $explorer_link = 'https://explore.auraledger.com/#/address/';
    private $addresses = array();
    private $price;

    const index = 'ARA';
    const code = null;

    public function __construct()
    {
        $this->get_addr();
    }

    private function get_addr()
    {
        $x = new \System\ORM(array('post', 'coin'));
        $x->select(array('address'), \System\ORM::LEFT_JOIN);
        $x->where('code = \''.self::code.'\'');

        $res = $x->run();

        foreach ($res as $item){
            $this->addresses[] = $item['address'];
        }
    }

//    public function price_update()
//    {
//        $data = file_get_contents($this->price_link.self::code);
//        $data = json_decode($data);
//
//        $price = $data->data->quotes->USD->price;
//
//        return array('index' => self::index, 'price' => $price);
//    }

    public function post_update()
    {
//        $out = array();

//        foreach ($this->addresses as $k => $address)
//        {
            $html = self::curl($this->explorer_link.'0xc3d5d17e08966ff3f13b97702e2cc4e6659a85ef/');
            $data = phpQuery::newDocument($html);

            echo $data;
//            echo $amount = pq($data)->find('.ng-binding')->text();

//            $out[] = array('address' => '\''.$address.'\'', 'amount' => $amount);
//        }
//        return $out;
    }
}
