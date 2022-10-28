<?php

$action = isset($_GET['action']) ? $_GET['action'] : false;
$idOrderSkyHub  = isset($_GET['idOrder']) ? $_GET['idOrder'] : false;


if($action == 'deleteFilaPedido' && $idOrderSkyHub){
    $skyhub = new SkyHubPedido();
    var_dump($skyhub->deleteOrderOfFila($idOrderSkyHub));
    echo Sistema::msgSucess('Pedido ' . $idOrderSkyHub . ' Retirado da fila');
}