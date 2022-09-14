<?php
/**
 * Created by PhpStorm.
 * User: SAEE6
 * Date: 10/05/2018
 * Time: 10:12
 */

namespace SON\DI;

class Container
{

    public static function getClass($name){
        $str_class = "\\App\\Models\\".ucfirst($name);
        $class = new $str_class(\App\Init::getDb());
        return $class;
    }

}