<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//echo '<pre>';
$smarty = new Template();

$configuracoes = new Configuracoes();

$integradores = $configuracoes->getIntegradores('hs');

$smarty->assign('INTEGRADORES', $integradores);
$smarty->assign('URL', Rotas::get_SiteHome());

$smarty->display('integradores-erp.tpl');
