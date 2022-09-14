<?php


namespace App\Models;
use PDOException;

class ListPage extends Pagination
{

    protected $db;
    public $limit;
    public $page;
    public $catch;
    public $qtdReg;

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

    public function fecthAll(){
        $this->limit = 7;
        if (isset($_GET["page"]) && !empty($_GET["page"])) {
            $this->page  = $_GET["page"];
        } else {
            $this->page=1;
        };
        $query = 'SELECT * FROM customers ';
        $result = $this->db->query($query);
        $this->qtdReg = $result->rowCount();
        $query .= "LIMIT ".(($this->page - 1) * $this->limit).",$this->limit ";
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