<?php
/* Smarty version 3.1.39, created on 2021-04-18 01:37:25
  from 'C:\xampp\htdocs\bis2bis\view\fila-integracao.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_607b7135d073e4_77284738',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5ccd4f5325db3c27c54c4de4d37ab7ea5f569c67' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bis2bis\\view\\fila-integracao.tpl',
      1 => 1618702643,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:breadcrumbs.tpl' => 1,
  ),
),false)) {
function content_607b7135d073e4_77284738 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:breadcrumbs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <form action="<?php echo $_smarty_tpl->tpl_vars['PAGINA']->value;?>
" method="post">
                <input type="hidden" name="id_loja" id="id_loja" value="<?php echo $_smarty_tpl->tpl_vars['IDLOJA']->value;?>
">
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
<?php }
}
