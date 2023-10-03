<?php
include('database/conexao.php');

$db = new Conexao();

class CrudProduto{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create($postValue){
        $nome_produto = $postValue['nome_produto'];
        $tipo = $postValue['tipo'];
        $qtda_produtos = $postValue['qtda_produto'];
        $descricao = $postValue['descricao'];
        

        $query = "INSERT INTO produtos (nome_produto, tipo, qtda_produto,descricao) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$nome_produto);
        $stmt->bindParam(2,$tipo);
        $stmt->bindParam(3,$qtda_produtos);
        $stmt->bindParam(4,$descricao);


        $rows = $this->read();
        if($stmt->execute()){
            print "<script> alert('Cadastro realizado com sucesso!!! ')</script>";
            print"<script>  location.href='?action=read';</script>";
            return true;
        }else{
            return false;
        }

    }


    public function read(){
        $query = "SELECT * FROM produtos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }



    public function update($postValues)
    {
        $id_produto = $postValues['id_produto'];
        $nome_produto = $postValues['nome_produto'];
        $tipo = $postValues['tipo'];
        $qtda_produtos = $postValues['qtda_produto'];
        $descricao = $postValues['descricao'];
        


        if (empty($id_produto) || empty($nome_produto) || empty($tipo) || empty($qtda_produtos) || empty($descricao)) {
            return false;
        }
        

        $query = "UPDATE produtos SET nome_produto = ?, tipo = ?, qtda_produto = ?, descricao = ? WHERE id_produto = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $nome_produto);
        $stmt->bindValue(2, $tipo);
        $stmt->bindValue(3, $qtda_produtos);
        $stmt->bindValue(4, $descricao);
        $stmt->bindValue(5, $id_produto);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function readOne($id_produto) {
        $query = "SELECT * FROM produtos WHERE id_produto = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id_produto);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function delete($id_produto){
        $query = "DELETE FROM produtos WHERE id_produto = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$id_produto);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}


?>