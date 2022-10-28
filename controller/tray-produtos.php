<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$ambiente = 'producao';

$config = new TrayConfig();
$dataConfig = $config->getConfigs($ambiente);
//TOKEN QUE É ATUALIZADO DE TEMPO EM TEMPO
$access_token  = $dataConfig['access_token'];


//LISTA DE PRODUTOS NA TRAY
$produtosTray = new TrayProdutos();


$produtosHorus = new HsProdutos();
$dataProdutoHorus = $produtosHorus->getItensEnviarTray();//PRODUTOS QUE NÃO FORAM ENVIADOS PARA TRAY

foreach ($dataProdutoHorus as $produto) {
    
    $dataProduto = [];//VARIAVEL PARA GUARDA DADOS DO ITEM PARA ENVIAR
    $dataProduto['Product'] = $produto;

    $retorno = $produtosTray->cadastrarProduto($access_token, $dataProduto);
    
    if(isset($retorno->code) && $retorno->code == 201){//ATUALIZAR NA TABELA HS_PRODUTO O ID DO PRODUTO NA TRAY
        $dataSet = [
            "idTray" => $retorno->id,
            "statusTray"=> '1'
        ];
        $dataWhere = [
            "id_loja"=> Config::ID_LOJA,
            "COD_ITEM"=>$produto['reference']
        ];
        $produtosHorus->updateTable('hs_produtos', $dataSet, $dataWhere);
    }
    
    die;
    unset($dataProduto['Product']);
    
}
var_dump($dataProdutoHorus);


//var_dump($dataConfig);
