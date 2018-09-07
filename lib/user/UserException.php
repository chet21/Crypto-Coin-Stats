<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.02.2018
 * Time: 19:21
 */

namespace lib;


use Throwable;

class UserException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
