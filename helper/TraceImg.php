<?php

namespace Helper;


class TraceImg
{

    static public function get($img)
    {
        $res = [];
        for ($i=0; $i<=count($img['name'])-1; $i++){
            $p = [$i];
            foreach ($img as $keys => $items) {
                $p[$keys] = $items[$i];
            }
            $res[] = $p;
        }
        return $res;
    }

}