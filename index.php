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

$id_produto = isset($_GET['id_produto'])?$_GET['id_produto']:"";

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/1a56e06420.js" crossorigin="anonymous"></script>
    

    <style>
    
        .product-card {
            width: 100%;
            min-width: 300px; 
            margin: 10px; 
            display: flex;
            flex-direction: column;
            height: 100%; 
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            flex: 1;
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

        .favorite-icon {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .favorite-button {
            width: 30px;
            height: 30px;
            font-size: 18px;
            padding: 0;
        }

        .add-to-cart-button {
            margin-top: 10px;
            
        }

        .btn_visu{
            margin-botom:20px;

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
            echo '<div class="card position-relative">';
            echo '<span class="favorite-icon"><a href="?id_produto=<?= $produto ?>"><button type="button" class="btn btn-outline-danger favorite-button"><i class="fas fa-heart"></i></button></a></span>';
            echo '<img src="' . $produto["foto_produto"] . '" alt="' . $produto["nome_produto"] . '" class="card-img-top">';
            echo '<div class="card-body">';
            echo '<h2 class="card-title">' . $produto["nome_produto"] . '</h2>';
            echo '<p class="card-text">' . $produto["descricao"] . '</p>';
            echo '<form method="post" action="">'; // Formulário para adicionar ao carrinho
            echo '<input type="hidden" name="produto_id" value="' . $produto["id_produto"] . '">';
            echo '<a href="visualizar_produto.php?id_produto=' . $produto["id_produto"] . '" class="btn_visu btn btn-primary">Visualizar Produto</a>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<?php
    $carrinho = new Carrinho($produtos[$id_produto]['nome_produto'], $produtos[$id_produto]['descricao'], $produtos[$id_produto]['preco'], $produtos[$id_produto]['foto_produto'], $id_produto); 
    $carrinho->getCarrinho();
?>

</body>
</html>
</html>
