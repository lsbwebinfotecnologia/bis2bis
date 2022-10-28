<?php
/* Smarty version 3.1.39, created on 2021-02-21 23:41:10
  from 'C:\xampp\htdocs\woocommerce\view\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6032e186a27471_54851651',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7a661da985ed685346d3285b75cc72dcac4fd1af' => 
    array (
      0 => 'C:\\xampp\\htdocs\\woocommerce\\view\\login.tpl',
      1 => 1582152989,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6032e186a27471_54851651 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="pt">

    <head>
        <title>Cronus - DBM</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/matrix-login.css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="loginbox"> 
            <?php if ((isset($_smarty_tpl->tpl_vars['MSG']->value))) {?>
                <div class="widget-content">
                    <div class="alert alert-error alert-block"> 
                        <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading">Erro!</h4>
                        Usuário ou Senha Incorreto!
                    </div>
                </div>
            <?php }?>
            <form method="post" class="form-vertical" action="<?php echo $_smarty_tpl->tpl_vars['PAGINA_LOGIN']->value;?>
">
                <div class="control-group normal_text"> 
                    <h3><img src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/img/logo.png" alt="Logo" /></h3>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                            <input type="text" id="usuario" name="usuario" placeholder="Usuario" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                            <input type="password" id="password" name="password" placeholder="Senha" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Esqueceu a senha?</a></span>
                    <span class="pull-right">
                        <button type="submit" class="btn btn-success" /> Login</button>
                    </span>
                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical">
                <p class="normal_text">Digite seu endereço de e-mail abaixo e nós lhe enviaremos instruções sobre como recuperar uma senha.</p>

                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                    </div>
                </div>

                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Voltar para o login</a></span>
                    <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
                </div>
            </form>
        </div>

        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/jquery.min.js"><?php echo '</script'; ?>
>  
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/matrix.login.js"><?php echo '</script'; ?>
> 
    </body>

</html>
<?php }
}
