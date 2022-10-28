<?php
/* Smarty version 3.1.39, created on 2021-03-23 04:36:37
  from 'C:\xampp\htdocs\bis2bis\view\configuracoes-erp.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_605962458f3968_46056224',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '682132f3e7cef616ae8655c6cdd6fdd96e09e2c9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bis2bis\\view\\configuracoes-erp.tpl',
      1 => 1606353777,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_605962458f3968_46056224 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>Configurações ERP x Loja</h1>
</div>
<div class="container-fluid"><hr>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Configurações dos API</h5>
                </div>
                <div class="widget-content nopadding">
                    <form method="post" action="configuracoes-dados" class="form-horizontal">
                        <input  type="hidden" name="pagina" id="pagina" value="configuracao-erp-api">
                        <div class="control-group">
                            <label class="control-label">URL EndPoint : </label>
                            <div class="controls">
                                <input class="span11" type="text" name="url" id="url" value="<?php if ((isset($_smarty_tpl->tpl_vars['DADOSAPI']->value['url']))) {
echo $_smarty_tpl->tpl_vars['DADOSAPI']->value['url'];
}?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Porta : </label>
                            <div class="controls">
                                <input class="span11" type="number" name="porta" id="porta" value="<?php if ((isset($_smarty_tpl->tpl_vars['DADOSAPI']->value['porta']))) {
echo $_smarty_tpl->tpl_vars['DADOSAPI']->value['porta'];
}?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Usuário : </label>
                            <div class="controls">
                                <input class="span11" type="text" name="usuario" id="usuario" value="<?php if ((isset($_smarty_tpl->tpl_vars['DADOSAPI']->value['usuario']))) {
echo $_smarty_tpl->tpl_vars['DADOSAPI']->value['usuario'];
}?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Senha : </label>
                            <div class="controls">
                                <input class="span11" type="password" name="senha" id="senha" value="<?php if ((isset($_smarty_tpl->tpl_vars['DADOSAPI']->value['senha']))) {
echo $_smarty_tpl->tpl_vars['DADOSAPI']->value['senha'];
}?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Código Tipo Caracteristica ERP: </label>
                            <div class="controls">
                                <input class="span11" type="number" name="codTipoCaracteristica" id="codTipoCaracteristica" value="<?php if ((isset($_smarty_tpl->tpl_vars['DADOSAPI']->value['codTipoCaracteristica']))) {
echo $_smarty_tpl->tpl_vars['DADOSAPI']->value['codTipoCaracteristica'];
}?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Código Caracteristica ERP : </label>
                            <div class="controls">
                                <input class="span11" type="number" name="codCaracteristica" id="codCaracteristica" value="<?php if ((isset($_smarty_tpl->tpl_vars['DADOSAPI']->value['codCaracteristica']))) {
echo $_smarty_tpl->tpl_vars['DADOSAPI']->value['codCaracteristica'];
}?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Código Local Estoque: </label>
                            <div class="controls">
                                <input class="span11" type="number" name="codLocalEstoque" id="codLocalEstoque" value="<?php if ((isset($_smarty_tpl->tpl_vars['DADOSAPI']->value['codLocalEstoque']))) {
echo $_smarty_tpl->tpl_vars['DADOSAPI']->value['codLocalEstoque'];
}?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Código Empresa: </label>
                            <div class="controls">
                                <input class="span11" type="number" name="codEmpresa" id="codEmpresa" value="<?php if ((isset($_smarty_tpl->tpl_vars['DADOSAPI']->value['codEmpresa']))) {
echo $_smarty_tpl->tpl_vars['DADOSAPI']->value['codEmpresa'];
}?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Código Filial </label>
                            <div class="controls">
                                <input class="span11" type="number" name="codFilial" id="codFilial" value="<?php if ((isset($_smarty_tpl->tpl_vars['DADOSAPI']->value['codFilial']))) {
echo $_smarty_tpl->tpl_vars['DADOSAPI']->value['codFilial'];
}?>">
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
<?php }
}
