<?php
require_once('class/Usuario.php');
require_once('database/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$classUsuario = new Usuario($db);


if(isset($_POST['cadastrar'])){
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];

    if($classUsuario->cadastrar($usuario, $email, $senha, $confSenha)){
        print "<script> alert('Cadastro efetuado com sucesso!')</script>";
    }else{
        print "<script> alert('Erro ao Cadastrar')</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
</head>
<body>


<form action="" method="POST">
    <label for="Usuario">Nome de Usuario</label>
    <input type="text" name="usuario" required>
    <label for="Email">E-mail</label>
    <input type="email" name="email">
    <label for="Senha">Senha</label>
    <input type="password" name="senha" required>
    <label for="ConfSenha">Confirmar Senha</label>
    <input type="password" name="confSenha" required>
    <input type="submit" value="Criar Conta" name="cadastrar">
</form>
    <a href="index.php">Voltar para tela inicial</a>
</body>
</html>