<?php
/* Smarty version 3.1.39, created on 2021-03-23 04:36:34
  from 'C:\xampp\htdocs\bis2bis\view\breadcrumbs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6059624298b456_63314342',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae164d38c5b4cbf859133bf8990c35cfde6c0dd7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bis2bis\\view\\breadcrumbs.tpl',
      1 => 1580742032,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6059624298b456_63314342 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="content-header">
    <div id="breadcrumb"> 
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['BREADCRUMBS']->value, 'B', false, 'K');
$_smarty_tpl->tpl_vars['B']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['K']->value => $_smarty_tpl->tpl_vars['B']->value) {
$_smarty_tpl->tpl_vars['B']->do_else = false;
?> 
            <a href="<?php echo $_smarty_tpl->tpl_vars['B']->value;?>
" class="tip-bottom" data-original-title="Vá para <?php echo $_smarty_tpl->tpl_vars['K']->value;?>
"><i class="icon-home"></i> <?php echo $_smarty_tpl->tpl_vars['K']->value;?>
</a> 
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        
        <?php if ((isset($_smarty_tpl->tpl_vars['PAGE']->value))) {?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['PAGE']->value['link'];?>
" class="current"><?php echo $_smarty_tpl->tpl_vars['PAGE']->value['title'];?>
</a>
        <?php }?>

</div>
<?php }
}
