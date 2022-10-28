<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//LISTA DE PRODUTOS QUE PRECISA ATUALIZAR O SALDO NA SKYHUB
$produtos = new ProdutosUpdateSkyhub();
$produtos->getProductsUpdateSkyhub("updateSaldoSkyhub");
$productsData = $produtos->getDatas();

$c = 0;

foreach ($productsData as $product) {
    
    $sku = $product['sku'];
    $qty = $product['qty'];

    $skyhub = new SkyHubProdutoUpdate();
    $resposta = $skyhub->updateEstoque($sku, $qty);

    if ($resposta) {
        $evento = new EventosCronus();
        $dataSet = [
            "updateSaldoSkyhub" => "N"
        ];
        $dataWhere = [
            "p_id" => $product['id_produto']
        ];
        var_dump($evento->updateTable('p_produtos', $dataSet, $dataWhere));
    }
    
    echo "Produto com SKU $sku enviado o estoque de  $qty <br>";
    
}







