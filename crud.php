<?php
require_once 'database.php';
// Função para criar um produto
function insertProduto($codigo, $descricao, $preco) {
    global $db;
    $stmt = $db->prepare('INSERT INTO Produto (codigo, descricao, preco) VALUES (:codigo, :descricao, :preco)');
    $stmt->bindValue(':codigo', $codigo, SQLITE3_INTEGER);
    $stmt->bindValue(':descricao', $descricao, SQLITE3_TEXT);
    $stmt->bindValue(':preco', $preco, SQLITE3_FLOAT);
    $stmt->execute();
}

// Função para criar um carrinho
function insertCarrinho($numero, $data_criacao) {
    global $db;
    $stmt = $db->prepare('INSERT INTO Carrinho (numero, data_criacao) VALUES (:numero, :data_criacao)');
    $stmt->bindValue(':numero', $numero, SQLITE3_INTEGER);
    $stmt->bindValue(':data_criacao', $data_criacao, SQLITE3_TEXT);
    $stmt->execute();
}

// Função para adicionar um produto ao carrinho
function insertProdutoCarrinho($codigo_produto, $numero_carrinho, $quantidade) {
    global $db;
    $stmt = $db->prepare('INSERT INTO ProdutoCarrinho (codigo_produto, numero_carrinho, quantidade) VALUES (:codigo_produto, :numero_carrinho, :quantidade)');
    $stmt->bindValue(':codigo_produto', $codigo_produto, SQLITE3_INTEGER);
    $stmt->bindValue(':numero_carrinho', $numero_carrinho, SQLITE3_INTEGER);
    $stmt->bindValue(':quantidade', $quantidade, SQLITE3_INTEGER);
    $stmt->execute();
}

function readProduto($codigo) {
  global $db;
    $stmt = $db->prepare('SELECT * FROM Produto WHERE codigo = :codigo');
    $stmt->bindValue(':codigo',$codigo,SQLITE3_INTEGER);
    $result = $stmt->execute();
    $produtos = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $produtos[] = $row;
    }
    return $produtos[0];
}

function readCarrinho($numero) {
  global $db;
    $stmt = $db->prepare('SELECT * FROM Carrinho WHERE numero = :numero');
    $stmt->bindValue(':numero',$numero,SQLITE3_INTEGER);
    $result = $stmt->execute();
    $carrinhos = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $carrinhos[] = $row;
    }
    return $carrinhos[0];
}

function readProdutoCarrinho($codigo,$numero){
   global $db;
    $stmt = $db->prepare('SELECT * FROM ProdutoCarrinho WHERE numero_carrinho = :numero and codigo_produto = :codigo');
    $stmt->bindValue(':numero',$numero,SQLITE3_INTEGER);
    $stmt->bindValue(':codigo',$codigo,SQLITE3_INTEGER);
    $result = $stmt->execute();
    $produtoCarrinho = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $produtoCarrinho[] = $row;
    }
    return $produtoCarrinho[0]; 
}

// Função para buscar todos os produtos
function readProdutos() {
    global $db;
    $stmt = $db->prepare('SELECT * FROM Produto');
    $result = $stmt->execute();
    $produtos = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $produtos[] = $row;
    }
    return $produtos;
}

// Função para buscar todos os carrinho

function readCarrinhos() {
global $db;
$stmt = $db->prepare('SELECT * FROM Carrinho');
$result = $stmt->execute();
$carrinhos = array();
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
$carrinhos[] = $row;
}
return $carrinhos;
}

// Função para buscar todos os produtos de um carrinho
function readProdutosCarrinho($numero_carrinho) {
global $db;
$stmt = $db->prepare('SELECT p.codigo, p.descricao, p.preco, pc.quantidade FROM ProdutoCarrinho pc INNER JOIN Produto p ON pc.codigo_produto = p.codigo WHERE pc.numero_carrinho = :numero_carrinho');
$stmt->bindValue(':numero_carrinho', $numero_carrinho, SQLITE3_INTEGER);
$result = $stmt->execute();
$produtos = array();
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
$produtos[] = $row;
}
return $produtos;
}

// Função para atualizar um produto
function updateProduto($codigo, $descricao, $preco) {
global $db;
$stmt = $db->prepare('UPDATE Produto SET descricao = :descricao, preco = :preco WHERE codigo = :codigo');
$stmt->bindValue(':codigo', $codigo, SQLITE3_INTEGER);
$stmt->bindValue(':descricao', $descricao, SQLITE3_TEXT);
$stmt->bindValue(':preco', $preco, SQLITE3_FLOAT);
$stmt->execute();
}

// Função para atualizar um carrinho
function updateCarrinho($numero, $data_criacao) {
global $db;
$stmt = $db->prepare('UPDATE Carrinho SET data_criacao = :data_criacao WHERE numero = :numero');
$stmt->bindValue(':numero', $numero, SQLITE3_INTEGER);
$stmt->bindValue(':data_criacao', $data_criacao, SQLITE3_TEXT);
$stmt->execute();
}

// Função para atualizar a quantidade de um produto em um carrinho
function updateQuantidadeProdutoCarrinho($codigo_produto, $numero_carrinho, $quantidade) {
global $db;
$stmt = $db->prepare('UPDATE ProdutoCarrinho SET quantidade = :quantidade WHERE codigo_produto = :codigo_produto AND numero_carrinho = :numero_carrinho');
$stmt->bindValue(':codigo_produto', $codigo_produto, SQLITE3_INTEGER);
$stmt->bindValue(':numero_carrinho', $numero_carrinho, SQLITE3_INTEGER);
$stmt->bindValue(':quantidade', $quantidade, SQLITE3_INTEGER);
$stmt->execute();
}

// Função para deletar um produto
function deleteProduto($codigo) {
global $db;
$stmt = $db->prepare('DELETE FROM Produto WHERE codigo = :codigo');
$stmt->bindValue(':codigo', $codigo, SQLITE3_INTEGER);
$stmt->execute();
}

// Função para deletar um carrinho
function deleteCarrinho($numero) {
global $db;
$stmt = $db->prepare('DELETE FROM Carrinho WHERE numero = :numero');
$stmt->bindValue(':numero', $numero, SQLITE3_INTEGER);
$stmt->execute();
}

// Função para deletar um produto de um carrinho
function deleteProdutoCarrinho($codigo_produto, $numero_carrinho) {
global $db;
$stmt = $db->prepare('DELETE FROM ProdutoCarrinho WHERE codigo_produto = :codigo_produto AND numero_carrinho = :numero_carrinho');
$stmt->bindValue(':codigo_produto', $codigo_produto, SQLITE3_INTEGER);
$stmt->bindValue(':numero_carrinho', $numero_carrinho, SQLITE3_INTEGER);
$stmt->execute();
}

