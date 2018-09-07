<?php

namespace Lib\Parser;

use System\DB;

abstract class BaseParser
{
    protected static function curl($url, $link = null, $proxy = null, $cookie = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url.$link);
//        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_PROXY, $proxy);
        curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROTO_HTTP);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 YaBrowser/17.3.1.840 Yowser/2.5 Safari/537.36');
        curl_setopt($curl, CURLOPT_REFERER, 'http://www.google.com');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_COOKIEJAR, 'cook.txt');
        curl_setopt($curl, CURLOPT_COOKIEFILE, 'cook.txt');

        $str = curl_exec($curl);
        curl_close($curl);
        return $str;
    }

    protected static function translit($str)
    {
        $str = mb_strtolower($str, 'utf-8');
        $list = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ж' => 'j',
            'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm',
            'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
            'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ч' => 'ch', 'ц' => 'ts', 'ш' => 'sh',
            'щ' => 'shch', 'ы' => 'u', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', ' ' => '-',
            'ъ'=> '', 'ь'=> '');
        return strtr($str, $list);
    }
}