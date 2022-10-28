<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$smarty = new Template();

$configuracoes = new Configuracoes();

$smarty->assign('PAGINAACAO', Rotas::get_SiteHome().'/configuracoes-dados-ws');
$smarty->assign('PAGINA', 'configuracao-erp-ws');
//var_dump($configuracoes);
//CONFIGURACOES INTEGRACOES SMARTS
//WS
$smarty->assign('URL_WSCLIENTS', $configuracoes->getDadosConfig('nomeWSClientes'));
$smarty->assign('URL_WSPRODUCTS', $configuracoes->getDadosConfig('nomeWSProdutos'));
$smarty->assign('URL_WSORDERS', $configuracoes->getDadosConfig('nomeWSPedidos'));
$smarty->assign('URL_WSCAPAS', $configuracoes->getDadosConfig('nomeWSCapas'));

//EMPRESA FILIAL
$smarty->assign('COD_EMPRESA', $configuracoes->getDadosConfig('codEmpresa'));
$smarty->assign('COD_FILIAL', $configuracoes->getDadosConfig('codFilial'));

//PRODUTOS
$smarty->assign('COD_TIPO_CARACTERISTICA', $configuracoes->getDadosConfig('codTipoCaracteristica'));
$smarty->assign('COD_CARACTERISTICA', $configuracoes->getDadosConfig('codCaracteristica'));
$smarty->assign('TIPO_DISPONIBILIDADE_ESTOQUE', $configuracoes->getDadosConfig('estoqueEm'));
$smarty->assign('QTD_MINIMA_DISPONIVEL', $configuracoes->getDadosConfig('percentualEstoqueDisponivel'));

//PEDIDOS
$smarty->assign('COD_METODO_VENDA_ERP', $configuracoes->getDadosConfig('codMetodoVenda'));
$smarty->assign('COD_RESPONSAVEL_ERP', $configuracoes->getDadosConfig('codResponsavelVenda'));
$smarty->assign('COD_FORMA_PAGTO_BOLETO', $configuracoes->getDadosConfig('codFormaPagtoBoletoVenda'));
$smarty->assign('COD_FORMA_PAGTO_CCREDIT', $configuracoes->getDadosConfig('codFormaPagtoCCredVenda'));
$smarty->assign('COD_STATUS_ENVIO_PEDIDOS', $configuracoes->getDadosConfig('nomeStatPedidoEnvErp'));
$smarty->assign('QTD_DIAS_BUSCA_PEDIDO_CRON', $configuracoes->getDadosConfig('qtdDiasCron'));
$smarty->assign('COD_STATUS_BUSCA_RASTREIO', $configuracoes->getDadosConfig('nomeStatusFaturadoBuscaNfRastreioEros'));
$smarty->assign('STATUS_FATURADO_ERP', $configuracoes->getDadosConfig('nomeStatusFaturadoBuscaNfRastreio'));
$smarty->assign('COD_STATUS_SICRONIZAR', $configuracoes->getDadosConfig('nomeStatPedidoSincronizacaoERP'));
$smarty->assign('COD_STATUS_APOS_ENVIAR', $configuracoes->getDadosConfig('codStatusAoEnviarParaErp'));
$smarty->assign('STATUS_APOS_ENVIAR', $configuracoes->getDadosConfig('statusERPaposEnviar'));


//TRANSPORTES
$smarty->assign('COD_PAC', $configuracoes->getDadosConfig('codPac'));
$smarty->assign('COD_SEDEX', $configuracoes->getDadosConfig('codSedex'));
$smarty->assign('COD_MODICO', $configuracoes->getDadosConfig('codImpressoModico'));
$smarty->assign('COD_OUTRA', $configuracoes->getDadosConfig('codOutra'));

//CLIENTES
$smarty->assign('COD_TIPO_CLI_ERP', $configuracoes->getDadosConfig('codTipoCli'));
$smarty->assign('COD_TIPO_END_ERP', $configuracoes->getDadosConfig('codTipoEndCli'));
$smarty->assign('COD_RESP_ERP', $configuracoes->getDadosConfig('codRespCli'));
$smarty->assign('NOME_RESP_ERP', $configuracoes->getDadosConfig('nomeRespCli'));



$smarty->display('configuracoes-erp-ws.tpl');