<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.07.2018
 * Time: 19:17
 */

namespace Lib\Parser\News;


use Throwable;

class ExeptionNewsParser extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}