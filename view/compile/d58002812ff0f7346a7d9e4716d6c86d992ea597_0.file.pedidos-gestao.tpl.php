<?php
/* Smarty version 3.1.39, created on 2021-06-13 23:37:45
  from 'C:\xampp\htdocs\bis2bis\view\pedidos-gestao.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c67aa9a1f0d6_06105481',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd58002812ff0f7346a7d9e4716d6c86d992ea597' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bis2bis\\view\\pedidos-gestao.tpl',
      1 => 1614249368,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:breadcrumbs.tpl' => 1,
  ),
),false)) {
function content_60c67aa9a1f0d6_06105481 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:breadcrumbs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="container-fluid">
    
    <div class="row-fluid">
        <div class="span12">
            <form action="<?php echo $_smarty_tpl->tpl_vars['PAGINA_GESTAO_PEDIDO']->value;?>
" method="get">
                <h5>Opções de Pesquisas</h5>
                <div class="widget-content">
                    <div class="controls controls-row">
                        <div  class="span2">
                            <label for="dataFim">Pedido Cronus</label>
                            <input placeholder="Pedido Cronus" type="text" value="<?php echo $_smarty_tpl->tpl_vars['DATAFILTER']->value['v_id'];?>
" class="span11" name="v_id" id="v_id">
                        </div>
                        <div  class="input-append span3">
                            <label for="dataIni">Data Inicio</label>
                            <span class="add-on"><i class="fas fa-calendar-alt"></i></span> 
                            <input placeholder="Data Inicio" type="date"  value="<?php echo $_smarty_tpl->tpl_vars['DATAFILTER']->value['dataIni'];?>
" class="span9 date" name="dataIni" id="dataIni">
                        </div>
                        <div  class="input-append span3">
                            <label for="dataFim">Data Fim</label>
                            <span class="add-on"><i class="fas fa-calendar-alt"></i></span> 
                            <input placeholder="Data Fim" type="date" value="<?php echo $_smarty_tpl->tpl_vars['DATAFILTER']->value['dataFim'];?>
" class="span9 date" name="dataFim" id="dataFim">
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
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PEDIDOS']->value, 'P');
$_smarty_tpl->tpl_vars['P']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['P']->value) {
$_smarty_tpl->tpl_vars['P']->do_else = false;
?>
                                <tr class="odd gradeX">
                                    <td>
                                        <?php echo $_smarty_tpl->tpl_vars['P']->value['v_id'];?>
<br>
                                        <?php echo $_smarty_tpl->tpl_vars['P']->value['id_pedido_loja'];?>
<br>
                                        <?php echo $_smarty_tpl->tpl_vars['P']->value['cod_pedido_erp'];?>

                                    </td>
                                    <td>
                                        <?php echo $_smarty_tpl->tpl_vars['P']->value['nome'];?>
 <br>
                                        <?php echo $_smarty_tpl->tpl_vars['P']->value['email'];?>

                                    </td>
                                    <td>
                                        <?php echo $_smarty_tpl->tpl_vars['P']->value['cpf'];?>
 | <?php echo $_smarty_tpl->tpl_vars['P']->value['cnpj'];?>

                                    </td>
                                    <td>
                                        R$ <?php echo $_smarty_tpl->tpl_vars['P']->value['total'];?>

                                    </td>
                                    
                                    <td><?php echo $_smarty_tpl->tpl_vars['P']->value['freteMode'];?>
</td>
                                    <td class="center"> ERP: <?php echo $_smarty_tpl->tpl_vars['P']->value['id_status_prod'];?>
</td>
                                    <td class="center"> WC: <?php echo $_smarty_tpl->tpl_vars['P']->value['status'];?>
</td>
                                    <td class="center">
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
</div><?php }
}
