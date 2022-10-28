{*INCLUDE FUNCAO BANNER*}
{include file="breadcrumbs.tpl"}

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <p>
                <a class="btn btn-info" href="{$PAGINASTATUSPEDIDO}/new">Novo status <i class="fas fa-plus"></i></a>
            </p>

        </div>
    </div>
    {*SE A ACAO É APENAS PARA LISTAR OS STATUS*}
    {if !$EDITION}
        <div class="row-fluid">
            <div class="span12">
                <form>
                    <div class="widget-content">
                        <h5>Opções de pesquisas</h5>
                        <div class="controls controls-row">
                            <input type="text" placeholder="Nome status" class="span3 m-wrap">
                        </div>
                        <button class="btn btn-success btn-large">Buscar <i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>Lista de Categorias</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Cor</th>
                                    <th>Tipo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$STATUSPEDIDO item=S}
                                    <tr class="odd gradeX">
                                        <td>{$S.id_status}</td>
                                        <td>{$S.nome}</td>
                                        <td>{$S.color}</td>
                                        <td>{$S.tipo}</td>
                                        <td><a href="{$PAGINASTATUSPEDIDO}/update/{$S.id_status}"><i class="far fa-edit" style="font-size: 20px;"></i></a></td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    {else}
        <div class="row-fluid">
            <div class="span8">

                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Cadastrar novo status</h5>
                    </div>
                </div>
                <div class="widget-content nopadding">
                    <form action="{$PAGINAACTIONSTATUS}" method="post" class="form-horizontal">
                        <input type="hidden" id="action" name="action" value="{$ACTION}" />
                        {if isset($STATUSDADOS)}
                            <input type="hidden" id="id" name="id" value="{$STATUSDADOS.id_status}" />
                        {/if}
                        
                        <div class="control-group">
                            <label class="control-label">Nome do status:</label>
                            <div class="controls">
                                {if isset($STATUSDADOS)}
                                    <input type="text" class="span11" id="nome" name="nome" placeholder="Nome do status" value="{$STATUSDADOS.nome}" />
                                {else}
                                    <input type="text" class="span11" id="nome" name="nome" placeholder="Nome do status" value="" />
                                {/if}
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Cor:</label>
                            <div class="controls">
                                <div data-color-format="hex" data-color="#000000" class="input-append color colorpicker">
                                    {if isset($STATUSDADOS)}
                                        <input type="text" value="{$STATUSDADOS.color}" id="color" name="color" class="span11">
                                    {else}
                                        <input type="text" value="#000000" id="color" name="color" class="span11">
                                    {/if}
                                    
                                    <span class="add-on"><i style="background-color: #000000"></i></span> 
                                </div>
                            </div>
                        </div>


                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    {/if}
</div>

