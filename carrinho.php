<?php
// Inclui o arquivo com as funções CRUD
require_once 'crud.php';

// Verifica se o formulário de inserção foi submetido
if (isset($_POST['submitInsertCarrinho'])) {
	insertCarrinho($_POST['numero'], $_POST['data_criacao']);
}

// Verifica se o formulário de atualização foi submetido
if (isset($_POST['submitUpdateCarrinho'])) {
	updateCarrinho($_POST['numero'], $_POST['data_criacao']);
}

// Verifica se o formulário de deleção foi submetido
if (isset($_POST['submitDeleteCarrinho'])) {
	deleteCarrinho($_POST['numero']);
}

// Busca todos os carrinhos no banco
$carrinhos = readCarrinhos();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Carrinhos</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
	<h1>Carrinhos</h1>
  <hr/>
  <a href="index.php">Voltar</a>
  <br/>
	<table>
		<thead>
			<tr>
				<th>Número</th>
				<th>Data de criação</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($carrinhos as $carrinho): ?>
			<tr>
				<td><?php echo $carrinho['numero']; ?></td>
				<td><?php echo $carrinho['data_criacao']; ?></td>
				<td>
					<form method="POST">
						<input type="hidden" name="numero" value="<?php echo $carrinho['numero']; ?>">
						<button type="submit" name="submitDeleteCarrinho">Deletar</button>
					</form>
					<form method="GET" action="carrinho_form.php">
						<input type="hidden" name="numero" value="<?php echo $carrinho['numero']; ?>">
						<button type="submit">Editar</button>
					</form>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<h2>Adicionar carrinho</h2>
	<form method="POST">
		<label>Número:</label>
		<input type="text" name="numero"><br>
		<label>Data de criação:</label>
		<input type="date" name="data_criacao"><br>
		<button type="submit" name="submitInsertCarrinho">Adicionar</button>
	</form>
</body>
</html>