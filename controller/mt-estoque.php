<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$user = isset($_SESSION['USUARIO']) ? true : false;
$key = isset($_GET['key']) && $_GET['key'] == 'Cr0nuz20' ? true : false;

if ($key) {
    require '../lib/autoload.php';
    $idLoja = Config::ID_LOJA;
}

$class = class_exists('Config');

if (!$class) {
    echo 'acesso negado';
    die;
}
### CONFIG AREA ###
ini_set("soap.wsdl_cache_enabled", 0);  //desabilita cache do wsdl do php - recomendavel qdo houver alteracao no wsdl

$path = 'https://www.livrariafavorita.com.br'; //api/v2_soap/?wsdl=1
$apiUser = 'erpcronuz';
$apiKey = '667424b020cb117';

$hsApiHorus = new HSApiHorus();
$configuracao = new Configuracoes();
$produtoBis2Bis = new ProdutoBis2Bis($apiKey, $apiUser, $path);

$atualizaDataIntegrador = false;

$tipoSincronizacao = "mt-estoque";
$infoIntegrador = $configuracao->getInfoIntegrador($tipoSincronizacao);


$filtros = [
    "COD_EMPRESA" => $hsApiHorus->dadosAutenticacao['codEmpresa'],
    "COD_FILIAL" => $hsApiHorus->dadosAutenticacao['codFilial'],
    "DATA_INI" => date('d/m/Y h:i:s', strtotime('-2 days', strtotime($infoIntegrador['data_sicronizacao']))),
    "DATA_FIM" => date('d/m/Y h:i:s', strtotime('+1 day'))
];


if (isset($_GET['DATA_INI'])) {
    $filtros["DATA_INI"] = date('d/m/Y h:i:s', strtotime('-1 days', strtotime($_GET['DATA_INI'])));
}

if (isset($_GET['DATA_FIM'])) {
    $filtros["DATA_FIM"] = date('d/m/Y h:i:s', strtotime('+1 days', strtotime($_GET['DATA_FIM'])));
}

if (!empty($hsApiHorus->dadosAutenticacao['codLocalEstoque'])) {
    $filtros["COD_LOCAL_ESTOQUE"] = $hsApiHorus->dadosAutenticacao['codLocalEstoque'];
}

if (!empty($hsApiHorus->dadosAutenticacao['codTipoCaracteristica'])) {
    $filtros["COD_TPO_CARACT"] = $hsApiHorus->dadosAutenticacao['codTipoCaracteristica'];
}

if (!empty($hsApiHorus->dadosAutenticacao['codCaracteristica'])) {
    $filtros["COD_CARACT"] = $hsApiHorus->dadosAutenticacao['codCaracteristica'];
}

if (isset($_GET['COD_ITEM'])) {
    $filtros["COD_ITEM_INI"] = $_GET['COD_ITEM'];
    $filtros["COD_ITEM_FIM"] = $_GET['COD_ITEM'];
}


//GET DADOS API HORUS DE PRODUTOS
$estoqueAPI = json_decode($hsApiHorus->getEstoqueHorus($filtros)); //BUSCANDO PRODUTOS NA API

if (!empty($estoqueAPI)) {//LISTA DO ITENS
    $listaIdsDaBuscaDoEstoque = [];
    foreach ($estoqueAPI as $prd) {
        array_push($listaIdsDaBuscaDoEstoque, $prd->COD_ITEM);
    }

    $filtroProdutos2 = [
        "inIds" => $listaIdsDaBuscaDoEstoque
    ];

    $produtoDados = new ProdutoDados();
    $dataProdutos = $produtoDados->getDadosProdutos($filtroProdutos2); //CONSULTANDO ITENS DO GET DE PRODUTOS DA API

    $listaSaldoCronuz = [];
    foreach ($dataProdutos as $prd) {
        $listaSaldoCronuz[$prd['codItem']] = $prd['qty'];
    }
}

