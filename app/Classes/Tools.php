<?php


namespace App\Classes;


class Tools
{

    /**
     * @param string $time
     * @return false|int
     */
    public static function dateToStrtime(string $time){

        $time = str_replace('Z',"",$time);
        $str_arr = explode('T', $time);
        $time = $str_arr[0]." ".$str_arr[1];
        $time = strtotime($time);

        return date('Y-m-d', $time);

    }

}
