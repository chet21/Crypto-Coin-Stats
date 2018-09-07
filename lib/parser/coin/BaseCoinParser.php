<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.07.2018
 * Time: 16:41
 */

class BaseCoinParser extends \Lib\Parser\BaseParser
{

    public function __construct()
    {

    }

    public static function html($url)
    {
        $x = \phpQuery::newDocument(self::curl($url));

        return $x;
    }

    protected function getBitcoinPrice()
    {
        $p = new \System\ORM('coin');
        $p->select('price');
        $p->where('title = \'Bitcoin\'');
        $res = $p->run();

        return $this->btc_price = $res[0]['price'];
    }
}