<?php 

require_once 'crud.php';

if (isset($_POST['submitUpdateProduto'])) {
updateProduto($_POST['codigo'], $_POST['descricao'], $_POST['preco']);
header("Location: produto.php");
}

$produto = readProduto($_GET['codigo']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Editar Produto <?php echo $produto['codigo']?></title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
  <h1>Editar Produto <?php echo $produto['codigo']?></h1>
  <hr/>
  <a href="produto.php">Voltar</a>
  <br/>
	<form method="POST">
		<label>Código:</label>
    <span><?php echo $produto['codigo']?></span>
		<input type="hidden" name="codigo" value="<?php echo $produto['codigo']?>"><br>
		<label>Descrição:</label>
		<input type="text" name="descricao" value="<?php echo $produto['descricao']?>"><br>
		<label>Preço:</label>
		<input type="text" name="preco" value="<?php echo $produto['preco']?>"><br>
		<button type="submit" name="submitUpdateProduto">Atualizar</button>
	</form>
</body>
</html>