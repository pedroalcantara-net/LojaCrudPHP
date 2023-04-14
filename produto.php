<?php
// Inclui o arquivo com as funções CRUD
require_once 'database.php';
require_once 'crud.php';

// Verifica se o formulário de inserção foi submetido
if (isset($_POST['submitInsertProduto'])) {
	insertProduto($_POST['codigo'], $_POST['descricao'], $_POST['preco']);
}

// Verifica se o formulário de deleção foi submetido
if (isset($_POST['submitDeleteProduto'])) {
deleteProduto($_POST['codigo']);
}

// Busca todos os produtos no banco
$produtos = readProdutos();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Produtos</title>
  <link rel="stylesheet" href="styles.css"/>
</head>
<body>
	<h1>Produtos</h1>
  <hr/>
  <a href="index.php">Voltar</a>
  <br/>
	<table>
		<thead>
			<tr>
				<th>Código</th>
				<th>Descrição</th>
				<th>Preço</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($produtos as $produto): ?>
			<tr>
				<td><?php echo $produto['codigo']; ?></td>
				<td><?php echo $produto['descricao']; ?></td>
				<td><?php echo $produto['preco']; ?></td>
				<td>
					<form method="POST">
						<input type="hidden" name="codigo" value="<?php echo $produto['codigo']; ?>">
						<button type="submit" name="submitDeleteProduto">Deletar</button>
					</form>
					<form method="GET" action="produto_form.php">
						<input type="hidden" name="codigo" value="<?php echo $produto['codigo']; ?>">
						<button type="submit">Editar</button>
					</form>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
  	<h2>Adicionar produto</h2>
  	<form method="POST">
		<label>Código:</label>
		<input type="number" name="codigo"><br>
		<label>Descrição:</label>
		<input type="text" name="descricao"><br>
		<label>Preço:</label>
		<input type="number" name="preco"><br>
		<button type="submit" name="submitInsertProduto">Adicionar</button>
	</form>
</body>
</html>