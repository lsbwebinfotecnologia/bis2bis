<?php
/* Smarty version 3.1.39, created on 2021-04-12 23:25:47
  from 'C:\xampp\htdocs\bis2bis\view\produtos-gestao.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6074badbcc4345_72936856',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5322e7e247981cbbd6b0b90c4377baf0a4664691' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bis2bis\\view\\produtos-gestao.tpl',
      1 => 1618262743,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:breadcrumbs.tpl' => 1,
  ),
),false)) {
function content_6074badbcc4345_72936856 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:breadcrumbs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box widget-plain">
                <div class="center">
                    <ul class="stat-boxes2">
                        <li>
                            <div class="left peity_bar_neutral">
                                <span>
                                    <i class="fas fa-book" style="font-size: 30px;color: green;"></i>
                                </span>
                            </div>
                            <div class="right"> 
                                <strong style="margin: 10px;"><?php echo $_smarty_tpl->tpl_vars['TOTALITENS']->value;?>
</strong> <p style="font-size: 15px; color: green">Livros Cadastrados</p>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="row-fluid">
        <div class="span12">
            <form action="#" method="get">
                <h5>Opções de Pesquisas para listagem abaixo</h5>
                <div class="widget-content">
                    <div class="controls controls-row">
                        <div  class="span3">
                            <label for="dataFim">Título</label>
                            <input type="text" placeholder="Título" id="titulo" value="" name="titulo" class="span11">
                        </div>
                        <div  class="input-append span3">
                            <label for="sku">sku</label>
                            <input type="text" placeholder="ISBN" id="sku" value="" name="sku" class="span11">
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
            <div class="pagination alternate">
                <?php echo $_smarty_tpl->tpl_vars['PAGINACAO']->value;?>

            </div>
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5>Lista de produtos</h5>
                </div>
                <div class="widget-content nopadding">
                    <div id="" class="dataTables_wrapper" role="grid">

                        <table class="table table-bordered table-striped" id="">
                            <thead>
                                <tr role="row">
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 267px;">
                                        <div class="DataTables_sort_wrapper">#id-Cronus | id-ERP<span class="DataTables_sort_icon css_right ui-icon ui-icon-triangle-1-n"></span></div>
                                    </th>
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 267px;">
                                        <div class="DataTables_sort_wrapper">Imagem<span class="DataTables_sort_icon css_right ui-icon ui-icon-triangle-1-n"></span></div>
                                    </th>
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 431px;">
                                        <div class="DataTables_sort_wrapper">Plataformas<span class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span></div>
                                    </th>
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 392px;">
                                        <div class="DataTables_sort_wrapper">ISBN<span class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span></div>
                                    </th>
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 228px;">
                                        <div class="DataTables_sort_wrapper">Titulo<span class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span></div>
                                    </th>
                                                                        <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 228px;">
                                        <div class="DataTables_sort_wrapper">Qtd<span class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span></div>
                                    </th>
                                    
                                    <th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 228px;">
                                        <div class="DataTables_sort_wrapper">Preço<span class="DataTables_sort_icon css_right ui-icon ui-icon-carat-2-n-s"></span></div>
                                    </th>
                                    
                                                                    </tr>
                            </thead>

                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['PRODUTOS']->value, 'P');
$_smarty_tpl->tpl_vars['P']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['P']->value) {
$_smarty_tpl->tpl_vars['P']->do_else = false;
?>
                                    <tr class="gradeA odd">
                                        <td class="sorting_1"># <?php echo $_smarty_tpl->tpl_vars['P']->value['idProduto'];?>
 | <?php echo $_smarty_tpl->tpl_vars['P']->value['COD_ITEM'];?>
</td>
                                        <td class="sorting_1"><img style="width: 100px" src="<?php echo $_smarty_tpl->tpl_vars['URL_IMAGES']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['P']->value['IMG'];?>
"></td>
                                        <td class=""><span class="span-mkts-products">plataforma</span></td>
                                        <td class="sorting_1"><?php echo $_smarty_tpl->tpl_vars['P']->value['COD_BARRA_ITEM'];?>
</td>
                                        <td class="center "><?php echo $_smarty_tpl->tpl_vars['P']->value['NOM_ITEM'];?>
</td>
                                                                                <td class="center "><?php echo $_smarty_tpl->tpl_vars['P']->value['SALDO_DISPONIVEL'];?>
</td>
                                        <td class="center ">R$ <?php echo $_smarty_tpl->tpl_vars['P']->value['VLR_CAPA'];?>
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
            <div class="pagination alternate">
                <?php echo $_smarty_tpl->tpl_vars['PAGINACAO']->value;?>

            </div>  
        </div>
    </div>
</div>
<?php }
}
