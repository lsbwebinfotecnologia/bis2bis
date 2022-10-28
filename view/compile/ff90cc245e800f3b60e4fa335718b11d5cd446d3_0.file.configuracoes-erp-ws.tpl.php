<?php
/* Smarty version 3.1.39, created on 2021-05-31 16:57:01
  from 'C:\xampp\htdocs\bis2bis\view\configuracoes-erp-ws.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60b4f93d38f6b7_74438337',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ff90cc245e800f3b60e4fa335718b11d5cd446d3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bis2bis\\view\\configuracoes-erp-ws.tpl',
      1 => 1615763807,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b4f93d38f6b7_74438337 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>Configurações ERP x Loja</h1>
</div>
<div class="container-fluid"><hr>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Configurações dos WebServices</h5>
                </div>
                <div class="widget-content nopadding">
                    <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['PAGINAACAO']->value;?>
" class="form-horizontal">
                        <input  type="hidden" name="pagina" id="pagina" value="<?php echo $_smarty_tpl->tpl_vars['PAGINA']->value;?>
">
                        <div class="control-group">
                            <label class="control-label">WS de Produtos : <a class="btn-mini btn-info" href="<?php echo $_smarty_tpl->tpl_vars['URL_WSPRODUCTS']->value;?>
" target="_blanc">Verificar</a></label>
                            <div class="controls">
                                <input class="span11" type="text" name="nomeWSProdutos" id="nomeWSProdutos" value="<?php echo $_smarty_tpl->tpl_vars['URL_WSPRODUCTS']->value;?>
">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">WS de Clientes : <a class=" btn-mini btn-info" href="<?php echo $_smarty_tpl->tpl_vars['URL_WSCLIENTS']->value;?>
" target="_blanc">Verificar</a></label>
                            <div class="controls">
                                <input class="span11" type="text" name="nomeWSClientes" id="nomeWSClientes" value="<?php echo $_smarty_tpl->tpl_vars['URL_WSCLIENTS']->value;?>
">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">WS de Pedidos : <a class=" btn-mini btn-info" href="<?php echo $_smarty_tpl->tpl_vars['URL_WSORDERS']->value;?>
" target="_blanc">Verificar</a></label>
                            <div class="controls">
                                <input class="span11" type="text" name="nomeWSPedidos" id="nomeWSPedidos" value="<?php echo $_smarty_tpl->tpl_vars['URL_WSORDERS']->value;?>
">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">WS das Capas : <a class=" btn-mini btn-info" href="<?php echo $_smarty_tpl->tpl_vars['URL_WSCAPAS']->value;?>
" target="_blanc">Verificar</a></label>
                            <div class="controls">
                                <input class="span11" type="text" name="nomeWSCapas" id="nomeWSCapas" value="<?php echo $_smarty_tpl->tpl_vars['URL_WSCAPAS']->value;?>
">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Configuração Empresa e Filial</h5>
                </div>
                <div class="widget-content nopadding">
                    <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['PAGINAACAO']->value;?>
" class="form-horizontal">
                        <input  type="hidden" name="pagina" id="pagina" value="<?php echo $_smarty_tpl->tpl_vars['PAGINA']->value;?>
">
                        <div class="control-group">
                            <label class="control-label">Codigo Empresa :</label>
                            <div class="controls">
                                <input class="span2" type="text" name="codEmpresa" id="codEmpresa" value="<?php echo $_smarty_tpl->tpl_vars['COD_EMPRESA']->value;?>
">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Codigo Filial :</label>
                            <div class="controls">
                                <input class="span2" type="text" name="codFilial" id="codFilial" value="<?php echo $_smarty_tpl->tpl_vars['COD_FILIAL']->value;?>
">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Configuração de Produtos</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['PAGINAACAO']->value;?>
" class="form-horizontal">
                            <input  type="hidden" name="pagina" id="pagina" value="<?php echo $_smarty_tpl->tpl_vars['PAGINA']->value;?>
">
                            <div class="control-group">
                                <label class="control-label">Tipo Caracteristica :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="codTipoCaracteristica" id="codTipoCaracteristica" value="<?php echo $_smarty_tpl->tpl_vars['COD_TIPO_CARACTERISTICA']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Caracteristica :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="codCaracteristica" id="codCaracteristica" value="<?php echo $_smarty_tpl->tpl_vars['COD_CARACTERISTICA']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Estoque Por :</label>
                                <div class="controls">
                                    <select id="estoqueEm" name="estoqueEm">
                                        <option value="quantidade">Quatidade</option>
                                        <option value="percentual">Percentual</option>        
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Estoque mínimo :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="percentualEstoqueDisponivel" id="percentualEstoqueDisponivel" value="<?php echo $_smarty_tpl->tpl_vars['QTD_MINIMA_DISPONIVEL']->value;?>
">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Configuração de Pedidos</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['PAGINAACAO']->value;?>
" class="form-horizontal">
                            <input  type="hidden" name="pagina" id="pagina" value="<?php echo $_smarty_tpl->tpl_vars['PAGINA']->value;?>
">
                            <div class="control-group">
                                <label class="control-label">Pedidos a partir de :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="qtdDiasCron" id="qtdDiasCron" value="<?php echo $_smarty_tpl->tpl_vars['QTD_DIAS_BUSCA_PEDIDO_CRON']->value;?>
"> Dias
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código status para enviar ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="nomeStatPedidoEnvErp" id="nomeStatPedidoEnvErp" value="<?php echo $_smarty_tpl->tpl_vars['COD_STATUS_ENVIO_PEDIDOS']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código método venda ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codMetodoVenda" id="codMetodoVenda" value="<?php echo $_smarty_tpl->tpl_vars['COD_METODO_VENDA_ERP']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código reponsável ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codResponsavelVenda" id="codResponsavelVenda" value="<?php echo $_smarty_tpl->tpl_vars['COD_RESPONSAVEL_ERP']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código forma pagto Boleto ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codFormaPagtoBoletoVenda" id="codFormaPagtoBoletoVenda" value="<?php echo $_smarty_tpl->tpl_vars['COD_FORMA_PAGTO_BOLETO']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código forma pagto C. Crédito ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codFormaPagtoCCredVenda" id="codFormaPagtoCCredVenda" value="<?php echo $_smarty_tpl->tpl_vars['COD_FORMA_PAGTO_CCREDIT']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código status buscar Rastreio :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="nomeStatusFaturadoBuscaNfRastreioEros" id="nomeStatusFaturadoBuscaNfRastreioEros" value="<?php echo $_smarty_tpl->tpl_vars['COD_STATUS_BUSCA_RASTREIO']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Status faturado ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="nomeStatusFaturadoBuscaNfRastreio" id="nomeStatusFaturadoBuscaNfRastreio" value="<?php echo $_smarty_tpl->tpl_vars['STATUS_FATURADO_ERP']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Status buscar de Pedidos Loja :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="nomeStatPedidoSincronizacaoERP" id="nomeStatPedidoSincronizacaoERP" value="<?php echo $_smarty_tpl->tpl_vars['COD_STATUS_SICRONIZAR']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código status Loja ao Enviar para o ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codStatusAoEnviarParaErp" id="codStatusAoEnviarParaErp" value="<?php echo $_smarty_tpl->tpl_vars['COD_STATUS_APOS_ENVIAR']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Status ERP (NOV, LEX, LFT):</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="statusERPaposEnviar" id="statusERPaposEnviar" value="<?php echo $_smarty_tpl->tpl_vars['STATUS_APOS_ENVIAR']->value;?>
">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Configuração de Transportes</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['PAGINAACAO']->value;?>
" class="form-horizontal">
                            <input  type="hidden" name="pagina" id="pagina" value="<?php echo $_smarty_tpl->tpl_vars['PAGINA']->value;?>
">
                            <div class="control-group">
                                <label class="control-label">Código PAC :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codPac" id="codPac" value="<?php echo $_smarty_tpl->tpl_vars['COD_PAC']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código SEDEX :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codSedex" id="codSedex" value="<?php echo $_smarty_tpl->tpl_vars['COD_SEDEX']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código Módico :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codImpressoModico" id="codImpressoModico" value="<?php echo $_smarty_tpl->tpl_vars['COD_MODICO']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código Outra:</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codOutra" id="codOutra" value="<?php echo $_smarty_tpl->tpl_vars['COD_OUTRA']->value;?>
">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Configuração de Clientes</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['PAGINAACAO']->value;?>
" class="form-horizontal">
                            <input  type="hidden" name="pagina" id="pagina" value="<?php echo $_smarty_tpl->tpl_vars['PAGINA']->value;?>
">
                            <div class="control-group">
                                <label class="control-label">Código tipo de Cliente ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codTipoCli" id="codTipoCli" value="<?php echo $_smarty_tpl->tpl_vars['COD_TIPO_CLI_ERP']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código tipo de Endereco ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codTipoEndCli" id="codTipoEndCli" value="<?php echo $_smarty_tpl->tpl_vars['COD_TIPO_END_ERP']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código responsável ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codRespCli" id="codRespCli" value="<?php echo $_smarty_tpl->tpl_vars['COD_RESP_ERP']->value;?>
">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nome Responsável ERP:</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="nomeRespCli" id="nomeRespCli" value="<?php echo $_smarty_tpl->tpl_vars['NOME_RESP_ERP']->value;?>
">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<?php }
}
