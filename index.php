<?php
session_start();

require_once('class/Usuario.php');
require_once('database/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$classUsuario = new Usuario($db);

if(isset($_POST['logar'])){
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    

    if($classUsuario->logar($login, $senha)){
        if($classUsuario->verificarAdm($login)){
            $_SESSION['nome'] = $login;
            $_SESSION['adm'] = true; 
            header("Location: dashboard_adm.php");
            exit();
        }else{
            $_SESSION['nome'] = $login;
            header("Location: view/dashboard.php");
            exit();
        }
       
    }else{
        echo "<script>alert('Login inválido')</script>";
    }

}

?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>


<form action="" method="POST">
    <label for="Usuario">Nome de Usuario ou E-mail</label>
    <input type="text" name="login" required>
    <label for="Senha">Senha</label>
    <input type="password" name="senha" required>
    <input type="submit" value="Logar" name="logar">
</form>
    <a href="cadastro.php">Criar uma conta</a>
</body>
</html>