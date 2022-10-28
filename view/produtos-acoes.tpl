{*INCLUDE FUNCAO BANNER*}
{include file="breadcrumbs.tpl"}


<div class="container-fluid">
    <div class="row-fluid">
        <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Ação em massa para ativar ou desativar Produtos Skyhub</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="{$PAGINAACTIONPRODUTOS}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">Opções</label>
                            <div class="controls">
                                <label>
                                    <div class="radio" id="uniform-undefined">
                                        <span>
                                            <input type="radio" name="statusSkyhub" id="statusSkyhub" value="enabled" required="" style="opacity: 0;">
                                        </span>
                                    </div>
                                    Ativar
                                </label>
                                <label>
                                    <div class="radio" id="uniform-undefined">
                                        <span>
                                            <input type="radio" name="statusSkyhub" required="" id="statusSkyhub" value="disabled" style="opacity: 0;">
                                        </span>
                                    </div>
                                    Desativar
                                </label>
                            </div>
                        </div>                        
                        <div class="control-group">
                            <label class="control-label">Selecione a planilha</label>
                            <div class="controls">
                                <div class="uploader" id="uniform-undefined">
                                    <input name="file" type="file" required=""/>
                                    <span class="filename">Nenhum arquivo</span><span class="action">Selecione</span></div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <a class="btn btn-inverse btn-mini" href="{$PAGINA_MODELO_PRODUTO_HABILITAR}">Download Modelo Habilitar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="span6">
            
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Ação em massa para Atualizar Preços </h5> 
                </div>
                <div class="widget-content nopadding">
                    <form action="{$PAGINAACTIONPRECOS}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">Selecione o arquivo</label>
                            <div class="controls">
                                <input name="file" type="file" required=""/>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Importar (.XLSX)</button>
                            <a class="btn btn-inverse btn-mini" href="{$PAGINA_MODELO_PRECO}">Download Modelo Preço</a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    {*<div class="row-fluid">
        <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Ação em massa para Atualizar Metadados dos Produtos</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="#" method="get" class="form-horizontal">

                        <div class="control-group">
                            <label class="control-label">Selecione a planilha</label>
                            <div class="controls">
                                <div class="uploader" id="uniform-undefined">
                                    <input type="file" size="19" style="opacity: 0;" required="">
                                    <span class="filename">Nenhum arquivo</span><span class="action">Selecione</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>*}
</div>

