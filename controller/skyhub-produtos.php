<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$produtos = new ProdutosSendSkyhub();
$produtos->getProductsStatusSkyhub('enabled');
$productsData = $produtos->getDatas();
//echo '<pre>';
//die(var_dump($productsData));

$c = 0;

//INICIO PRODUTOS QUE SERAO ENVIADOS NO BANCO PRECISA FICAR COM STATUS SKYHUB 1 E STATUSSKYHUB NOSEND
foreach ($productsData as $product) {

    $pId = $product['id_produto'];
    $skyhub = new SkyHubProdutos();
    $skyhub->prepararAtributos($product);

    $validaProduto = new SkyHubProdutoValidacao();
    $valida = $validaProduto->validaProduto($product); //VALIDA AS INFORMAÇÕES DO PRODUTO

    if ($valida['error'] == false) {//SE TODOS OS DADOS DO PRODUTO ESTÃO OK!
        //PRODUTODOS E SEUS ATRIBUTOS NO EROS 
        //OS ATRIBUTOS SERAO UTILIZADOS PARA CLASSIFICAR ASSUNTO OU OUTROS TIPOS DE INFORMAÇÕES
        $produtoAtributos = new ProdutosAtributos();
        $variations = $produtoAtributos->getProdutoAtributos($pId);
        $skyhub->setSpecifications($variations);

        if ($variations) {//SE TIVER VARIACAO
            $skyhub->setVariation_attributes();
            $skyhub->setVariations($variations);
        }

        if ($skyhub->insertProduto()) {//COMANDO PARA INSERIR O PRODUTO NA SKYHUB
            $return = $skyhub->insertProduto();

            if (isset($return['message'])) {//SE HOUVER UM ERRO NO ENVIO DO PRODUTO
                $obs = $return['message'];
                $dataSet = [
                    "obsIntegracaoSkyhub" => $obs
                ];
                $dataWhere = [
                    "p_id" => $pId
                ];
                $evento = new EventosCronus();
                $evento->updateTable('p_produtos', $dataSet, $dataWhere);
            }


            if (isset($return['reason_phrase']) && $return['reason_phrase'] == 'Created') {//SE O PRODUTO FOI CRIADO NA SKYHUB ATUALIZA OS DADOS DA TABELA DO PRODUTO
                $obs = "Produto enviado para Skyub status {$return['reason_phrase']} codigo de retorno {$return['status_code']} <br>";
                echo $obs;
                $dataSet = [
                    "obsIntegracaoSkyhub" => $obs,
                    "skyhub" => "1",
                    "data_envio_skyhub" => date('Y-m-d H:i:s'),
                    "updateDadosSkyhub" => 'N',
                    "updateSaldoSkyhub" => 'N'
                ];

                $dataWhere = [
                    "p_id" => $pId,
                    'id_loja'=> Config::ID_LOJA
                ];

                $evento = new EventosCronus();
                $evento->updateTable('p_produtos', $dataSet, $dataWhere);
                $evento->insertHistoricoSkyhub($obs, $pId);
            }
        }
    } else {
        $evento = new EventosCronus();
        $evento->insertHistoricoSkyhub($valida['msg'], $pId);
        var_dump($valida['msg']);
    }
    $c ++;
}

echo "Total de {$c} produto(s) enviados para Skyhub <br>";
//FIM ENVIO DE NOVOS PRODUTOS PARA SKYHUB


//PRODUTOS QUE SERAO DESABILITADOS
$disableProduto = new ProdutosSendSkyhub();
$disableProduto->getProductsStatusSkyhub('disabled');
$dataDisable = $disableProduto->getDatas();

$c2 = 0;

foreach ($dataDisable as $productDisabled) {

    $sku = $productDisabled['sku'];
    $status = $productDisabled['status'];

    $skyhubUpdate = new SkyHubProdutoUpdate();
    $skyhubUpdate->updateStatusProduto($sku, $status);

    $dataSet = [
        "updateStatusProdutoSkyhub" => 'N'
    ];

    $dataWhere = [
        "isbn" => $sku,
        'id_loja'=> Config::ID_LOJA
    ];

    $evento = new EventosCronus();
    $evento->updateTable('p_produtos', $dataSet, $dataWhere);

    $c2 ++;
}

echo "Total de {$c2} produto(s) desabilitados na Skyhub <br>";

//FIM ATUALIZAÇÃO DE PRODUTOS


//PRODUTOS QUE TERAO CAPAS ATUALIZADAS
$produtosCapa = new ProdutosSendSkyhub();
$produtosCapa->getListProdutosUpdateCapas();
$dataProdutosCapas = $produtosCapa->getDatas();
$c3 = 0;
foreach ($dataProdutosCapas as $productCapa) {

    $sku = $productCapa['sku'];
    $image = $productCapa['images'];

    $skyhubUpdateCapa = new SkyHubProdutoUpdate();
    $skyhubUpdateCapa->updateImagem($sku, $image);

    $dataSet = [
        "updateStatusProdutoSkyhub" => 'N'
    ];

    $dataWhere = [
        "isbn" => $sku,
        'id_loja'=> Config::ID_LOJA
    ];

    $evento = new EventosCronus();
    $evento->updateTable('p_produtos', $dataSet, $dataWhere);

    $c3 ++;
}

echo "Total de {$c3} produto(s) com capas atualizadas na Skyhub <br>";