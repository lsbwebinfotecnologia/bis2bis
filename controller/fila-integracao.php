<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$smarty = new Template();

//BREADCRUMBS OBRIGATÓRIO NAS PÁGINAS
$PagesBreadCrumbs = [
    "Home"=> Rotas::get_SiteHome()
];
$smarty->assign('BREADCRUMBS', $PagesBreadCrumbs);
$page = [
    'link'=> Rotas::get_SiteHome() . '/fila-integracao',
    'title'=> 'Gestão de Integrações'
];
$smarty->assign('PAGE', $page);
//FIM BREADCRUMBS

$smarty->assign("PAGINA", Rotas::get_SiteHome()."/fila-integracao");
$smarty->assign("IDLOJA", Config::ID_LOJA);

$filaIntegracao = new FilaIntegracao();
if(isset($_POST['tipoIntegracao'])){
    $filaIntegracao->insertTable("f_fila_integracao", $_POST);
    echo Sistema::msgSucess("Fila inserida com sucesso");
}

$smarty->display('fila-integracao.tpl');
