<?php
/* Smarty version 3.1.39, created on 2021-02-22 03:15:20
  from 'C:\xampp\htdocs\woocommerce\view\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_603313b84ef2d4_11898334',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8e5181bcda0ce42217d5edcb97d97cd0f0345518' => 
    array (
      0 => 'C:\\xampp\\htdocs\\woocommerce\\view\\index.tpl',
      1 => 1613960118,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603313b84ef2d4_11898334 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <head>
        <title>Cronuz Admin</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/fullcalendar.css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/matrix-style.css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/matrix-media.css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/colorpicker.css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/datepicker.css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/uniform.css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/select2.css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/style.css" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/css/bootstrap-wysihtml5.css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <?php echo '<script'; ?>
 src="https://kit.fontawesome.com/0c8ce7b7d2.js" crossorigin="anonymous"><?php echo '</script'; ?>
>         <link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['DIR_FRONT']->value;?>
/tema/img/favicon.png"/>
        
    </head>
    <body>

        <!--Header-part-->
        <div id="header">
            <h1><a href="dashboard">Cronuz Admin</a></h1>
        </div>
        <!--close-Header-part--> 

        <!--top-Header-menu-->
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav" style="width: auto; margin: 0px;">
                <li class="dropdown" id="profile-messages"><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Usuários</span><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="icon-user"></i> Usuarios</a></li>
                        <li class="divider"></li>
                        <li><a href="configuracoes-erp"><i class="icon-check"></i> Configurações</a></li>
                        <li class="divider"></li>
                        <li><a href=""><i class="icon-key"></i> Log Out</a></li>
                    </ul>
                </li>
                <li class=""><a title="" href="<?php echo $_smarty_tpl->tpl_vars['URL_HOME']->value;?>
/configuracoes-erp"><i class="icon icon-cog"></i> <span class="text">Configurações</span></a></li>
                <li class=""><a title="" href="<?php echo $_smarty_tpl->tpl_vars['LOGOFF']->value;?>
"><i class="icon icon-share-alt"></i> <span class="text">Sair</span></a></li>
            </ul>
        </div>
        <!--close-top-Header-menu-->


        <!--start-top-serch-->
        <div id="search">

        </div>
        <!--close-top-serch-->
        <!--sidebar-menu-->
        <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
            <ul>
                <li class="submenu"> <a href="#"><i class="fas fa-book" style="color: white"></i> <span>Produtos</span> <span class="label label-important">2</span></a>
                    <ul>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['URL_HOME']->value;?>
/produtos-gestao">Gestão de Produtos</a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-sort-amount-up" style="color: white"></i> <span>Pedidos</span> <span class="label label-important">2</span></a>
                    <ul>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['URL_HOME']->value;?>
/pedidos-gestao">Gestão de Pedidos</a></li>
                        
                    </ul>
                </li>
                
                <li class="submenu"> <a href="#"><i class="fas fa-cogs" style="color: white"></i> <span>Configurações</span> <span class="label label-important">2</span></a>
                     <ul>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['URL_HOME']->value;?>
/configuracoes-erp">Config ERP Horus</a></li>
                    </ul>
                </li>
                
                <li class="submenu"> <a href="#"><i class="fas fa-info-circle" style="color: white"></i> <span>Integradores</span> <span class="label label-important">2</span></a>
                    <ul>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['URL_HOME']->value;?>
/integradores-erp">ERP - Horus</a></li>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['URL_HOME']->value;?>
/integradores-loja">WooCommerce</a></li>
                        
                    </ul>
                </li>

            </ul>
        </div>
        <!--sidebar-menu-->

        <!--main-container-part-->
        <div id="content">
            <!--Action boxes-->
            <?php 
                Rotas::get_Pagina();
                //var_dump(Rotas::$pag);
            ?>

            <!--End Action boxes-->

        </div>



        <!--Footer-part-->

        <div class="row-fluid">
            <div id="footer" class="span12"> <?php echo $_smarty_tpl->tpl_vars['ANO']->value;?>
 &copy; Cronuz-ErosCommerce | Marketplaces </div>
        </div>

        <!--end-Footer-part-->

        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/jquery.min.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/jquery.ui.custom.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/bootstrap.min.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/bootstrap-colorpicker.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/bootstrap-datepicker.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/jquery.toggle.buttons.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/jquery.mask.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/jquery.mask.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/jquery.uniform.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/select2.min.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/scripts.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/jquery.dataTables.min.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/matrix.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/matrix.tables.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/matrix.form_common.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/wysihtml5-0.3.0.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/jquery.peity.min.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/bootstrap-wysihtml5.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GET_TEMA']->value;?>
/tema/js/scripts.js"><?php echo '</script'; ?>
>
        

    </body>
</html>
<?php }
}
