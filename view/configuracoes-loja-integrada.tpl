<div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>Configurações API</h1>
</div>
<div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Configurações LOJA</h5>
            </div>
            <div class="widget-content nopadding">
              <form method="post" action="configuracoes-dados" class="form-horizontal">
                  <input  type="hidden" name="pagina" id="pagina" value="configuracao-loja-integrada">
                <div class="control-group">
                    <label class="control-label">Chave API: </label>
                  <div class="controls">
                      <input class="span11" type="text" name="chaveApi" id="chaveApi" value="{if isset($DADOSLOJAINTEGRADA.chaveApi)}{$DADOSLOJAINTEGRADA.chaveApi}{/if}">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Chave APP : </label>
                  <div class="controls">
                    <input class="span11" type="text" name="chaveApp" id="chaveApp" value="{if isset($DADOSLOJAINTEGRADA.chaveApp)}{$DADOSLOJAINTEGRADA.chaveApp}{/if}">
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

