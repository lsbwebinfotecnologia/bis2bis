<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$smarty = new Template();

$configuracoes = new Configuracoes();
$smarty->assign('DADOSAPI', $configuracoes->getDadosAPIHorus());

$smarty->display('configuracoes-erp.tpl');