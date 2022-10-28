<?php

$status = isset($_GET['status']) ? $_GET['status'] : false;


$produtos = new ProdutosExcel();
$produtos->getProductsStatus($status);

$dataProdutos = $produtos->getDatas();

$evento = new EventosCronus();
$table = 'p_produtos';
$c = 0;
foreach ($dataProdutos as $produto) {

    $idProduto = $produto['id_produto'];
    $dataSet = [
        "statusSkyhub" => 'enabled'
    ];
            
    $dataWhere = [
        "id_loja" => Config::ID_LOJA,
        "p_id" => $idProduto
    ];
    
    $evento->updateTable($table, $dataSet, $dataWhere);
    
    $c ++;
}

echo Sistema::msgSucess($c .'Livro(s) ativados!');
