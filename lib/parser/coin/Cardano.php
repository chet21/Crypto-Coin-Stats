<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.07.2018
 * Time: 16:41
 */

class Cardano extends \Lib\Parser\BaseParser
{
    private $base_link = 'https://cardanoexplorer.com/api/addresses/summary/';
    private $addresses = array();
//    private $price;

    const index = 'ADA';
    const code = 2010;

    public function __construct()
    {
        $this->get_addr();
//        $this->price_update();
    }

    public function get_addr()
    {
        $x = new \System\ORM(array('post', 'coin'));
        $x->select(array('address'), \System\ORM::LEFT_JOIN);
        $x->where('code = \'' . self::code . '\'');

        $res = $x->run();

        foreach ($res as $item) {
            $this->addresses[] = $item['address'];
        }
    }

    public function price_update()
    {
        $data = file_get_contents('https://api.coinmarketcap.com/v2/ticker/'.self::code);
        $data = json_decode($data);

        $price = $data->data->quotes->USD->price;

        return array('index' => self::index, 'price' => $price);
//        return ['index' => self::index, 'price' => $price];
    }

    public function post_update()
    {
        $out = array();
        foreach ($this->addresses as $k => $address)
        {
            $rec = self::curl($this->base_link.$address);
            $rec = json_decode($rec);

            $amount = $rec->Right->caBalance->getCoin / 1000000;

            $out[] = array('address' => '\''.$address.'\'', 'amount' => $amount);
        }
        return $out;
    }
}