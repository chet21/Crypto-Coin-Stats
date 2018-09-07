<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.02.2018
 * Time: 21:26
 */

namespace Helper;


class TranslateMonth
{
    static function trans($str)
    {
        $list = array('Cічень' => 'Jan',
                      'Лютий' => 'Feb',
                      'Березень' => 'Mar',
                      'Квітень' => 'Apr',
                      'Травень' => 'May',
                      'Червень' => 'June',
                      'Липень' => 'July',
                      'Серпень' => 'Aug',
                      'Вересень' => 'Sept',
                      'Жовтень' => 'Oct',
                      'Листопад' => 'Nov',
                      'Грудень' => 'Dec');

        if(!is_string($str)){
            throw new \Exception("Доступна только строка");
        }

        foreach ($list as $k => $v){
            if($str == $v){
                return $k;
            }
        }

    }
}