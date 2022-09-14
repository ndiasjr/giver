<?php

namespace App\Models;

class Table extends \PDOException
{
    protected $db;
    public $catch;
    public $success;
    public $error;

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

    public function insert($query){
        $stmt = $this->db->prepare($query);
        try {
            if($stmt->execute()){
                $this->success = $this->success. "Upload do arquivo realizado com sucesso<br>";
            }else{
                $this->error = 'Error in exec into';
            }
        } catch (\PDOException $e) {
            $this->catch = $e->getMessage();
        }
    }
}