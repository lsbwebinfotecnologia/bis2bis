<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//ATUALIZAR PEDIDOS FATURADOS

$orderInvoiced = new PedidosStatus();
$orderInvoiced->getOrdersInvoiced();

$pedidosFaturados = $orderInvoiced->getDatas();

foreach ($pedidosFaturados as $orderFat) {

    $status = "order_invoiced";
    $statusLabel = "Pagamento Faturado (SkyHub)";
    $statusTye = "INVOICED";

    $dataOrder = [
        "order" => $orderFat["order"],
        "key" => $orderFat["key"],
        "volume_qty" => $orderFat["volume_qty"]
    ];

    $orderUpdate = new SkyhubPedidosUpdate();
    if ($orderUpdate->updateOderInvoiced($dataOrder)) {
        $evento = new EventosCronus();
        $dataSet = [
            "status_skyhub" => $status,
            "statusTypeSkyhub" => $statusTye,
            "statusLabelSkyhub" => $statusLabel,
            "sendInvoice" => "1"
        ];
        $dataWhere = [
            "id_ped_skyhub" => $orderFat["order"]
        ];
        $evento->updateTable("l_vendas", $dataSet, $dataWhere);

        $columnsInserts = [
            "id_venda" => $orderFat["v_id"],
            "status" => $status,
            "id_loja" => Config::ID_LOJA,
            "user" => "Eros"
        ];
        $evento->insertTable("l_vendas_historico_skyhub", $columnsInserts);


        echo "Pedido {$dataOrder["order"]} atualizado para o status de faturado!<br>";
    }else{
        echo 'Erro! '.$orderFat["order"].'<br>';
    }
}


//PEDIDOS CANCELADOS

$orderCanceled = new PedidosStatus();
$orderCanceled->getOrdersCanceled();

$pedidosCancelados = $orderCanceled->getDatas();



foreach ($pedidosCancelados as $orderCan) {


    $status = "order_canceled";
    $statusLabel = "Cancelado (SkyHub)";
    $statusTye = "CANCELED";

    $dataOrder = [
        "order" => $orderCan["order"],
    ];

    $orderUpdate = new SkyhubPedidosUpdate();
    $orderUpdate->updateOderCanceled($dataOrder);

    $evento = new EventosCronus();
    $dataSet = [
        "status_skyhub" => $status,
        "statusTypeSkyhub" => $statusTye,
        "statusLabelSkyhub" => $statusLabel,
        "sendInvoice" => "1"
    ];
    $dataWhere = [
        "id_ped_skyhub" => $orderCan["order"]
    ];
    $evento->updateTable("l_vendas", $dataSet, $dataWhere);

    $columnsInserts = [
        "id_venda" => $orderCan["v_id"],
        "status" => $status,
        "id_loja" => Config::ID_LOJA,
        "user" => "Eros"
    ];
    $evento->insertTable("l_vendas_historico_skyhub", $columnsInserts);


    echo "Pedido {$dataOrder["order"]} atualizado para o status de faturado!<br>";
}

///ATUALIZAR PEDIDOS COM ETIQUETAS
