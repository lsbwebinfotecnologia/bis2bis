<?php
/* Smarty version 3.1.39, created on 2021-02-19 20:41:48
  from 'C:\xampp\htdocs\woocommerce\view\integradores-loja.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6030147c2e3193_78508036',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e520fa2f2c9d2349faf0a87d77dac7cc92d819d9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\woocommerce\\view\\integradores-loja.tpl',
      1 => 1603040384,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6030147c2e3193_78508036 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>Integradores Loja</h1>
</div>

<div class="container-fluid">
    <hr>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>Opções de Integrações Loja</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Loja Integrador</th>
                                <th>Data Ultima Sincronização</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['INTEGRADORES']->value, 'I');
$_smarty_tpl->tpl_vars['I']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['I']->value) {
$_smarty_tpl->tpl_vars['I']->do_else = false;
?>
                                <tr class="odd gradeX">
                                    <td style="text-align: center !important;">
                                        <button type="button" onclick="location.href = '<?php echo $_smarty_tpl->tpl_vars['URL']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['I']->value['tipo_sicronizacao'];?>
?front=yes';" style="width: 50%;" class="btn btn-primary btn-sm">
                                            <?php echo $_smarty_tpl->tpl_vars['I']->value['slogan'];?>

                                        </button>
                                    </td>
                                    <td style="text-align: center !important;"><?php echo $_smarty_tpl->tpl_vars['I']->value['data_sicronizacao'];?>
</td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }
}
