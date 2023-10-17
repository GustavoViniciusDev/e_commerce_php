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


// class Conexao{
//     private $host = "CCH06LABM34\SQLEXPRESS"; // Nome do servidor SQL Server
//     private $database = "e_commerce"; // Nome do banco de dados no SQL Server
//     public $conn;

//     public function getConnection(){
//         $this->conn = null;
//         try{
//             // Usando a conexão PDO para SQL Server com autenticação do Windows
//             $this->conn = new PDO("sqlsrv:Server=$this->host;Database=$this->database;Integrated Security=SSPI");

//             // Configurando o modo de erro
//             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         }catch(PDOException $e){
//             echo "Erro na conexão: ". $e->getMessage();
//         }

//         return $this->conn;
//     }
// }

?>