<?php
/**
 * Created by PhpStorm.
 * User: SAEE6
 * Date: 08/05/2018
 * Time: 17:25
 */

namespace App;

use SON\Init\Bootstrap;

class Init extends Bootstrap
{

    protected function initRoutes(){

        /*Inicio System*/
        $ar['default'] = array('route' => '/', 'controller' => 'system', 'action' => 'upload');
        $ar['upload'] = array('route' => '/upload', 'controller' => 'system', 'action' => 'upload');
        $ar['customers'] = array('route' => '/customers', 'controller' => 'system', 'action' => 'customers');
        $ar['list'] = array('route' => '/list', 'controller' => 'system', 'action' => 'list');
        /*Fim System*/

        $this->setRoutes($ar);
    }

    public static function getDb(){
        //setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        setlocale(LC_ALL, 'pt_BR');
        date_default_timezone_set("America/Sao_Paulo");
        set_time_limit(90);
        $host = 'localhost';
        $dbname = 'saee_giver';
        $username = 'saee_giver';
        $passwd = 'giver_customers';

        try {
            $db = null;
            $db = new \PDO(
                'mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $username, $passwd,
                array(
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                )
            );

            return $db;

        } catch (PDOException $e) {
            echo "Erro de Conexão " . $e->getMessage() . "\n";
            exit;
        }

    }
}