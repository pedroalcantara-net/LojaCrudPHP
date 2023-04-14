<?php
// Inclui o arquivo com as funções CRUD
require_once 'crud.php';

if (isset($_POST['submitUpdateCarrinho'])) {
	updateCarrinho($_POST['numero'], $_POST['data_criacao']);
  header("Location: carrinho.php");
}

$carrinho = readCarrinho($_GET['numero']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Editar Carrinho <?php echo $carrinho['numero']; ?></title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
	<h1>Editar Carrinho <?php echo $carrinho['numero']; ?></h1>
  <hr/>
    <a href="carrinho.php">Voltar</a>
  <br/>
	<form method="POST">
		<input type="hidden" name="numero" value="<?php echo $carrinho['numero']; ?>">
		<label>Número:</label>
    <span><?php echo $carrinho['numero']; ?></span><br/>
		<label>Data de criação:</label>
		<input type="date" name="data_criacao" value="<?php echo $carrinho['data_criacao']; ?>"><br>
		<button type="submit" name="submitUpdateCarrinho">Atualizar</button>
</form>
</body>
</html>
