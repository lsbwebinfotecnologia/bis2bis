<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$user = isset($_SESSION['USUARIO']) ? true : false;
$key = isset($_GET['key']) && $_GET['key'] == 'Cr0nuz20' ? true : false;

if ($key) {
    require '../lib/autoload.php';
    $idLoja = Config::ID_LOJA;
}

$class = class_exists('Config');

if (!$class) {
    echo 'acesso negado';
    die;
}

$hsApiHorus = new HSApiHorus();
$configuracao = new Configuracoes();
//var_dump($hsApiHorus);
$tipoSincronizacao = "hs-estoque";
$infoIntegrador = $configuracao->getInfoIntegrador($tipoSincronizacao);
$dataIni = empty($infoIntegrador) ? date('d/m/Y H:m:s', strtotime('-30 days')) : date('d/m/Y H:m:s', strtotime($infoIntegrador['data_sicronizacao']));

$filtros = [
    "COD_TPO_CARACT" => isset($hsApiHorus->dadosAutenticacao['codTipoCaracteristica']) ? $hsApiHorus->dadosAutenticacao['codTipoCaracteristica'] : "",
    "COD_CARACT" => isset($hsApiHorus->dadosAutenticacao['codCaracteristica']) ? $hsApiHorus->dadosAutenticacao['codCaracteristica'] : "",
    "COD_EMPRESA" => isset($hsApiHorus->dadosAutenticacao['codEmpresa']) ? $hsApiHorus->dadosAutenticacao['codEmpresa'] : "",
    "COD_FILIAL" => isset($hsApiHorus->dadosAutenticacao['codFilial']) ? $hsApiHorus->dadosAutenticacao['codFilial'] : "",
    "DATA_INI" => '20/06/2021 09:19:13', //$dataIni,
    "DATA_FIM" => '26/06/2021 10:19:13' //date('d/m/Y H:m:s', strtotime('+1 days'))
];
$codLocalEstoque = isset($hsApiHorus->dadosAutenticacao['codLocalEstoque']) ? $hsApiHorus->dadosAutenticacao['codLocalEstoque'] : false;
if($codLocalEstoque && $codLocalEstoque > 0){
    $filtros['COD_LOCAL_ESTOQUE'] = $codLocalEstoque;
}

$produtosAPI = json_decode($hsApiHorus->getEstoqueHorus($filtros)); //BUSCANDO PRODUTOS NA API
//    var_dump($filtros, $produtosAPI);
//    die;
$queryUpdate = "";
$paramsUpdate = [];
if (isset($produtosAPI[0]->Falha)) {
    echo Sistema::msgDanger($produtosAPI[0]->Falha . " | " . $produtosAPI[0]->Mensagem);
} else {

    $c2 = 0;
    if (!empty($produtosAPI)) {
        foreach ($produtosAPI as $estoque) {//ATUALIZAÇÃO DE ESTOQUE DO HORUS PARA O CRONUZ
            $sku = $estoque->COD_ITEM;
            $dataSet2 = [
                "SALDO_DISPONIVEL" => $estoque->SALDO_DISPONIVEL,
                "SITUACAO_ITEM" => $estoque->SITUACAO_ITEM,
                "atualizaEstoque" => "S"
            ];
            $dataWhere2 = [
                "id_loja" => Config::ID_LOJA,
                "COD_ITEM" => $sku
            ];
            $comand2 = $configuracao->gerarQueryUpdateSQL("hs_produtos", $dataSet2, $dataWhere2);
            foreach ($comand2["params"] as $k2 => $cmd2) {
                $paramsUpdate[$k2] = $cmd2;
            }
            $queryUpdate .= $comand2["query"];
            $c2 ++;
        }
    }


    if (!empty($queryUpdate)) {
        $configuracao->executeSQL($queryUpdate, $paramsUpdate);
    }
    echo Sistema::msgSucess("{$c2} produto(s) com estoque atualizado no Cronuz!");


}