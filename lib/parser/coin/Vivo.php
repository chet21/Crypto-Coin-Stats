<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.07.2018
 * Time: 15:01
 */

class Vivo extends \Lib\Parser\BaseParser
{
    private $price_link = 'https://api.coinmarketcap.com/v2/ticker/';
    private $explorer_link = 'http://vivo.explorerz.top:3003/ext/getbalance/';
    private $addresses = array();
    private $price;

    const index = 'VIVO';
    const code = 1956;

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

    public function price_update()
    {
        $data = file_get_contents($this->price_link.self::code);
        $data = json_decode($data);

        $price = $data->data->quotes->USD->price;

        return array('index' => self::index, 'price' => $price);
    }

    public function post_update()
    {
        $out = array();
        foreach ($this->addresses as $k => $address)
        {
            $amount = self::curl($this->explorer_link.$address);

            $out[] = array('address' => '\''.$address.'\'', 'amount' => $amount);
        }
        return $out;
    }

}