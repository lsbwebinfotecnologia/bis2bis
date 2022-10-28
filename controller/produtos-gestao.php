<?php

$smarty = new Template();

//BREADCRUMBS OBRIGATÓRIO NAS PÁGINAS
$PagesBreadCrumbs = [
    "Home" => Rotas::get_SiteHome()
];
$smarty->assign('BREADCRUMBS', $PagesBreadCrumbs);
$page = [
    'link' => Rotas::pagina_ProdutosGestao(),
    'title' => 'Gestão de Produtos'
];
$smarty->assign('PAGE', $page);
//FIM BREADCRUMBS



$status = isset(Rotas::$pag[1]) ? Rotas::$pag[1] : '';
$smarty->assign('PAGINA_GESTAO_PRODUTOS', Rotas::pagina_ProdutosGestao());
$smarty->assign('STATUS', $status);

$filter = [];

$filter['titulo'] = isset($_GET['titulo']) && !empty($_GET['titulo']) ? $_GET["titulo"] : false;
$filter['sku'] = isset($_GET['sku']) && !empty($_GET['sku']) ? $_GET["sku"] : false;
$filter['status'] = isset($_GET['status']) && !empty($_GET['status']) ? $_GET['status'] : false;
$filter['editora'] = isset($_GET['editora']) && !empty($_GET['editora']) ? $_GET['editora'] : false;

//var_dump($status);

$produtos = new HsProdutos();
$dataProdutos = $produtos->getProdutos($filter);
$smarty->assign('TOTALITENS', $produtos->getTotalDeProdutos($filter));


$smarty->assign('URL_IMAGES', Config::URL_IMGS);

$smarty->assign('PRODUTOS', $dataProdutos);
$smarty->assign('PAGINACAO', $produtos->showPaginacao());
//
$smarty->assign('PAGINA_PRODUTOS', Rotas::pagina_Produtos());
$smarty->assign('FILTROS', $filter);
//$smarty->assign('PAGINA_PRODUTOS_GESTAO', Rotas::pagina_ProdutosGestao());
//$smarty->assign('PAGINA_MODELO_PRECO', Rotas::get_SiteHome() . '/files/skyhub/produtos-preco/modelo/ModeloImportarPrecoCronus.xlsx');
//$smarty->assign('ACTION_EXPORT_PRODUTO', Rotas::pagina_ActionEmportProdutosSkyhub());
//$smarty->assign('ACTION_PRODUTO_GESTAO', Rotas::pagina_ActionProdutoGestao());




$smarty->display('produtos-gestao.tpl');
