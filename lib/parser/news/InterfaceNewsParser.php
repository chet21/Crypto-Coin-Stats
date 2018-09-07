<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.03.2018
 * Time: 15:57
 */

namespace Lib\Parser\News;


interface InterfaceNewsParser
{

    public function __construct($count);

    public function get_link_list();
    public function parse_link_get_data();

}