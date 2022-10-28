<?php


$smarty = new Template();

$configuracoes = new Configuracoes();

$integradores = $configuracoes->getIntegradores('skyhub');

$smarty->assign('INTEGRADORES', $integradores);
$smarty->assign('URL', Rotas::get_SiteHome());

$smarty->display('skyhub-sincronizadores.tpl');

