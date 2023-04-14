<?php
// Inclui o arquivo com as funções CRUD
require_once 'crud.php';

if (isset($_POST['submitUpdateCarrinho'])) {
	updateCarrinho($_POST['numero'], $_POST['data_criacao']);
  header("Location: carrinho.php");
}

if (isset($_POST['submitProdutoCarrinho'])) {
  $produtosAdicionados = readProdutosCarrinho($_POST['numero']);
  if(in_array($_POST['codigo'], array_column($produtosAdicionados, 'codigo')))
  {
    $quantidadeAnterior = $produtosAdicionados[array_search($_POST['codigo'], array_column($produtosAdicionados, 'codigo'))]['quantidade'];
    if($_POST['quantidade'] < 0 && ($_POST['quantidade'] * -1 > $quantidadeAnterior))
    {
       echo "<h4>Quantidade a ser removida não pode ser maior que a quantidade atual</h4>";     
    }
    else
    {
     $quantidadeNova = $_POST['quantidade'] + $quantidadeAnterior;
    updateQuantidadeProdutoCarrinho($_POST['codigo'],$_POST['numero'], $quantidadeNova);     
    }
  }
  else
  {
    if($_POST['quantidade'] < 0) 
    {
      echo "<h4>Quantidade precisa ser positiva</h4>";
    }
    else
    {
  	  insertProdutoCarrinho($_POST['codigo'],$_POST['numero'], $_POST['quantidade']);        
    }
  }
}

if (isset($_POST['submitDeleteProdutoCarrinho'])) {
	deleteProdutoCarrinho($_POST['codigo'],$_POST['numero']);
}

$carrinho = readCarrinho($_GET['numero']);
$produtos = readProdutosCarrinho($_GET['numero']);
$todosProds = readProdutos();
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
  <h2>Produtos no Carrinho</h2>
  <table>
		<thead>
			<tr>
				<th>Descrição</th>
				<th>Quantidade</th>
        <th>Preço Unitário (R$)</th>
        <th>Preço Total (R$)</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($produtos as $produto): ?>
			<tr>
				<td><?php echo $produto['descricao']; ?></td>
 				<td><?php echo $produto['quantidade']; ?></td>       
				<td><?php echo $produto['preco']; ?></td>
  			<td><?php echo ($produto['preco'] * $produto['quantidade']); ?></td>
				<td>
					<form method="POST">
						<input type="hidden" name="codigo" value="<?php echo $produto['codigo']; ?>">
            <input type="hidden" name="numero" value="<?php echo $carrinho['numero']; ?>">
						<button type="submit" name="submitDeleteProdutoCarrinho">Deletar</button>
					</form>
          <form method="GET" action="produto_carrinho_form.php">
						<input type="hidden" name="codigo" value="<?php echo $produto['codigo']; ?>">
            <input type="hidden" name="numero" value="<?php echo $carrinho['numero']; ?>">
						<button type="submit">Editar</button>
					</form>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
  <form method="POST">
    <input type="hidden" name="numero" value="<?php echo $carrinho['numero']; ?>">
    <label>Produto:</label>
	  <select name="codigo">
      <?php foreach ($todosProds as $produto): ?>
        <option value="<?php echo $produto['codigo']; ?>"><?php echo $produto['descricao']; ?> - R$ <?php echo $produto['preco']; ?></option>
  		<?php endforeach; ?>
    </select><br/>
    <label>Quantidade:</label>
    <input type="number" name="quantidade"/><br/>
    <button type="submit" name="submitProdutoCarrinho">Adicionar</input>
  </form>
</body>
</html>
