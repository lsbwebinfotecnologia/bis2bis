<?php


$smarty = new Template();

$configuracoes = new Configuracoes();

$integradores = $configuracoes->getIntegradores('cs');

$smarty->assign('INTEGRADORES', $integradores);
$smarty->assign('URL', Rotas::get_SiteHome());

$smarty->display('cs-sincronizadores.tpl');

