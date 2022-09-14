<?php
/**
 * Created by PhpStorm.
 * User: SAEE6
 * Date: 09/05/2018
 * Time: 16:44
 */

namespace SON\Init;

use SON\Controller\Action;

abstract class Bootstrap
{

    public function __construct(){
        $this->initRoutes();
        $this->rum($this->getUrl());
    }
    private $routes;

    abstract protected function initRoutes();

    protected function rum($url){
        array_walk($this->routes,function ($route) use($url) {
            if($url == $route['route']){
                $class = "App\\Controllers\\".ucfirst($route['controller']);
                $controller = new $class;
                $action = $route['action'];
                $controller->$action();
            }
        });
    }

    protected function setRoutes(array $routes){
        $this->routes = $routes;
    }

    protected function getUrl(){
        return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    }

}