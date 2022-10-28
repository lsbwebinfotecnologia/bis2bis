<?php

$smarty = new Template();

$empresas = new Clientes();
$empresas->getClients();

$smarty->assign('EMPRESAS', $empresas->ListarDados());

$smarty->display('cadastro-empresas.tpl');
