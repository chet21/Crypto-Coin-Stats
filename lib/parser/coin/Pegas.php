<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.07.2018
 * Time: 15:01
 */

class Pegas extends BaseCoinParser
{
//    private $price_link = 'https://api.coinmarketcap.com/v2/ticker/';
    private $explorer_link = 'http://explorer.pegascoin.com/address/';
    private $explorer_param = '?method=address&param2=';
    private $addresses = array();
    private $price;

    const index = 'PGC';
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

    public function price_update()
    {
        $data = self::curl('https://btc-alpha.com/api/v1/exchanges/?pair=PGC_BTC');

        $hp = 0;
        $t = 0;
        foreach (json_decode($data) as $item){
            $hp += $item->price;
            $t++;
        }
        $price = ($hp/$t)*$this->getBitcoinPrice();

        return array('index' => self::index, 'price' => $price);
    }

    public function post_update()
    {
        $out = array();
        foreach ($this->addresses as $k => $address)
        {
            $amount = self::curl($this->explorer_link.$address.$this->explorer_param.$address);
            $amount = json_decode($amount);

            $out[] = array('address' => '\''.$address.'\'', 'amount' => $amount->balance);
        }
        return $out;
    }

}