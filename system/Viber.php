<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.08.2018
 * Time: 11:07
 */

namespace System;


class Viber
{
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }
    public function sendMessage($contacts)
    {
        Log::write('Contact list in null!!');
        if(empty($contacts)){
            throw \Exception('Contact list in null!!');
        }
    }

}