<div id="content-header">
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
                    <form method="post" action="{$PAGINAACAO}" class="form-horizontal">
                        <input  type="hidden" name="pagina" id="pagina" value="{$PAGINA}">
                        <div class="control-group">
                            <label class="control-label">WS de Produtos : <a class="btn-mini btn-info" href="{$URL_WSPRODUCTS}" target="_blanc">Verificar</a></label>
                            <div class="controls">
                                <input class="span11" type="text" name="nomeWSProdutos" id="nomeWSProdutos" value="{$URL_WSPRODUCTS}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">WS de Clientes : <a class=" btn-mini btn-info" href="{$URL_WSCLIENTS}" target="_blanc">Verificar</a></label>
                            <div class="controls">
                                <input class="span11" type="text" name="nomeWSClientes" id="nomeWSClientes" value="{$URL_WSCLIENTS}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">WS de Pedidos : <a class=" btn-mini btn-info" href="{$URL_WSORDERS}" target="_blanc">Verificar</a></label>
                            <div class="controls">
                                <input class="span11" type="text" name="nomeWSPedidos" id="nomeWSPedidos" value="{$URL_WSORDERS}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">WS das Capas : <a class=" btn-mini btn-info" href="{$URL_WSCAPAS}" target="_blanc">Verificar</a></label>
                            <div class="controls">
                                <input class="span11" type="text" name="nomeWSCapas" id="nomeWSCapas" value="{$URL_WSCAPAS}">
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
                    <form method="post" action="{$PAGINAACAO}" class="form-horizontal">
                        <input  type="hidden" name="pagina" id="pagina" value="{$PAGINA}">
                        <div class="control-group">
                            <label class="control-label">Codigo Empresa :</label>
                            <div class="controls">
                                <input class="span2" type="text" name="codEmpresa" id="codEmpresa" value="{$COD_EMPRESA}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Codigo Filial :</label>
                            <div class="controls">
                                <input class="span2" type="text" name="codFilial" id="codFilial" value="{$COD_FILIAL}">
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
                        <form method="post" action="{$PAGINAACAO}" class="form-horizontal">
                            <input  type="hidden" name="pagina" id="pagina" value="{$PAGINA}">
                            <div class="control-group">
                                <label class="control-label">Tipo Caracteristica :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="codTipoCaracteristica" id="codTipoCaracteristica" value="{$COD_TIPO_CARACTERISTICA}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Caracteristica :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="codCaracteristica" id="codCaracteristica" value="{$COD_CARACTERISTICA}">
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
                                    <input class="span2" type="number" name="percentualEstoqueDisponivel" id="percentualEstoqueDisponivel" value="{$QTD_MINIMA_DISPONIVEL}">
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
                        <form method="post" action="{$PAGINAACAO}" class="form-horizontal">
                            <input  type="hidden" name="pagina" id="pagina" value="{$PAGINA}">
                            <div class="control-group">
                                <label class="control-label">Pedidos a partir de :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="qtdDiasCron" id="qtdDiasCron" value="{$QTD_DIAS_BUSCA_PEDIDO_CRON}"> Dias
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código status para enviar ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="nomeStatPedidoEnvErp" id="nomeStatPedidoEnvErp" value="{$COD_STATUS_ENVIO_PEDIDOS}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código método venda ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codMetodoVenda" id="codMetodoVenda" value="{$COD_METODO_VENDA_ERP}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código reponsável ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codResponsavelVenda" id="codResponsavelVenda" value="{$COD_RESPONSAVEL_ERP}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código forma pagto Boleto ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codFormaPagtoBoletoVenda" id="codFormaPagtoBoletoVenda" value="{$COD_FORMA_PAGTO_BOLETO}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código forma pagto C. Crédito ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codFormaPagtoCCredVenda" id="codFormaPagtoCCredVenda" value="{$COD_FORMA_PAGTO_CCREDIT}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código status buscar Rastreio :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="nomeStatusFaturadoBuscaNfRastreioEros" id="nomeStatusFaturadoBuscaNfRastreioEros" value="{$COD_STATUS_BUSCA_RASTREIO}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Status faturado ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="nomeStatusFaturadoBuscaNfRastreio" id="nomeStatusFaturadoBuscaNfRastreio" value="{$STATUS_FATURADO_ERP}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Status buscar de Pedidos Loja :</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="nomeStatPedidoSincronizacaoERP" id="nomeStatPedidoSincronizacaoERP" value="{$COD_STATUS_SICRONIZAR}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código status Loja ao Enviar para o ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codStatusAoEnviarParaErp" id="codStatusAoEnviarParaErp" value="{$COD_STATUS_APOS_ENVIAR}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Status ERP (NOV, LEX, LFT):</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="statusERPaposEnviar" id="statusERPaposEnviar" value="{$STATUS_APOS_ENVIAR}">
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
                        <form method="post" action="{$PAGINAACAO}" class="form-horizontal">
                            <input  type="hidden" name="pagina" id="pagina" value="{$PAGINA}">
                            <div class="control-group">
                                <label class="control-label">Código PAC :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codPac" id="codPac" value="{$COD_PAC}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código SEDEX :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codSedex" id="codSedex" value="{$COD_SEDEX}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código Módico :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codImpressoModico" id="codImpressoModico" value="{$COD_MODICO}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código Outra:</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codOutra" id="codOutra" value="{$COD_OUTRA}">
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
                        <form method="post" action="{$PAGINAACAO}" class="form-horizontal">
                            <input  type="hidden" name="pagina" id="pagina" value="{$PAGINA}">
                            <div class="control-group">
                                <label class="control-label">Código tipo de Cliente ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codTipoCli" id="codTipoCli" value="{$COD_TIPO_CLI_ERP}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código tipo de Endereco ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codTipoEndCli" id="codTipoEndCli" value="{$COD_TIPO_END_ERP}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código responsável ERP :</label>
                                <div class="controls">
                                    <input class="span2" type="number" name="codRespCli" id="codRespCli" value="{$COD_RESP_ERP}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nome Responsável ERP:</label>
                                <div class="controls">
                                    <input class="span2" type="text" name="nomeRespCli" id="nomeRespCli" value="{$NOME_RESP_ERP}">
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
