<?php

$smarty = new Template();

$configuracoes = new Configuracoes();

$smarty->assign('NAME_LOJA', $configuracoes->getDadosConfig('apiFastNomeLoja'));
$smarty->assign('STORE_ID', $configuracoes->getDadosConfig('apiFastIdLoja'));
$smarty->assign('USER_NAME', $configuracoes->getDadosConfig('apiFastUserName'));
$smarty->assign('PASS', $configuracoes->getDadosConfig('apiFastPass'));



$smarty->display('configuracoes-loja.tpl');