<div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>Configurações ERP x Loja</h1>
</div>
<div class="container-fluid"><hr>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Configurações dos API</h5>
                </div>
                <div class="widget-content nopadding">
                    <form method="post" action="configuracoes-dados" class="form-horizontal">
                        <input  type="hidden" name="pagina" id="pagina" value="configuracao-erp-api">
                        <div class="control-group">
                            <label class="control-label">URL EndPoint : </label>
                            <div class="controls">
                                <input class="span11" type="text" name="url" id="url" value="{if isset($DADOSAPI.url)}{$DADOSAPI.url}{/if}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Porta : </label>
                            <div class="controls">
                                <input class="span11" type="number" name="porta" id="porta" value="{if isset($DADOSAPI.porta)}{$DADOSAPI.porta}{/if}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Usuário : </label>
                            <div class="controls">
                                <input class="span11" type="text" name="usuario" id="usuario" value="{if isset($DADOSAPI.usuario)}{$DADOSAPI.usuario}{/if}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Senha : </label>
                            <div class="controls">
                                <input class="span11" type="password" name="senha" id="senha" value="{if isset($DADOSAPI.senha)}{$DADOSAPI.senha}{/if}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Código Tipo Caracteristica ERP: </label>
                            <div class="controls">
                                <input class="span11" type="number" name="codTipoCaracteristica" id="codTipoCaracteristica" value="{if isset($DADOSAPI.codTipoCaracteristica)}{$DADOSAPI.codTipoCaracteristica}{/if}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Código Caracteristica ERP : </label>
                            <div class="controls">
                                <input class="span11" type="number" name="codCaracteristica" id="codCaracteristica" value="{if isset($DADOSAPI.codCaracteristica)}{$DADOSAPI.codCaracteristica}{/if}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Código Local Estoque: </label>
                            <div class="controls">
                                <input class="span11" type="number" name="codLocalEstoque" id="codLocalEstoque" value="{if isset($DADOSAPI.codLocalEstoque)}{$DADOSAPI.codLocalEstoque}{/if}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Código Empresa: </label>
                            <div class="controls">
                                <input class="span11" type="number" name="codEmpresa" id="codEmpresa" value="{if isset($DADOSAPI.codEmpresa)}{$DADOSAPI.codEmpresa}{/if}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Código Filial </label>
                            <div class="controls">
                                <input class="span11" type="number" name="codFilial" id="codFilial" value="{if isset($DADOSAPI.codFilial)}{$DADOSAPI.codFilial}{/if}">
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
