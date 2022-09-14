<?php


namespace App\Models;
use PDOException;


class Customers
{

    protected $db;
    public $catch;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function __destruct() {
        unset($this->db);
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    public function list(){
        $field = $_GET['customer'];
        if($field == 'email'){
            $query = "SELECT (SELECT count(*) FROM customers WHERE email NOT REGEXP '^[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9._-]@[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9].[a-zA-Z]{2,63}$') as invalid, (SELECT count(*) FROM customers WHERE email REGEXP '^[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9._-]@[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9].[a-zA-Z]{2,63}$') as valid ";
        }else{
            $query = "SELECT (SELECT count(*) FROM customers where $field = '') as Isempty, (SELECT count(*) FROM customers where $field <> '') as NotEmpty  FROM customers LIMIT 1 ";
        }
        $result = $this->db->query($query);
        try {
            if($result->fetch()) {
                //echo $query;
                return $this->db->query($query);
            }
        } catch (\PDOException $e) {
            //$this->catch = $e->getMessage();
            $this->catch = "Sorry! Error in 'field list'. ";
        }
    }

}