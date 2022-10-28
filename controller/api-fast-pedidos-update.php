<?php
echo '<pre>';
$chamadaAPI = new PedidosAPI();
$pedidosBD = new PedidoBD();
$pedidosBD->getPedidoAtualizar();
var_dump($pedidosBD->getDatas());
//die;

$addForm = array(//ADICIONANDO O METHODO E FILTROS
    "Method" => "OrderUpdate "
);

//$chamadaAPI->setForm(mb_convert_encoding($addForm, 'ISO-8859-1', 'UTF-8'));
//$chamadaAPI->actionPedidosAPI();
//$pedidosAPI = $chamadaAPI->getPedidosAPI();
//
//var_dump($pedidosAPI);