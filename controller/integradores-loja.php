<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//echo '<pre>';
$smarty = new Template();

$configuracoes = new Configuracoes();
$integradores = $configuracoes->getIntegradores('mt');


$smarty->assign('INTEGRADORES', $integradores);
$smarty->assign('URL', Rotas::get_SiteHome());

$smarty->display('integradores-loja.tpl');

function insert_tipoIntegrador($tipo) {//FUNCAO UTILIZADA PARA ATRIBUIR A CLASS NO BR AO FIM DA LISTAGEM DO ITEM    
    $listaTipos = array(
        "ws-produtos"=> "Produtos"
    );
    if($listaTipos[$tipo['type']]){
       return $listaTipos[$tipo['type']]; 
    }
}