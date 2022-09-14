<?php


namespace App\Models;


abstract class Includes
{

    static function system($inc){
        include_once "inc/system/".$inc.".phtml";
    }

}