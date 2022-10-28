<?php



$smarty = new Template();

//BREADCRUMBS OBRIGATÓRIO NAS PÁGINAS
$PagesBreadCrumbs = [
    "Home"=> Rotas::get_SiteHome(),
    "Gestão de Pedidos"=> Rotas::pagina_PedidosGestao()
];
$smarty->assign('BREADCRUMBS', $PagesBreadCrumbs);
$page = [
    'link'=> '#',
    'title'=> 'Status de Pedidos'
];
$smarty->assign('PAGE', $page);
//FIM BREADCRUMBS


$smarty->assign('EDITION', FALSE);
$smarty->assign('PAGINASTATUSPEDIDO', Rotas::pagina_PedidosStatus());
$smarty->assign('PAGINAACTIONSTATUS', Rotas::pagina_ActionPedidosStatus());

$status = new StatusPedidos();
$status->getStatusPedidos();
$smarty->assign('STATUSPEDIDO', $status->getDatas());

$acao = isset(Rotas::$pag[1]) ? Rotas::$pag[1] : "";
$smarty->assign('ACTION', $acao);
//var_dump($acao);

if($acao == 'new'){
    $smarty->assign('EDITION', TRUE);
    
    
}elseif($acao == 'update'){
    $smarty->assign('EDITION', TRUE);
    $idStatus = isset(Rotas::$pag[2]) ? Rotas::$pag[2] : '';
    
    $statusDados = new StatusPedidos();
    $statusDados->getStatusPedidos($idStatus);
    
    $smarty->assign('STATUSDADOS', $statusDados->getDatas()[1]);
}





$smarty->display('pedidos-status.tpl');

