{*INCLUDE FUNCAO BANNER*}
{include file="breadcrumbs.tpl"}


<div class="container-fluid">
    
    <div class="row-fluid">
        <div class="span12">
            <form action="{$PAGINA_GESTAO_PEDIDO}" method="get">
                <h5>Opções de Pesquisas</h5>
                <div class="widget-content">
                    <div class="controls controls-row">
                        <div  class="span2">
                            <label for="dataFim">Pedido Cronus</label>
                            <input placeholder="Pedido Cronus" type="text" value="{$DATAFILTER.v_id}" class="span11" name="v_id" id="v_id">
                        </div>
                        <div  class="input-append span3">
                            <label for="dataIni">Data Inicio</label>
                            <span class="add-on"><i class="fas fa-calendar-alt"></i></span> 
                            <input placeholder="Data Inicio" type="date"  value="{$DATAFILTER.dataIni}" class="span9 date" name="dataIni" id="dataIni">
                        </div>
                        <div  class="input-append span3">
                            <label for="dataFim">Data Fim</label>
                            <span class="add-on"><i class="fas fa-calendar-alt"></i></span> 
                            <input placeholder="Data Fim" type="date" value="{$DATAFILTER.dataFim}" class="span9 date" name="dataFim" id="dataFim">
                        </div>
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
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>Lista de Pedidos</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table dataTable" id="DataTables_Table_0">
                        <thead>
                            <tr>
                                <th>
                                    <span>
                                        ID CRONUZ<br>
                                        ID LOJA<br>
                                        ID ERP
                                    </span>
                                </th>
                                <th><span>Cliente | E-mail</span></th>
                                <th><span>CPF | CNPJ</span></th>
                                <th><span>Total</span></th>
                                <th><span>Tipo Frete</span></th>
                                <th>Status ERP</th>
                                <th>Acompanhamento WC</th>
                                <th><span>Opções</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$PEDIDOS item=P}
                                <tr class="odd gradeX">
                                    <td>
                                        {$P.v_id}<br>
                                        {$P.id_pedido_loja}<br>
                                        {$P.cod_pedido_erp}
                                    </td>
                                    <td>
                                        {$P.nome} <br>
                                        {$P.email}
                                    </td>
                                    <td>
                                        {$P.cpf} | {$P.cnpj}
                                    </td>
                                    <td>
                                        R$ {$P.total}
                                    </td>
                                    
                                    <td>{$P.freteMode}</td>
                                    <td class="center"> ERP: {$P.id_status_prod}</td>
                                    <td class="center"> WC: {$P.status}</td>
                                    <td class="center">
{*                                        <a href="{$ACTION_SKYHUB_PEDIDOS}?action=deleteFilaPedido&idOrder={$P.id_ped_skyhub}"><i class="far fa-calendar-times" style="font-size: 20px; color: red"></i></a>*}
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>