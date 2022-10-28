<?php

//BREADCRUMBS OBRIGATÓRIO NAS PÁGINAS
$PagesBreadCrumbs = [
    "Home"=> Rotas::get_SiteHome()
];
$smarty->assign('BREADCRUMBS', $PagesBreadCrumbs);
$page = [
    'link'=> Rotas::pagina_ProdutosGestao(),
    'title'=> 'Configuração da estrutura de produto na Tray X Horus'
];
$smarty->assign('PAGE', $page);
//FIM BREADCRUMBS

