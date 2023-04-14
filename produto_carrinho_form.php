<?php 

require_once 'crud.php';

if (isset($_POST['submitUpdateProdutoCarrinho'])) {
  if($_POST['quantidade'] < 0)
  {
    echo "<h4>Quantidade precisa ser positiva</h4>";
  }
else
{
updateQuantidadeProdutoCarrinho($_POST['codigo'], $_POST['numero'], $_POST['quantidade']);
header("Location: carrinho_form.php?numero=" . $_POST['numero'] . "");  
}
}

$produto = readProduto($_GET['codigo']);
$carrinho = readCarrinho($_GET['numero']);
$produtoCarrinho = readProdutoCarrinho($_GET['codigo'],$_GET['numero']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Editar Produto <?php echo $produto['codigo']?> no Carrinho <?php echo $carrinho['numero']?></title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
  <h1>Editar Produto <?php echo $produto['codigo']?> no Carrinho <?php echo $carrinho['numero']?></h1>
  <hr/>
  <a href="<?php echo "carrinho_form.php?numero=" . $_GET['numero'] . "";?>">Voltar</a>
  <br/>
	<form method="POST">
		<label>Produto:</label>
    <span><?php echo $produto['codigo']?> - <?php echo $produto['descricao']?></span>
		<input type="hidden" name="codigo" value="<?php echo $produto['codigo']?>"><br>
		<label>Carrinho:</label>
    <span><?php echo $carrinho['numero']?></span>
		<input type="hidden" name="numero" value="<?php echo $carrinho['numero']?>"><br>		
    <label>Quantidade:</label>
		<input type="number" min="0" name="quantidade" value="<?php echo $produtoCarrinho['quantidade']?>"><br>
    <label>Preço Unitário:</label>
    <span>R$ <?php echo $produto['preco']?></span><br/>
    <label>Preço Total:</label>
    <span>R$ <?php echo $produto['preco'] * 1?></span><br/>
		<button type="submit" name="submitUpdateProdutoCarrinho">Atualizar</button>
	</form>
</body>
</html>