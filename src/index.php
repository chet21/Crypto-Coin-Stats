<?php

use App\Configuration\BaseConfiguration;
use System\Lang;
use \System\Router;

session_start();

require_once __DIR__.'/../vendor/autoload.php';


//$w_ip = require_once __DIR__.'/white_ip.php';
//
//if(count($w_ip) > 0){
//    $x = in_array($_SERVER['REMOTE_ADDR'], $w_ip);
//    if(!$x){
//        include_once __DIR__.'/loader.html';
//        exit();
//    }
//}


//if($_COOKIE['lang'] == 0){
//    setcookie('lang', 'ua', time() + 9999, '/');
//}
//

error_reporting(E_ALL);

BaseConfiguration::load(__DIR__.'/../var/config.php');



$start = new Router();
$start->Run();

