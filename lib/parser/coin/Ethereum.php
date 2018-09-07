<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.07.2018
 * Time: 11:14
 */

class Ethereum extends \Lib\Parser\BaseParser
{
    private $price_link = 'https://api.coinmarketcap.com/v2/ticker/';
    private $explorer_link = 'https://api.etherscan.io/api?module=account&action=balance&address=';
    private $addresses = array();
    private $price;

    const index = 'ETH';
    const code = 1027;

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
           $rec = self::curl($this->explorer_link.$address);
           $rec = json_decode($rec);

            $amount = $rec->result / 1000000000000000000;

            $out[] = array('address' => '\''.$address.'\'', 'amount' => $amount);
        }
        return $out;
    }
}