<?php

$smarty = new Template();
//echo '<pre>';
//ATUALIZANDO SALDO FASTCOMMERCE
$getBD = new Produto();
$sendForAPI = new ProdutoManager();

//ATUALIZACAO DE PRODUTOS
$listUpdate = $getBD->getProdutosUpdateLoja();
$sendForAPI->atualizacaoDeProdutos($listUpdate, "dados"); //Tipos de atualizacões "saldo", "preco" ou "dados"

//ATUALIZACAO DE ESTOQUE
$listUpdateEstoque = $getBD->getProdutosUpdateSaldo();
$sendForAPI->atualizacaoDeProdutos($listUpdateEstoque, "saldo"); //Tipos de atualizacões "saldo", "preco" ou "dados"


//ATUALIZACAO DE PRECOS
$listUpdatePreco = $getBD->getProdutosUpdatePrecos();
$sendForAPI->atualizacaoDeProdutos($listUpdatePreco, "preco"); //Tipos de atualizacões "saldo", "preco" ou "dados"

//ENVIAR PRODUTOS
$listInsert = $getBD->getProdutosSendLoja();
$sendForAPI->insertProdutos($listInsert);



$smarty->display('api-fastcommerce.tpl');
