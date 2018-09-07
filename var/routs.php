<?php

return array(
    // авторизація реєстрація вихід controller
    'enter' => 'enter/index',
    'send' => 'enter/send',
    'reg' => 'registration/index',
    'out', 'index/out',


    // default
    '' => 'index/index',
    'addcoin' => 'addcoin/form',
    'addcoin/add' => 'addcoin/add',
    'remove' => 'addcoin/remove',
    'reset' => 'parser/index',

    'test' => 'parser/coinmc',

    'api/coininfo/([0-9]+)' => 'api/coininfo/$1',

     // dashboard controller
    'dashboard' => 'dashboard/index',

    // parser
    'message' => 'parser/message'
);