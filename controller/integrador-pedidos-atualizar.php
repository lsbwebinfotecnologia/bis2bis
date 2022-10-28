<?php

if(!isset($_GET['front'])){
    require '../lib/autoload.php';
}

$configuracao = new Configuracoes();
$codEmpresa = $configuracao->getDadosConfig('codEmpresa');
$codFilial = $configuracao->getDadosConfig('codFilial');

$listOrder = new PedidoBD();
$listOrder->getPedidoAtualizar();
$dataOrders = $listOrder->getDatas();


//die;
$c =1;
//ATUALIZACAO STATUS DO PEDIDO
foreach ($dataOrders as $pedidoBD) {//LISTAGEM DE PEDIDOS PARA ATUALIZAR STATUS NO CRONUS
//var_dump($pedidoBD);
    $idPedidoERP = $pedidoBD['cod_pedido_erp'];
    $statusPedidoBD = $pedidoBD['status'];
    
    $pedidoWS = new PedidosERP();    
   
    $pedidoWS->setCodEmpresa($codEmpresa);
    $pedidoWS->setCodFilial($codFilial);
    $pedidoWS->setCodCliERP($pedidoBD['id_cliente_erp']);
    
    try {
        $datasPedidosWS = $pedidoWS->getDadosPedidoErp($idPedidoERP);// Dados retorno Pedido WS
//        var_dump($datasPedidosWS);
        
        $de = 'FAT';
        $para = 3;
        
        foreach ($datasPedidosWS as $pedidoWS) {
            //TRATAR INFORMAÇÕES DO PEDIDO RETORNADO
            if($pedidoWS['STATUS_PEDIDO_VENDA'] == $de){
                $listOrder->updateSatatusPedido($pedidoWS['COD_PED_VENDA'], $para);
                echo 'Pedido ' . $pedidoWS['COD_PED_VENDA'] . ' atualizado para ' . $pedidoWS['STATUS_PEDIDO_VENDA'] . '<br>';
            }           
        }
        
    } catch (Exception $exc) {
        echo 'Erro na busca das informaões do pedido' . $idPedidoERP . '<br>';
        echo $exc->getTraceAsString();
    }
    
    $c ++;
    if($c == 100){
        break;
    }
    
}



//ATUALIZACAO NF
$listOrderUpdateNF = new PedidoBD();
$listOrderUpdateNF->getPedidoAtualizarNota();
$dataOrderNF = $listOrderUpdateNF->getDatas();

//die(var_dump($dataOrderNF));


foreach ($dataOrderNF as $notaBD) {//LISTAGEM DE PEDIDOS PARA ATUALIZAR STATUS NO CRONUS

    $codPedidoERP = $notaBD['cod_pedido_erp'];
    
    $notaWS = new PedidosERP();    
   
    $notaWS->setCodEmpresa($codEmpresa);
    $notaWS->setCodFilial($codFilial);
    $notaWS->setCodCliERP($notaBD['id_cliente_erp']);
    
    try {
        $datasNotaWS = $notaWS->getDadosNotasPedidoErp($codPedidoERP);// Dados retorno Pedido WS
        $dataRastreioWS = $notaWS->getDadosRastreioPedidoErp($codPedidoERP);// Dados retorno Pedido WS
//        var_dump($dataRastreioWS);
        $rastreio = isset($dataRastreioWS['Table']['COD_BARRA_ETIQUETA']) ? trim($dataRastreioWS['Table']['COD_BARRA_ETIQUETA']) : '';

        foreach ($datasNotaWS as $nfWS) {
            $chaveNF = isset($nfWS['CHAVE_ACESSO_NFE']) ? $nfWS['CHAVE_ACESSO_NFE'] : '';//$nfWS['CHAVE_ACESSO_NFE'];
            $nroNf = isset($nfWS['NRO_NOTA_FISCAL']) ? $nfWS['NRO_NOTA_FISCAL'] : '';

            if($nfWS['COD_PED_VENDA'] == $codPedidoERP){
                $listOrderUpdateNF->updateNFPedido($codPedidoERP, $chaveNF, $nroNf, $rastreio);
                
                echo 'NF atualizada para o pedido <strong>' . $nfWS['COD_PED_VENDA'] . '</strong><br>';
            }           
        }
        
    } catch (Exception $exc) {
        echo 'Erro na busca das informaões do pedido' . $codPedidoERP . '<br>';
        echo $exc->getTraceAsString();
    }
//    die;
    
}
