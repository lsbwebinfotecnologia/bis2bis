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
                  <input  type="hidden" name="pagina" id="pagina" value="configuracao-loja">
                <div class="control-group">
                    <label class="control-label">Nome Loja : </label>
                  <div class="controls">
                      <input class="span11" type="text" name="apiFastNomeLoja" id="apiFastNomeLoja" value="{$NAME_LOJA}">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Id Loja : </label>
                  <div class="controls">
                    <input class="span11" type="text" name="apiFastIdLoja" id="apiFastIdLoja" value="{$STORE_ID}">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">User Name : </label>
                  <div class="controls">
                    <input class="span11" type="text" name="apiFastUserName" id="apiFastUserName" value="{$USER_NAME}">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Password : </label>
                  <div class="controls">
                      <input class="span11" type="password" name="apiFastPass" id="apiFastPass" value="{$PASS}">
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

