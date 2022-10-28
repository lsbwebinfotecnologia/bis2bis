<?php

//require './lib/autoload.php';

$smarty = new Template();

$login = new Login();
//var_dump($_SESSION, $_POST);

//die;
if(Login::logado()) {
    Rotas::redirecionar(0, Rotas::get_SiteHome());    
}elseif(isset($_POST['email']) && isset($_POST['password'])){
    $user = $_POST['email'];
    $pass = $_POST['password'];

    if($login->getLoginLoja($user, $pass)){
        exit();
        $smarty->assign('MSG', '<div class=""><div class="alert alert-success"><strong>Successo!</strong> Login realizado com sucesso.</div></div>');
    }else{
        $smarty->assign('MSG', '<div class=""><div class="alert alert-danger alert-dismissible fade show"><strong>Erro!</strong> Nome de usuário e/ou senha inválidos.</div></div>');
    }    
        
}

$smarty->assign('GET_TEMA', Rotas::get_URLFront());
$smarty->assign('URL_HOME', Rotas::get_SiteHome());

$smarty->display('login.tpl');