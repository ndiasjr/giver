<?php
/**
 * Created by PhpStorm.
 * User: SAEE6
 * Date: 09/05/2018
 * Time: 17:07
 */
namespace SON\Controller;

abstract class Action
{
    protected $view;
    private $action;

    public function __construct()
    {
        $this->view = new \stdClass();
    }

    protected function render($action)
    {
        $this->action = $action;
        $current = get_class($this);
        $singleClassName = strtolower((str_replace("Controller","",str_replace("App\\Controllers\\","",$current))));
        include_once "App/Views/".$singleClassName."/".$this->action.".phtml";
    }

}