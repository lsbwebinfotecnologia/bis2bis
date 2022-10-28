<?php

$smarty = new Template();

//BREADCRUMBS OBRIGATÓRIO NAS PÁGINAS
$PagesBreadCrumbs = [
    "Home"=> Rotas::get_SiteHome(),
    "Gestão Produtos" => Rotas::pagina_ProdutosGestao()
];
$smarty->assign('BREADCRUMBS', $PagesBreadCrumbs);
$page = [
    'link'=> Rotas::pagina_Categorias(),
    'title'=> 'Categorias'
];
$smarty->assign('PAGE', $page);
//FIM BREADCRUMBS


$categorias = new ProdutoCategoria();
$categorias->getCategorias();
$smarty->assign('CATEGORIAS', $categorias->getDatas());




$smarty->display('categorias.tpl');