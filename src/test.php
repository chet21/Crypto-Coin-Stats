<?php

require_once __DIR__.'/../vendor/autoload.php';

$x = new \System\ORM(['token', 'user']);
$x->select();
echo $x->query;

