<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.03.2018
 * Time: 12:21
 */

namespace Lib\Location;


class UserTime
{
    private $server_time;
    private $user_time_zone;

    public function __construct($user_time_zone)
    {
        $this->server_time = time();
        $this->user_time_zone = $user_time_zone;
    }

    public function get()
    {

    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
    }
}