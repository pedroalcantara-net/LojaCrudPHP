<?php
$db = new SQLite3('database.db');

// Tabela Produto
$db->exec('CREATE TABLE IF NOT EXISTS Produto (
    codigo INTEGER PRIMARY KEY,
    descricao TEXT,
    preco REAL
)');

// Tabela Carrinho
$db->exec('CREATE TABLE IF NOT EXISTS Carrinho (
    numero INTEGER PRIMARY KEY,
    data_criacao TEXT
)');

// Tabela ProdutoCarrinho (intermediária)
$db->exec('CREATE TABLE IF NOT EXISTS ProdutoCarrinho (
    codigo_produto INTEGER,
    numero_carrinho INTEGER,
    quantidade INTEGER,
    PRIMARY KEY (codigo_produto, numero_carrinho),
    FOREIGN KEY (codigo_produto) REFERENCES Produto (codigo),
    FOREIGN KEY (numero_carrinho) REFERENCES Carrinho (numero)
)');
?>