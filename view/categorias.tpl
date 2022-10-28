{*INCLUDE FUNCAO BANNER*}
{include file="breadcrumbs.tpl"}

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> 
                    <h5>Nova Categoria</h5>
                </div>
            </div>
            <div class="widget-content nopadding">
                <form action="#" method="POST" class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Nome da Categoria:</label>
                        <div class="controls">
                            <input type="text" class="span11" placeholder="Nome da categoria" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">ID ERP:</label>
                        <div class="controls">
                            <input type="text" class="span11" placeholder="ID ERP" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Status Skyhub</label>
                        <div class="controls">
                            <select id="status" name="status" class="span3">
                                <option value="1">Ativo</option>
                                <option value="0">Desativado</option>
                            </select>
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

            <form>
                <div class="widget-content">
                    <h5>Opções de pesquisas</h5>
                    <div class="controls controls-row">
                        <input type="text" placeholder="Nome Categoria" class="span3 m-wrap">
                        <input type="text" placeholder="Id Cronus" class="span3 m-wrap">
                        <input type="text" placeholder="Id ERP" class="span3 m-wrap">
                        <input type="text" placeholder="Status" class="span3 m-wrap">
                    </div>

                    <button class="btn btn-success btn-large">Buscar</button>
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
                                <th>Id ERP</th>
                                <th>Data de atualização</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$CATEGORIAS item=C}
                                <tr class="odd gradeX">
                                    <td>{$C.id_cat}</td>
                                    <td>{$C.nome}</td>
                                    <td>{$C.id_categoria_externo}</td>
                                    <td class="center">{$C.data_atualizacao}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

