<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../lib/parser/news/NewsParser24Ua.php';
require_once __DIR__.'/../lib/parser/news/NewsParserObozrevatel.php';
//require_once __DIR__.'/../lib/parser/proxy/ProxyParser2.php';

//use \Lib\Parser\News\SaveNews;
//use \Lib\Parser\News\NewsParser24Ua;
use \Lib\Parser\News\NewsParserObozrevatel;
use \Lib\Parser\News\NewsEtceteraMedia;


//SaveNews::add_new();


$x = new NewsEtceteraMedia('1');

 var_dump($x->data);