<?php

$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : false;

$configuracoes = new Configuracoes();
$evento = new EventosCronus();

if ($pagina && $pagina == 'configuracao-erp' || $pagina == 'configuracao-loja') {

    foreach ($_POST as $key => $value) {
        $name = $key;
        $configuracoes->updateConfiguracoesWS($name, $value);
    }
} elseif ($pagina && $pagina == "configuracao-erp-api") {
    $table = 'a_dados_horus_api';
    $url = isset($_POST['url']) ? $_POST['url'] : false;
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : false;
    $porta = isset($_POST['porta']) ? $_POST['porta'] : false;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : false;
    $codTipoCaracteristica = isset($_POST['codTipoCaracteristica']) ? $_POST['codTipoCaracteristica'] : false;
    $codCaracteristica = isset($_POST['codCaracteristica']) ? $_POST['codCaracteristica'] : false;
    $codLocalEstoque = isset($_POST['codLocalEstoque']) ? $_POST['codLocalEstoque'] : false;
    $codEmpresa = isset($_POST['codEmpresa']) ? $_POST['codEmpresa'] : false;
    $codFilial = isset($_POST['codFilial']) ? $_POST['codFilial'] : false;

    $data = [
        "id_loja" => Config::ID_LOJA,
        "url" => $url,
        "porta" => $porta,
        "usuario" => $usuario,
        "senha" => $senha,
        "codTipoCaracteristica" => $codTipoCaracteristica,
        "codCaracteristica" => $codCaracteristica,
        "codLocalEstoque" => $codLocalEstoque,
        "codEmpresa" => $codEmpresa,
        "codFilial" => $codFilial
    ];

    if ($configuracoes->getDadosAPIHorus()) {
        $dataWhere = [
            "id_loja" => Config::ID_LOJA
        ];
        $evento->updateTable($table, $data, $dataWhere);
    } else {
        $evento->insertTable($table, $data);
    }
} elseif ($pagina && $pagina == "configuracao-loja-integrada") {
    $table = 'a_dados_loja_integrada';
    $chaveApi = isset($_POST['chaveApi']) ? $_POST['chaveApi'] : false;
    $chaveApp = isset($_POST['chaveApp']) ? $_POST['chaveApp'] : false;
    
    $data = [
        "id_loja" => Config::ID_LOJA,
        "chaveApi" => $chaveApi,
        "chaveApp" => $chaveApp,
    ];
    
    if ($configuracoes->getDadosLojaIntegrada()) {
        $dataWhere = [
            "id_loja" => Config::ID_LOJA
        ];
        $evento->updateTable($table, $data, $dataWhere);
    } else {
        $evento->insertTable($table, $data);
    }
    
}

echo '<div class="alert alert-success alert-block"> <h4 class="alert-heading">Atualizado com sucesso!</h4></div>';

if ($pagina == 'configuracao-erp' || $pagina == 'configuracao-erp-api') {
    Rotas::redirecionar(2, Rotas::pagina_ConfiguracoesErp());
} elseif ($pagina == 'configuracao-loja') {
    Rotas::redirecionar(2, Rotas::pagina_ConfiguracoesLoja());
}elseif($pagina == 'configuracao-loja-integrada'){
    Rotas::redirecionar(2, Rotas::get_SiteHome() . '/configuracao-loja-integrada');
}





