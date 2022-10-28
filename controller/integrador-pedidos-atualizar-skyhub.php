<?php

if (!isset($_GET['front'])) {
    require '../lib/autoload.php';
}

$configuracao = new Configuracoes();
$codEmpresa = $configuracao->getDadosConfig('codEmpresa');
$codFilial = $configuracao->getDadosConfig('codFilial');
$idStatus = $configuracao->getDadosConfig('codStatusAoEnviarParaErp');
$idStatusFat = $configuracao->getDadosConfig('nomeStatusFaturadoBuscaNfRastreio');

$orders = new PedidosAtualizarStatus();
$orders->getPedidosAtualizarStatus($idStatus, 'skyhub');
$listOrder = $orders->getDatas();


//ATUALIZACAO STATUS DO PEDIDO PARA FATURADO
foreach ($listOrder as $pedidoBD) {//LISTAGEM DE PEDIDOS PARA ATUALIZAR STATUS NO CRONUS
    $idPedidoERP = $pedidoBD['cod_pedido_erp'];
    $statusPedidoBD = $pedidoBD['status'];

    $pedidoWS = new PedidosERP();

    $pedidoWS->setCodEmpresa($codEmpresa);
    $pedidoWS->setCodFilial($codFilial);
    $pedidoWS->setCodCliERP($pedidoBD['id_cliente_erp']);



    try {
        $datasPedidosWS = $pedidoWS->getDadosPedidoErp($idPedidoERP); // Dados retorno Pedido WS

        $deFaturado = $configuracao->getDePara('status_pedido_ERP_x_WS_FAT')['de'];
        $deCancelado = $configuracao->getDePara('status_pedido_ERP_x_WS_CAN')['de'];

        $paraFaturado = $configuracao->getDePara('status_pedido_ERP_x_WS_FAT')['para'];
        $paraCancelado = $configuracao->getDePara('status_pedido_ERP_x_WS_CAN')['para'];

        $listDePara = [
            $deFaturado => $paraFaturado,
            $deCancelado => $paraCancelado
        ];

        foreach ($datasPedidosWS as $pedidoWS) {
//            var_dump($pedidoWS);
//            var_dump($statusPedidoBD, $de, $pedidoBD);
            $statusPedidoWS = $pedidoWS['STATUS_PEDIDO_VENDA'];
            $idPedidoERP = $pedidoWS['COD_PED_VENDA'];
            //TRATAR INFORMAÇÕES DO PEDIDO RETORNADO
            if (isset($listDePara[$statusPedidoWS])) {
                $para = $listDePara[$statusPedidoWS];
                $orders->updateSatatusPedido($idPedidoERP, $para);
                echo 'Pedido ' . $idPedidoERP . ' atualizado para ' . $statusPedidoWS . '<br>';
            }
        }
    } catch (Exception $exc) {
        echo 'Erro na busca das informaões do pedido' . $idPedidoERP . '<br>';
        echo $exc->getTraceAsString();
    }
}

//ATUALIZACAO NF
$ordersFaturado = new PedidosAtualizarStatus();
$ordersFaturado->getPedidosAtualizarStatus($idStatusFat, 'skyhub', true);
$listOrderFaturado = $ordersFaturado->getDatas();


foreach ($listOrderFaturado as $notaBD) {//LISTAGEM DE PEDIDOS PARA ATUALIZAR STATUS NO CRONUS
    $codPedidoERP = $notaBD['cod_pedido_erp'];

    $notaWS = new PedidosERP();

    $notaWS->setCodEmpresa($codEmpresa);
    $notaWS->setCodFilial($codFilial);
    $notaWS->setCodCliERP($notaBD['id_cliente_erp']);

    try {
        $datasNotaWS = $notaWS->getDadosNotasPedidoErp($codPedidoERP); // Dados retorno Pedido WS

        foreach ($datasNotaWS as $nfWS) {


            $chaveNF = $nfWS['CHAVE_ACESSO_NFE'];
            $nroNf = $nfWS['NRO_NOTA_FISCAL'];

            if ($nfWS['COD_PED_VENDA'] == $codPedidoERP) {
                $ordersFaturado->updateNFPedido($codPedidoERP, $chaveNF, $nroNf);
                echo 'NF atualizada para o pedido <strong>' . $nfWS['COD_PED_VENDA'] . '</strong><br>';
            }
        }
    } catch (Exception $exc) {
        echo 'Erro na busca das informacoes do pedido' . $codPedidoERP . '<br>';
        echo $exc->getTraceAsString();
    }
}
