<?php

$smarty = new Template();

//INICIO BREADCRUMBS
$pagesBreadCrumb = [
    "Home" => Rotas::get_SiteHome()
];
$smarty->assign ("BREADCRUMBS", $pagesBreadCrumb);
$page = [
    "link"=> '',
    "title"=> "Usuários"
];
$smarty->assign ("PAGE", $page);
//FIM BREADCRUMBS


$usuarios = new Usuarios();
$smarty->assign ("USUARIOS", $usuarios->getUsers());

if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['senha'])){
    $login = $_POST['login'];
    $email = $_POST['email'];
    $senha = Sistema::Criptografia(Config::BD_PREFIXO_PASS.$_POST['senha']);    
    $evento = new EventosCronus();
    
    $columnsInserts = [
        "nome" => $login,
        "login" => $login,
        "email" => $email,
        "senha" => $senha,
        "loja_id" => Config::ID_LOJA,
        "ativo" => "1"
    ];
    
    $evento->insertTable("a_users", $columnsInserts);
    
    Rotas::redirecionar(0, Rotas::pagina_Usuarios());

}
$smarty->display('usuarios.tpl');

