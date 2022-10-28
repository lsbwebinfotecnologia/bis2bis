<?php

$smarty = new Template();

$configuracoes = new Configuracoes();
$dataLojaIntegrada = $configuracoes->getDadosLojaIntegrada();
$smarty->assign('DADOSLOJAINTEGRADA', $dataLojaIntegrada);




$smarty->display('configuracoes-loja-integrada.tpl');