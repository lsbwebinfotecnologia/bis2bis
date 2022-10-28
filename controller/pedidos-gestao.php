<?php

$smarty = new Template();

//BREADCRUMBS OBRIGATÓRIO NAS PÁGINAS
$PagesBreadCrumbs = [
    "Home"=> Rotas::get_SiteHome()
];
$smarty->assign('BREADCRUMBS', $PagesBreadCrumbs);
$page = [
    'link'=> Rotas::pagina_PedidosGestao(),
    'title'=> 'Gestão de Pedidos'
];
$smarty->assign('PAGE', $page);
//FIM BREADCRUMBS


$smarty->assign('PAGINA_GESTAO_PEDIDO', Rotas::pagina_PedidosGestao());

$dataFilter = [];

$dataFilter['dataIni'] = isset($_GET['dataIni']) ? date('Y-m-d', strtotime(str_replace("/", "-", $_GET["dataIni"]))) : date('Y-m-d', strtotime('-15 days'));
$dataFilter['dataFim'] = isset($_GET['dataFim']) ? date('Y-m-d', strtotime(str_replace("/", "-", $_GET["dataFim"]))) : date('Y-m-d');
$dataFilter['status'] = isset($_GET['status']) ? $_GET['status'] : false;
$dataFilter['v_id'] = isset($_GET['v_id']) ? $_GET['v_id'] : false;


$pedidosCronuz = new PedidosCronuz();
$dadosPedidos = $pedidosCronuz->getPedidos($dataFilter);
//var_dump($dadosPedidos);
//die;


$smarty->assign('PEDIDOS', $dadosPedidos);
$smarty->assign('DATAFILTER', $dataFilter); 




$smarty->display('pedidos-gestao.tpl');