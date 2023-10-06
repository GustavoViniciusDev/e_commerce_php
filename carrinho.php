<?php
session_start();

require_once('class/Usuario.php');
require_once('database/conexao.php');
require_once('class/Carrinho.php');

$database = new Conexao();
$db = $database->getConnection();
$classUsuario = new Usuario($db);

$produtos = [];

$query = "SELECT * FROM produtos ";
$result = $db->query($query);

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $produtos[] = $row;
    }
}

$id_produto = isset($_GET['id_produto']) ? $_GET['id_produto'] : "";


?>


<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1a56e06420.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .product-card {
            width: 100%;
            display: flex;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
        }

        .product-card img {
            max-width: 100px;
            height: auto;
            margin-right: 10px;
        }

        .product-details {
            flex: 1;
        }

        .product-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 16px;
            font-weight: bold;
        }

        .remove-button {
            font-size: 14px;
            color: red;
            cursor: pointer;
        }

        .empty-cart-message {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include_once('view/header_main.php'); ?>

    <div class="container">
        <h1>Seu Carrinho</h1>

        <?php
        $carrinho = new Carrinho(
            $id_produto,
            $produtos[$id_produto]['nome_produto'],
            $produtos[$id_produto]['descricao'],
            $produtos[$id_produto]['preco'],
            $produtos[$id_produto]['foto_produto']
        );

        $carrinho->getCarrinho();

        if (!empty($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $produto => $value) {
                ?>
                <div class="product-card">
                    <img src="<?= $value['foto_produto'] ?>" alt="Imagem do Produto">
                    <div class="product-details">
                        <div class="product-title"><?= $value['nome_produto'] ?></div>
                        <div class="product-description"><?= $value['descricao'] ?></div>
                        <div class="product-price">Preço: R$ <?php $value['preco'] ?></div>
                        <div class="remove-button" data-id="<?= $produto ?>">Remover</div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="empty-cart-message">Seu carrinho está vazio.</div>';
        }
        
        ?>


    </div>

    <script>
        $(document).ready(function () {
            $(".remove-button").click(function () {
                var idProduto = $(this).data("id");

                $.ajax({
                    url: "excluir_produto.php",
                    type: "POST",
                    data: { id_produto: idProduto },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    },
                });
            });
        });
    </script>
</body>
</html>
