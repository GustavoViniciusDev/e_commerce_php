<?php
// include('database/conexao.php');

    class Carrinho{
        public $id_produto;
        public $nome_produto;
        public $descricao;
        public $preco;
        public $foto_produto;

        public function __construct($id_produto, $nome_produto, $descricao, $preco, $foto_produto){
            $this->id_produto = $id_produto;
            $this->nome_produto = $nome_produto;
            $this->descricao = $descricao;
            $this->preco = $preco;
            $this->foto_produto = $foto_produto;
        }


        public function getCarrinho()
        {
             $_SESSION['carrinho'][$this->id_produto] = [
                'id_produto' => "{$this->id_produto}",
                'nome_produto' => "{$this->nome_produto}",
                'descricao' => "{$this->descricao}",
                'preco' => "{$this->preco}",
                'foto_produto' => "{$this->foto_produto}"
            ];

            // print_r($_SESSION);

           
            
        }

    
    }


?>