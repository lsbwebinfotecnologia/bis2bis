<!DOCTYPE html>
<html lang="pt">

    <head>
        <title>Cronus - DBM</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="{$GET_TEMA}/tema/css/matrix-login.css" />
        <link href="{$GET_TEMA}/tema/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="loginbox"> 
            {if isset($MSG)}
                <div class="widget-content">
                    <div class="alert alert-error alert-block"> 
                        <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading">Erro!</h4>
                        Usuário ou Senha Incorreto!
                    </div>
                </div>
            {/if}
            <form method="post" class="form-vertical" action="{$PAGINA_LOGIN}">
                <div class="control-group normal_text"> 
                    <h3><img src="{$GET_TEMA}/tema/img/logo.png" alt="Logo" /></h3>
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

        <script src="{$GET_TEMA}/tema/js/jquery.min.js"></script>  
        <script src="{$GET_TEMA}/tema/js/matrix.login.js"></script> 
    </body>

</html>
