{*INCLUDE FUNCAO BANNER*}
{include file="breadcrumbs.tpl"}


<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <form action="{$PAGINA}" method="post">
                <input type="hidden" name="id_loja" id="id_loja" value="{$IDLOJA}">
                <h5>Opções</h5>
                <div class="widget-content">
                    <div class="controls controls-row">
                        <div  class="span2">
                            <label for="tipoIntegracao">Tipo de integracao</label>
                            <input placeholder="Tipo" type="text" value="" class="span11" name="tipoIntegracao" id="tipoIntegracao">
                        </div>
                        <div  class="input-append span3">
                            <label for="dataIni">Ordem</label>
                            <input placeholder="Ordem" type="number"  value="" class="span9 date" name="ordem" id="ordem">
                        </div>
                        <div  class="input-append span3">
                            <label for="dataFim">Valor</label>
                            <input placeholder="Valor" type="text" value="" class="span9 date" name="valor" id="valor">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Inserir</button>
                </div>
            </form>
        </div>
    </div>
</div>
