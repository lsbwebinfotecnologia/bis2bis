<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//LISTA DE PRODUTOS QUE PRECISA ATUALIZAR O SALDO NA SKYHUB
$produtos = new ProdutosUpdateSkyhub();
$produtos->getProductsUpdateSkyhub('updatePriceSkyhub');
$productsData = $produtos->getDatas();

foreach ($productsData as $product) {
    //die(var_dump($product));
    $skyhub = new SkyHubProdutoUpdate();

    $sku = $product['sku'];
    $price = $product['price'];
    $promotional_price = 0.00;

    if ($price > 0) {
        if ($product['promotional_price'] > 0) {
            $promotional_price = $product['promotional_price'];
            $resposta = $skyhub->updatePrice($sku, $price, $promotional_price);
        } else {
            $resposta = $skyhub->updatePrice($sku, $price);
        }


        if ($resposta) {
            $evento = new EventosCronus();
            $dataSet = [
                "updatePriceSkyhub" => "N"
            ];
            $dataWhere = [
                "p_id" => $product['id_produto']
            ];
            var_dump($evento->updateTable('p_produtos', $dataSet, $dataWhere));
        }

        echo "Produto com SKU $sku enviado com o preço  de R$ $price e preço promocional de R$ $promotional_price <br>";
    }else{
        echo "Produto com SKU $sku está com o preço R$ $price e não é permitido enviar com o valor zerado <br>";
    }
}