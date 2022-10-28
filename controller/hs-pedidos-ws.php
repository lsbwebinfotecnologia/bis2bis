<?php

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


$hsApiHorus = new HSApiHorus();
$configuracao = new Configuracoes();
$dadosConfiguracoes = $configuracao->getTodosDadosConfig();

//var_dump($dadosConfiguracoes);
//die;

$listaStatusPedidosHorus = [
    "CAN" => "pedido-cancelado",
    "NOV" => "pedido-enviado-erp",
    "LFT" => "pedido-liberado-faturamento",
    "FAT" => "pedido-faturado"
];

$tipoSincronizacao = "hs-pedidos";
$infoIntegrador = $configuracao->getInfoIntegrador($tipoSincronizacao);
$configuracao->updateDateIntegrador($tipoSincronizacao, 'Atualizar status dos Pedidos - API');
$dataIni = date('d/m/Y', strtotime('-30 days', strtotime($infoIntegrador['data_sicronizacao'])));

$woocommerce = new Automattic\WooCommerce\Client(Config::WS_URL_LOJA, Config::WS_KEY_CONSUMER, Config::WS_SECRET_CONSUMER);

//$dataWC = ['status' => 'enviado-para-erp']; //ATUALIZANDO NO WOOCOMMERCE O STATUS DO PEDIDO PARA ENVIADO PARA O ERP
//$woocommerce->put("orders/148481", $dataWC);
//
//die;

//$filterRastreio = [
//    "COD_EMPRESA" => $dadosConfiguracoes['codEmpresa'],
//    "COD_FILIAL" => $dadosConfiguracoes['codFilial'],
//    "COD_METODO" => "1",
//    "DATA_INI" => date('d/m/Y H:m:s', strtotime('-30 days', strtotime($infoIntegrador['data_sicronizacao']))),
//    "DATA_FIM" => date('d/m/Y H:m:s', strtotime('+1 days'))
//];
//$rastreiosPedidosHorus = json_decode($hsApiHorus->getRastreiosPedidos($filterRastreio));

//var_dump($rastreiosPedidosHorus);
//die;

$filtros = [
    "COD_EMPRESA" => $dadosConfiguracoes['codEmpresa'],
    "COD_FILIAL" => $dadosConfiguracoes['codFilial'],
    "COD_METODO" => $dadosConfiguracoes['codMetodoVenda'],
    "DAT_ULT_ATL_INI" => $dataIni,
    "DAT_ULT_ATL_FIM" => date('d/m/Y', strtotime('+1 days'))
];

$pedidosAPI = json_decode($hsApiHorus->getPedidosHorus($filtros));

//var_dump($pedidosAPI);
//die;

$filter1 = [
    "status_pag" => "processing",
//    "wcConcluido" => "0"
];
$pedidosCronuz1 = new PedidosCronuz();
$dataPedidos1 = $pedidosCronuz1->getPedidos($filter1);
$pedidosProcessando = [];
foreach ($dataPedidos1 as $pprocessando) {
    $idLoja = $pprocessando['id_pedido_loja'];
    $pedidosProcessando[$idLoja] = $pprocessando['id_status_prod'];
}

$query = "";
$params = [
    ":id_loja" => Config::ID_LOJA
];
$c = 0;

//var_dump($listaStatusPedidosHorus, $pedidosProcessando, $pedidosAPI);
//die;

if (!empty($pedidosAPI)) {

    foreach ($pedidosAPI as $pedido) {

        $statusPedidoHorus = $pedido->STATUS_PEDIDO_VENDA;
        $codPedidoErp = $pedido->COD_PED_VENDA;
        $idPedidoLoja = $pedido->COD_PEDIDO_ORIGEM;

        if (isset($pedidosProcessando[$idPedidoLoja])) {

            $params[":status$statusPedidoHorus"] = isset($listaStatusPedidosHorus[$statusPedidoHorus]) ? $listaStatusPedidosHorus[$statusPedidoHorus] : '#nd';
            $params[":codped$codPedidoErp"] = $codPedidoErp;

            $query .= "update l_vendas set id_status_prod = :status{$statusPedidoHorus} where cod_pedido_erp = :codped{$codPedidoErp} and id_loja = :id_loja ;";
            $c ++;
        }
    }
    if ($c > 0) {
        $configuracao->executeSQL($query, $params);
    }
}

echo Sistema::msgSucess("$c pedido(s) atualizado(s) com sucesso!");
//die;
//var_dump($pedidosAPI);

$dataWC = ['status' => 'completed'];
//
$filter2 = [
    "pedido_exportado_erp" => "1",
    "id_status_prod" => "pedido-faturado",
    "status_pag" => "processing",
];

$pedidosCronuz2 = new PedidosCronuz();
$dataPedidos2 = $pedidosCronuz2->getPedidos($filter2);

$query2 = "";
$params2 = [
    ":id_loja" => Config::ID_LOJA
];
$a = 0;
if (!empty($dataPedidos2)) {
    foreach ($dataPedidos2 as $pedido2) {

        if ($a == 5) {
            break;
        }

        $vId = $pedido2['v_id'];
        $idPedidoLoja = $pedido2['id_pedido_loja'];


        $retorno = $woocommerce->put("orders/{$idPedidoLoja}", $dataWC);

        if (isset($retorno->status) && $retorno->status == 'completed') {

            $params2[":statusCompleted"] = "completed";
            $params2[":v_$vId"] = $vId;

            $query2 .= "update l_vendas set status_pag = :statusCompleted where v_id = :v_{$vId} and id_loja = :id_loja ;";
            $a ++;
        }
    }
    if ($a > 0) {
        $configuracao->executeSQL($query2, $params2);
    }
}
echo Sistema::msgSucess("$a pedido(s) atualizado(s) para completo no woocommerce!");
