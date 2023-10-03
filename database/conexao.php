<?php

class Conexao{
    private $host = "localhost";
    private $database = "e_commerce";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=". $this->host. ";dbname=". $this->database, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOSException $e){
            echo "Erro na conexão: ". $e->getMessage();
        }

        return $this->conn;
    }

}

?>