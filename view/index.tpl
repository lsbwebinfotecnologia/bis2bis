<!DOCTYPE html>
<html>
    <head>
        <title>Cronuz Admin</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/fullcalendar.css" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/matrix-style.css" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/matrix-media.css" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/colorpicker.css" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/datepicker.css" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/uniform.css" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/select2.css" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/style.css" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/bootstrap-wysihtml5.css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <script src="https://kit.fontawesome.com/0c8ce7b7d2.js" crossorigin="anonymous"></script> {*FONTS FA FA*}
        <link rel="icon" type="image/png" href="{$DIR_FRONT}/tema/img/favicon.png"/>
        
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
                <li class=""><a title="" href="{$URL_HOME}/configuracoes-erp"><i class="icon icon-cog"></i> <span class="text">Configurações</span></a></li>
                <li class=""><a title="" href="{$LOGOFF}"><i class="icon icon-share-alt"></i> <span class="text">Sair</span></a></li>
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
{*                <li class=""><a href="{$URL_HOME}/dashboard"><i class="fas fa-home" style="color: white"></i> <span>Dashboard</span></a> </li>*}
                <li class="submenu"> <a href="#"><i class="fas fa-book" style="color: white"></i> <span>Produtos</span> <span class="label label-important">2</span></a>
                    <ul>
                        <li><a href="{$URL_HOME}/produtos-gestao">Gestão de Produtos</a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-sort-amount-up" style="color: white"></i> <span>Pedidos</span> <span class="label label-important">2</span></a>
                    <ul>
                        <li><a href="{$URL_HOME}/pedidos-gestao">Gestão de Pedidos</a></li>
{*                        <li><a href="{$URL_HOME}/pedidos-status">Status de pedidos</a></li>*}
                        
                    </ul>
                </li>
                
                <li class="submenu"> <a href="#"><i class="fas fa-cogs" style="color: white"></i> <span>Configurações</span> <span class="label label-important">2</span></a>
                     <ul>
                        <li><a href="{$URL_HOME}/configuracoes-erp">Config ERP Horus</a></li>
{*                        <li><a href="{$URL_HOME}/configuracoes-loja-integrada">Config WooCommerce</a></li>*}
                    </ul>
                </li>
                
                <li class="submenu"> <a href="#"><i class="fas fa-info-circle" style="color: white"></i> <span>Integradores</span> <span class="label label-important">2</span></a>
                    <ul>
                        <li><a href="{$URL_HOME}/integradores-erp">ERP - Horus</a></li>
                        <li><a href="{$URL_HOME}/integradores-loja">Bis2Bis</a></li>
                        
                    </ul>
                </li>

            </ul>
        </div>
        <!--sidebar-menu-->

        <!--main-container-part-->
        <div id="content">
            <!--Action boxes-->
            {php}
                Rotas::get_Pagina();
                //var_dump(Rotas::$pag);
            {/php}

            <!--End Action boxes-->

        </div>



        <!--Footer-part-->

        <div class="row-fluid">
            <div id="footer" class="span12"> {$ANO} &copy; Cronuz-ErosCommerce | Marketplaces </div>
        </div>

        <!--end-Footer-part-->

        <script src="{$GET_TEMA}/tema/js/jquery.min.js"></script> 
        <script src="{$GET_TEMA}/tema/js/jquery.ui.custom.js"></script> 
        <script src="{$GET_TEMA}/tema/js/bootstrap.min.js"></script> 
        <script src="{$GET_TEMA}/tema/js/bootstrap-colorpicker.js"></script> 
        <script src="{$GET_TEMA}/tema/js/bootstrap-datepicker.js"></script> 
        <script src="{$GET_TEMA}/tema/js/jquery.toggle.buttons.js"></script> 
{*        <script src="{$GET_TEMA}/tema/js/masked.js"></script> *}
        <script src="{$GET_TEMA}/tema/js/jquery.mask.js"></script>
        <script src="{$GET_TEMA}/tema/js/jquery.mask.min.js"></script>
        <script src="{$GET_TEMA}/tema/js/jquery.uniform.js"></script> 
        <script src="{$GET_TEMA}/tema/js/select2.min.js"></script> 
        <script src="{$GET_TEMA}/tema/js/scripts.js"></script>
        <script src="{$GET_TEMA}/tema/js/jquery.dataTables.min.js"></script> 
        <script src="{$GET_TEMA}/tema/js/matrix.js"></script> 
        <script src="{$GET_TEMA}/tema/js/matrix.tables.js"></script>
        <script src="{$GET_TEMA}/tema/js/matrix.form_common.js"></script> 
        <script src="{$GET_TEMA}/tema/js/wysihtml5-0.3.0.js"></script> 
        <script src="{$GET_TEMA}/tema/js/jquery.peity.min.js"></script> 
        <script src="{$GET_TEMA}/tema/js/bootstrap-wysihtml5.js"></script>
        <script src="{$GET_TEMA}/tema/js/scripts.js"></script>
        

    </body>
</html>
