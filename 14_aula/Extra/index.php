<?php
require_once 'Produto.php';
require_once 'ProdutoDAO.php';

$dao = new ProdutoDAO();

// CREATE - 8 produtos
$dao->criarProduto(new Produto(101, "Tomate", 5.50));
$dao->criarProduto(new Produto(102, "Maça", 4.20));
$dao->criarProduto(new Produto(103, "Queijo Bire", 15.75));
$dao->criarProduto(new Produto(104, "Iogurte Grego", 8.30));
$dao->criarProduto(new Produto(105, "Guarana Jesus", 6.50));
$dao->criarProduto(new Produto(106, "Bolacha Bono", 3.80));
$dao->criarProduto(new Produto(107, "Desinfetante Urca", 12.00));
$dao->criarProduto(new Produto(108, "Prestobarba Bic", 9.90));

// READ - mostrar lista inicial
echo "Lista inicial de produtos:\n";
foreach ($dao->lerProdutos() as $produto) {
    echo "{$produto->getCodigo()} - {$produto->getNome()} - R$ {$produto->getPreco()}\n";
}

// UPDATE - modificar Desinfetante e pelo menos 2 preços
$dao->atualizarProduto(107, "Desinfetante Barbarex", 13.50);
$dao->atualizarProduto(103, null, 16.00);
$dao->atualizarProduto(104, null, 9.00);

// DELETE - remover Maça e Tomate
$dao->excluirProduto(101);
$dao->excluirProduto(102);

// READ - mostrar lista final
echo "\nLista final de produtos:\n";
foreach ($dao->lerProdutos() as $produto) {
    echo "{$produto->getCodigo()} - {$produto->getNome()} - R$ {$produto->getPreco()}\n";
}
?>
