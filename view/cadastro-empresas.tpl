
<div class="container-fluid">
    <hr>
    
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon">
            <input type="checkbox" id="title-checkbox" name="title-checkbox" />
            </span>
            <h5>LISTA DE EMPRESAS</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><i class="icon-resize-vertical"></i></th>
                  <th>Nome</th>
                  <th>Razção Social</th>
                  <th>CNPJ</th>
                  <th>Bairro</th>
                  <th>Telefone</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                {foreach from=$EMPRESAS item=C}
                <tr>
                  <td><input type="checkbox" /></td>
                  <td>{$C.Empresa}</td>
                  <td>{$C.Razao_Social}</td>
                  <td>{$C.CNPJ}</td>
                  <td class="center">{$C.Bairro}</td>
                  <td class="center">{$C.FONE}</td>
                  <td class="center"><i class="icon-pencil"></i></td>
                </tr>
                {/foreach}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>