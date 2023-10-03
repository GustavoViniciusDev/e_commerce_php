<?php
include('database/conexao.php');

$db = new Conexao();

class Usuario{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function cadastrar($usuario, $email, $senha, $confSenha){
        
        if($senha === $confSenha){

            $verificarExistente = $this->verificarExistente($usuario,$email);
            if($verificarExistente){
                print "<script>alert('Email ou Nome de usuario ja cadastrado!')</script>";
                return false;
            }


            $senhaCrip = password_hash($senha, PASSWORD_DEFAULT);

            $query = "INSERT  usuarios (nome,email,senha) VALUES (?,?,?)";

            $stmt= $this->conn->prepare($query);
            $stmt->bindValue(1, $usuario);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $senhaCrip);
            $result = $stmt->execute();

            return $result;
            
        }

    }

    public function verificarExistente($usuario, $email){
        $query = "SELECT COUNT(*) FROM usuarios WHERE nome = ? and email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1,$usuario);
        $stmt->bindValue(2,$email);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }


    public function logar($login, $senha){
        $query = "SELECT * FROM usuarios WHERE email = :email OR nome = :nome ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $login);
        $stmt->bindValue(':nome', $login);
        $stmt->execute();

        if($stmt->rowCount() == 1){
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($senha, $usuario['senha'])){
                return true;
            }
        }

        return false;
    }


    public function verificarAdm($login){
        $query = "SELECT adm FROM usuarios WHERE  email = :email OR nome = :nome ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $login);
        $stmt->bindValue(':nome', $login);
        $stmt->execute();

        if($stmt->rowCount() == 1){
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario['adm'] == 1;
        }

        return false;

    }
}



?>