$queryUpdate2 = "";
$paramsUpdate2 = [];
$c2 = 0;
$produtoDados2 = new ProdutoDados();
foreach ($estoqueAPI as $est) {
//    var_dump($est);
//    die;
    $codItem = $est->COD_ITEM;
    $saldoDisponivel = $est->SALDO_DISPONIVEL;
    if (isset($listaSaldoCronuz[$codItem])) {
        $saldoCronuz = $listaSaldoCronuz[$codItem];
        if ($saldoDisponivel != $saldoCronuz) {//SE O SALDO FOR DIFERENTE COLOCA NA FILA PARA ATUALIZAR
            $dataSet = [
                "atualizaEstoque" => "S",
                "SALDO_DISPONIVEL" => $saldoDisponivel
            ];
            $dataWhere = [
                "COD_ITEM" => $codItem,
                "id_loja" => Config::ID_LOJA
            ];
            $comand = $produtoDados2->gerarQueryUpdateSQL("hs_produtos", $dataSet, $dataWhere);
            foreach ($comand["params"] as $k => $cmd) {
                $paramsUpdate2[$k] = $cmd;
            }
            $queryUpdate2 .= $comand["query"];
            $c2 ++;
//            var_dump($c2);
        }
    }
}
if (!empty($queryUpdate2)) {//PEGANDO A QUERY E INSERINDO DE UMA UNICA CONSULTA NO BANCO
    $produtoDados2->executeSQL($queryUpdate2, $paramsUpdate2);
}
echo Sistema::msgSucess("$c2 atualizado(s) com sucesso no Cronuz!");


//die;

//PRODUTOS QUE SERÃO ATUALIZADOS
$filtroProdutos3 = [
    "integrado" => 'S',
    "atualizaEstoque" => 'S',
    "idTerceiroMaiorQue" => 0
];

$produtoDados3 = new ProdutoDados();
$dataProdutos3 = $produtoDados3->getDadosProdutos($filtroProdutos3);
//var_dump($filtroProdutos3, $dataProdutos3);
//die;

$c3 = 0;
$queryUpdate3 = "";
$paramsUpdate3 = [];
$limit = Config::BD_LIMIT_POR_PAG;

if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
}

if (!empty($dataProdutos3)) {
    foreach ($dataProdutos3 as $prd3) {//VERIFICANDO QUEM SOFREU ALTERAÇÃO DE SALDO
        if ($c3 == $limit) {
            break;
        }
        $id = $prd3['id'];
        $dataSet = ["atualizaEstoque" => "N"];
        $dataWhere = [
            "idTerceiro" => $id,
            "id_loja" => Config::ID_LOJA
        ];
        $paramEstoque = [
            "idMagento" => $id,
            "qty" => $prd3['qty']
        ];
        $retorno = $produtoBis2Bis->enviarEstoque($paramEstoque);
        if (isset($retorno->result) && $retorno->result == 1) {
            $comand = $produtoDados3->gerarQueryUpdateSQL("hs_produtos", $dataSet, $dataWhere);
            foreach ($comand["params"] as $k => $cmd) {
                $paramsUpdate3[$k] = $cmd;
            }
            $queryUpdate3 .= $comand["query"];
            $c3 ++;
            $atualizaDataIntegrador = true;
        }
    }

    if (!empty($queryUpdate3)) {//PEGANDO A QUERY E INSERINDO DE UMA UNICA CONSULTA NO BANCO
        $produtoDados3->executeSQL($queryUpdate3, $paramsUpdate3);
    }
}


$configuracao->updateDateIntegrador($tipoSincronizacao, 'Sincronização de estoque - Magento');
echo Sistema::msgSucess("$c3 atualizado(s) com sucesso no Magento!");



if (!isset($infoIntegrador['data_sicronizacao']) || $atualizaDataIntegrador == true) {
    $configuracao->updateDateIntegrador($tipoSincronizacao, 'Sincronização de estoque - API');
}