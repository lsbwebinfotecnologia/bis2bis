<?php

$smarty = new Template();

//BREADCRUMBS OBRIGATÓRIO NAS PÁGINAS
$PagesBreadCrumbs = [
    "Home"=> Rotas::get_SiteHome()
];
$smarty->assign('BREADCRUMBS', $PagesBreadCrumbs);
$page = [
    'link'=> Rotas::pagina_ProdutosGestao(),
    'title'=> 'Ações em massa dos produtos'
];
$smarty->assign('PAGE', $page);
//FIM BREADCRUMBS

$smarty->assign('PAGINAACTIONPRECOS', Rotas::pagina_ActionImportProdutoPrecosSkyhub());
$smarty->assign('PAGINAACTIONPRODUTOS', Rotas::pagina_ActionImportProdutoSkyhub());
$smarty->assign('PAGINA_MODELO_PRECO', Rotas::get_SiteHome().'/files/skyhub/produtos-preco/modelo/ModeloImportarPrecoCronus.xlsx');
$smarty->assign('PAGINA_MODELO_PRODUTO_HABILITAR', Rotas::get_SiteHome().'/files/skyhub/produtos/modelo/ModeloImportarProdutoHabilitarCronus.xlsx');

$smarty->display('produtos-acoes.tpl');
