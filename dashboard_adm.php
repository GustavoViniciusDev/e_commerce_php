<?php
session_start();

if(!isset($_SESSION['nome'])){
    header("Location: ../index.php");
    exit();
}

$login = $_SESSION['nome'];



require_once ('class/Crud.php');
require_once ('database/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$crud = new CrudProduto($db);

//solicitacoes do usuario
if(isset($_GET['action'])){
	switch($_GET['action']){
		case 'create':
			$crud->create($_POST);
			$rows = $crud->read(); // atualiza a variável $rows após a criação de um novo registro
			break;
		case 'read':
			$rows = $crud->read();
			break;
		case 'update':
			if(isset($_POST['id_produto'])){
				$crud->update($_POST);
			}
			$rows = $crud->read();
			break;
		case 'delete':
			$crud->delete($_GET['id_produto']);
			$rows = $crud->read();
			break;
		default:
			$rows = $crud->read();
			break;
	}
}else{
	$rows = $crud->read();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

	<style>
		form {
			max-width: 500px;
			margin: 0 auto;
		}
		label {
			display: block;
			margin-top: 10px;
		}
		input[type=text], select {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
        input[type=number], select {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input[type=file], select {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input[type=submit] {
			background-color: #4CAF50;
			color: white;
			padding: 12px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			float: right;
		}

		
		input[type=submit]:hover {
			background-color: #45a049;
		}
		table {
		border-collapse: collapse;
		width: 100%;
		font-family: Arial, sans-serif;
		font-size: 14px;
		color: #333;
		}

		th, td {
		text-align: left;
		padding: 8px;
		border: 1px solid #ddd;
		}

		th {
		background-color: #f2f2f2;
		font-weight: bold;
		}

		tr:nth-child(even) {
		background-color: #f9f9f9;
		}

		a {
		display: inline-block;
		padding: 4px 8px;
		background-color: #007bff;
		color: #fff;
		text-decoration: none;
		border-radius: 4px;
		}

		a:hover {
		background-color: #0069d9;
		}

		a.delete {
		background-color: #dc3545;
		}

		a.delete:hover {
		background-color: #c82333;
		}
	</style>
</head>
<body>
    <h1>Painel de controle do ADM</h1>
    <p>Seja bem vindo <?php echo $login; ?> </p>



    <a href="view/components/logout.php">Sair</a>

    

	<?php
			 if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id_produto'])){
				$id_produto  = $_GET['id_produto'];
				$result = $crud->readOne($id_produto);

				if(!$result){
					echo"Registro não encontrado.";
					exit();
				}
				 $nome_produto = $result['nome_produto'];
				 $tipo = $result['tipo'];
				 $qtda_produto = $result['qtda_produto'];
				 $descricao = $result['descricao'];
				 
			 

		?>

			
    
	<form method="POST" action="?action=update" enctype="multipart/form-data">
	<input type="hidden"  value="<?php echo $id_produto ?>">
		<label for="Nome do Produto">Nome do Produto:</label>
		<input type="text" name="nome_produto" required  value="<?php echo $nome_produto ?>">

		<label for="Tipo">Tipo:</label>
		<select name="tipo">
            <option value="Periferico">Periférico</option>
            <option value="Hardware">Hardware</option>
            <option value="Software">Software</option>
        </select>

		<label for="Quantidade do Produto">Quantidade do Produto:</label>
		<input type="number" name="qtda_produto" required value="<?php echo $qtda_produto ?>">

		<label for="Descricao do Produto">Descrição</label>
		<input type="text"  name="descricao" required value="<?php echo $descricao ?>">

        <label for="Foto do Produto">Foto do Produto</label>
        <input type="file" name="file">

		<input type="submit" value="Atualizar" name="enviar">
	</form>



		<?php
			 }else{

		?>
    
	<form method="POST" action="?action=create" enctype="multipart/form-data">
		<label for="Nome do Produto">Nome do Produto:</label>
		<input type="text" name="nome_produto" required>

		<label for="Tipo">Tipo:</label>
		<select name="tipo">
            <option value="Periferico" >Periférico</option>
            <option value="Hardware">Hardware</option>
            <option value="Software">Software</option>
        </select>

		<label for="Quantidade do Produto">Quantidade do Produto:</label>
		<input type="number" name="qtda_produto" required>

		<label for="Descricao do Produto">Descrição</label>
		<input type="text"  name="descricao" required>

        <label for="Foto do Produto">Foto do Produto</label>
        <input type="file" name="file">

		<input type="submit" value="Cadastrar" name="enviar">
	</form>
	<?php
			 }
	?>


	<table>
		<tr>
			<th>Id</th>
			<th>Nome do Produto</th>
			<th>Tipo</th>
			<th>Qtda de Produtos</th>
			<th>Descrição</th>
			<th>Ações</th>
		</tr>
		
		<?php

	if (isset($rows)) {
		foreach($rows as $row){
			echo "<tr>";
			echo "<td>".$row['id_produto']."</td>";
			echo "<td>".$row['nome_produto']."</td>";
			echo "<td>".$row['tipo']."</td>";
			echo "<td>".$row['qtda_produto']."</td>";
			echo "<td>".$row['descricao']."</td>";	
			echo "<td>";
			echo "<a href='?action=update&id_produto=".$row['id_produto']."'>Editar</a>";
			echo "<a href='?action=delete&id_produto=".$row['id_produto']."' onclick='return confirm(\"Tem certeza que deseja deletar esse registro?\")' class='delete'>Excluir</a>";
			echo "</td>";
			echo "</tr>";

		}
	}else{
		echo "Não há registros a serem exibidos.";
	}
		?>
	</table>
    

</body>
</html>