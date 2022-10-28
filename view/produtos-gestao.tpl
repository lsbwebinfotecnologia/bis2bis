{*INCLUDE FUNCAO BANNER*}
{include file="breadcrumbs.tpl"}

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box widget-plain">
                <div class="center">
                    <ul class="stat-boxes2">
                        <li>
                            <div class="left peity_bar_neutral">
                                <span>
                                    <i class="fas fa-book" style="font-size: 30px;color: green;"></i>
                                </span>
                            </div>
                            <div class="right"> 
                                <strong style="margin: 10px;">{$TOTALITENS}</strong> <p style="font-size: 15px; color: green">Livros Cadastrados</p>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="row-fluid">
        <div class="span12">
            <form action="#" method="get">
                <h5>Opções de Pesquisas para listagem abaixo</h5>
                <div class="widget-content">
                    <div class="controls controls-row">
                        <div  class="span3">
                            <label for="dataFim">Título</label>
                            <input type="text" placeholder="Título" id="titulo" value="" name="titulo" class="span11">
                        </div>
                        <div  class="input-append span3">
                            <label for="sku">sku</label>
                            <input type="text" placeholder="ISBN" id="sku" value="" name="sku" class="span11">
                        </div>

                        {*<div class="span3">
                            <label for="status">Status</label>
                            <select id="status" name="status">
                                <option value="0">Todos</option>
                                <option value="enabled" >Habilitados</option>
                                <option value="noSend" >Não Enviados</option>
                                <option value="disabled" >Desabilitados</option>
                            </select>
                        </div>*}

                        {*<div class="span3">
                            <label for="Editora">Editora</label>
                            <select id="editora" name="editora">
                                <option value="0">Todos</option>
                                {foreach from=$EDITORAS key=k item=E}
                                    <option value="{$E.id_editora}" {if $IDEDITORA == $E.id_editora}selected=""{/if}>{$E.nome}</option>
                                {/foreach}
                            </select>
                        </div>*}
                    </div>

                    <button type="submit" class="btn btn-success">Buscar</button>
                </div>
            </form>
        </div>
    </div>


</div>



<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="pagination alternate">
                {$PAGINACAO}
            </div>
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5>Lista de produtos</h5>
                </div>
                <div class="widget-content nopadding">
                    <div id="" class="dataTables_wrapper" role="grid">

                        <table class="table table-bordered table-striped" id="">
                            <thead>
                                <tr role="row">
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 267px;">
                                        <div class="DataTables_sort_wrapper">#id-Cronus | id-ERP<span class="DataTables_sort_icon css_right ui-icon ui-icon-triangle-1-n"></span></div>
                                    </th>
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 267px;">
                                        <div class="DataTables_sort_wrapper">Imagem<span class="DataTables_sort_icon css_right ui-icon ui-icon-triangle-1-n"></span></div>
                                    </th>
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 431px;">
                                        <div class="DataTables_sort_wrapper">Plataformas<span class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span></div>
                                    </th>
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 392px;">
                                        <div class="DataTables_sort_wrapper">ISBN<span class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span></div>
                                    </th>
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 228px;">
                                        <div class="DataTables_sort_wrapper">Titulo<span class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span></div>
                                    </th>
                                    {*<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 228px;">
                                    <div class="DataTables_sort_wrapper">Status<span class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span></div>
                                    </th>*}
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 228px;">
                                        <div class="DataTables_sort_wrapper">Qtd<span class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span></div>
                                    </th>
                                    
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 228px;">
                                        <div class="DataTables_sort_wrapper">Preço<span class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span></div>
                                    </th>
                                    
                                    {*
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 228px;">
                                        <div class="DataTables_sort_wrapper">Ação<span class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span></div>
                                    </th>*}
                                </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                                {foreach from=$PRODUTOS item=$P}
                                    <tr class="gradeA odd">
                                        <td class="sorting_1"># {$P.idProduto} | {$P.COD_ITEM}</td>
                                        <td class="sorting_1"><img style="width: 100px" src="{$URL_IMAGES}/{$P.IMG}"></td>
                                        <td class=""><span class="span-mkts-products">plataforma</span></td>
                                        <td class="sorting_1">{$P.COD_BARRA_ITEM}</td>
                                        <td class="center ">{$P.NOM_ITEM}</td>
                                        {*                                        <td class="center ">{$P.status}</td>*}
                                        <td class="center ">{$P.SALDO_DISPONIVEL}</td>
                                        <td class="center ">R$ {$P.VLR_CAPA}</td>
{*                                        <td class="center "><a href="{$PAGINA_PRODUTOS}/{$P.idProduto}"><i class="fas fa-search-plus" style="font-size: 30px;color: gray;"></i></a></td>*}
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
            <div class="pagination alternate">
                {$PAGINACAO}
            </div>  
        </div>
    </div>
</div>
