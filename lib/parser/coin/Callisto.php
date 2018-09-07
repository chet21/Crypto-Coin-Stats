<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.07.2018
 * Time: 13:34
 */

class Callisto extends \Lib\Parser\BaseParser
{
    private $price_link = 'https://api.coinmarketcap.com/v2/ticker/';
    private $explorer_link = 'https://callistoexplorer.com/web3relay';
    private $addresses = array();
    private $price;

    const index = 'CLO';
    const code = 2757;

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
            $data_string = json_encode(array(
                'addr' => "$address",
                'options' => array(
                    'balance'
                )
            ));

            $ch = curl_init('https://callistoexplorer.com/web3relay');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
            );

            $amount = json_decode(curl_exec($ch));
            var_dump($amount);

            $out[] = array('address' => '\''.$address.'\'', 'amount' => $amount->balance);
        }
        return $out;

    }
}
