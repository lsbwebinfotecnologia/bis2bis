<div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>Integradores ERP</h1>
</div>

<div class="container-fluid">
    <hr>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>Opções de Integrações ERP</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ERP Integrador</th>
                                <th>Data Ultima Sincronização</th>

                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$INTEGRADORES item=I}
                                <tr class="odd gradeX">
                                    <td style="text-align: center !important;">
                                        <button type="button" onclick="location.href = '{$URL}/{$I.tipo_sicronizacao}?front=yes';" style="width: 50%;" class="btn btn-primary btn-sm">
                                            {$I.slogan}
                                        </button>
                                    </td>
                                    <td style="text-align: center !important;">{$I.data_sicronizacao}</td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
