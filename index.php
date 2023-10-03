<?php
session_start();

require_once('class/Usuario.php');
require_once('database/conexao.php');

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

?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <style>
    
        .product-card {
            width: 100%;
            max-width: 300px; /* Defina a largura máxima do card */
            margin: 10px; /* Adiciona margem ao redor do card */
            display: flex;
            flex-direction: column;
            height: 100%; /* Define altura igual para todos os cards */
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            flex: 1; /* Permite que a imagem cresça e ocupe todo o espaço disponível verticalmente */
        }

        .product-card .card-body {
            padding: 10px;
            text-align: center;
        }

        .product-card h2 {
            font-size: 18px;
            margin-top: 10px;
        }

        .product-card p {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
<?php include_once('view/header_main.php'); ?>
    
<div class="container">
    <div class="row">
        <?php
        foreach ($produtos as $produto) {
            echo '<div class="col-md-3 product-card">';
            echo '<div class="card">';
            echo '<img src="' . $produto["foto_produto"] . '" alt="' . $produto["nome_produto"] . '" class="card-img-top">';
            echo '<div class="card-body">';
            echo '<h2 class="card-title">' . $produto["nome_produto"] . '</h2>';
            echo '<p class="card-text">' . $produto["descricao"] . '</p>';
            echo '<a href="visualizar_produto.php?id_produto=' . $produto["id_produto"] . '" class="btn btn-primary">Visualizar Produto</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>


        

</body>
</html>
</html>
