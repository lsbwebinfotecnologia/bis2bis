<?php

require './lib/autoload.php';

//error_reporting(0);
//var_dump($_GET);
//PARAMETROS PARA LIBERAR CRONS
$key = isset($_GET['key']) ? base64_encode($_GET['key']) : false;

$smarty = new Template();
$smarty->assign('GET_TEMA', Rotas::get_URLFront());
$smarty->assign('URL_HOME', Rotas::get_SiteHome());
$smarty->assign('PAGINA_LOGIN', Rotas::pagina_Login());
$smarty->assign('LOGOFF', Rotas::pagina_Logoff());

//INICIA A SESSÃO DO USUARIO
if (!isset($_SESSION)) {
    session_start();
}

//INICIANDO A SESSAO DE PEDIDO
if (!isset($_SESSION["SID"])) {
    $_SESSION["SID"] = md5(uniqid(date('YmdHms')));
}

//$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : "";

if (Login::logado()) {
    $smarty->assign('TITLE', Config::SITE_NOME);
    $smarty->assign('DIR_FRONT', Rotas::get_URLFront());
    $smarty->assign('GET_TEMA', Rotas::get_URLFront());
    $smarty->assign('URL_HOME', Rotas::get_SiteHome());
    $smarty->assign('ANO', date('Y'));

    $smarty->display('index.tpl');
} else {
    //var_dump($_POST);
    $login = new Login();
    $user = isset($_POST['usuario']) ? $_POST['usuario'] : "";
    $pass = isset($_POST['password']) ? $_POST['password'] : "";

    if ($user != "" || $pass != "") {
        if ($login->getLogin($user, $pass)) {
            Rotas::redirecionar(0, Rotas::get_SiteHome());
        } else {
            $smarty->assign('MSG', '<div class=""><div class="alert alert-danger alert-dismissible fade show"><strong>Erro!</strong> Nome de usuário e/ou senha inválidos.</div></div>');
        }
    }

    $smarty->display('login.tpl');
}

