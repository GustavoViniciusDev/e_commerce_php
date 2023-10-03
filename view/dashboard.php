<?php
session_start();

if(!isset($_SESSION['nome'])){
    header("Location: ../index.php");
    exit();
}

$login = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Painel de controle</h1>
    <p>Seja bem vindo <?php echo $login; ?> </p>

    <a href="components/logout.php">Sair</a>

    


    

</body>
</html>