<?php 

namespace Libs\Database;

use PDO;
use PDOException;

class MySQL {
    private $db;
    private $dbhost;
    private $dbname;
    private $dbuser;
    private $dbpassword;

    public function __construct(
        $dbhost = "localhost",
        $dbname = "mpify",
        $dbuser = "root",
        $dbpassword = ""
    )
    {
        $this->dbhost = $dbhost;
        $this->dbname = $dbname;
        $this->dbuser = $dbuser;
        $this->dbpassword = $dbpassword;
    }

    public function connect(){
       try {
            $this->db = new PDO(
                "mysql:dbhost=$this->dbhost;dbname=$this->dbname",
                $this->dbuser,
                $this->dbpassword,
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
            return $this->db;
       } catch (PDOException $err) {
           echo $err->getMessage();
            exit();
       }
    }
}