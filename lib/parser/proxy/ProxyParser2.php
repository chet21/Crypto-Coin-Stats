<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.04.2018
 * Time: 19:39
 */

namespace Lib\Parser;


class ProxyParser2 extends BaseParser
{
    static public function getIp()
    {
        $html = \phpQuery::newDocumentHTML(self::curl('https://hidemy.name/ru/proxy-list/?country=UA#list'));

        $x = $html->find('.proxy__t tr');

        foreach ($x as $v){
            $ip =  pq($v)->find('td:eq(0)')->text();
            $port =  pq($v)->find('td:eq(1)')->text();
            $res[] = $ip.':'.$port;
        }

        unset($res[0]);
        return $res;
    }

    public static function randIp()
    {
        $ip_arr = self::getIp();
        $max = count($ip_arr);
        $num = rand(1, $max);

        return $ip_arr[$num];
    }
}