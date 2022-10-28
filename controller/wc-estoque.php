<?php

//PRODUTOS QUE SERÃO ATUALIZADOS
$filter = [
    "atualizaEstoque" => 'S'
];
$produtoDados = new ProdutoDados();
$produtoDados->getDadosProdutos($filter);
$dataProdutos = $produtoDados->getDatas();
var_dump($dataProdutos);
die;