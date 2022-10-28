<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$configuracao = new Configuracoes();

$categoriaPai = new Categorias();
$categoriaFilho = new Categorias();
$filtro = [
    "integrado" => "N"
];

$listaCategoriasPaiCronuz = $categoriaPai->getCategoriasPai($filtro);
$categoriaLojaIntegrada = new LojaIntegradaCategoria();
$cSucess = 0;
$cError = 0;
if (!empty($listaCategoriasPaiCronuz)) {
    foreach ($listaCategoriasPaiCronuz as $catPai) {
        $dataCategoriaPai = $categoriaLojaIntegrada->formatarLista($catPai);
        $retornoCategoriaPai = $categoriaLojaIntegrada->cadastrarCategoria($dataCategoriaPai);

        if (isset($retornoCategoriaPai->error_message) || isset($retornoCategoriaPai->error)) {
            Sistema::msgDanger($retornoCategoriaPai->error_message);
//        var_dump($dataCategoriaPai);
            $cError ++;
        } else {
            $idLojaIntegradaPai = isset($retornoCategoriaPai->id) ? $retornoCategoriaPai->id : "";
            $resourceUriPai = isset($retornoCategoriaPai->resource_uri) ? $retornoCategoriaPai->resource_uri : "";
            $seoPai = isset($retornoCategoriaPai->seo) ? $retornoCategoriaPai->seo : "";
            //-----//
            $dataSetCategoriaPai = ["integrado" => 'S', "idLojaIntegrada" => $idLojaIntegradaPai, "resourceUri" => $resourceUriPai, "seo" => $seoPai];
            $dataWhereCategoriaPai = ["id_loja" => Config::ID_LOJA, "idPai" => $catPai['idPai']];
            $categoriaPai->updateTable('p_categorias_pai', $dataSetCategoriaPai, $dataWhereCategoriaPai);
            $cSucess ++;
        }
    }
}


$listaCategoriasFilhoCronuz = $categoriaFilho->getCategoriasFilho($filtro);
//var_dump($listaCategoriasFilhoCronuz);
if (!empty($listaCategoriasFilhoCronuz)) {
    foreach ($listaCategoriasFilhoCronuz as $catFilho) {//FORMATANDO A LISTA PARA PADRÃO LOJA INTEGRADA
        $dataCategoriaFilho = $categoriaLojaIntegrada->formatarLista($catFilho);
        $retornoCategoriaFilho = $categoriaLojaIntegrada->cadastrarCategoria($dataCategoriaFilho);

        if (isset($retornoCategoriaFilho->error_message) || isset($retornoCategoriaFilho->error)) {
            echo Sistema::msgDanger($retornoCategoriaFilho->error_message);
//        var_dump($dataCategoriaFilho);
            $cError ++;
        } else {
            $idLojaIntegradaFilho = isset($retornoCategoriaFilho->id) ? $retornoCategoriaFilho->id : "";
            $resourceUriFilho = isset($retornoCategoriaFilho->resource_uri) ? $retornoCategoriaFilho->resource_uri : "";
            $seoFilho = isset($retornoCategoriaFilho->seo) ? $retornoCategoriaFilho->seo : "";
            //-----//
            $dataSetCategoriaFilho = ["integrado" => 'S', "idLojaIntegrada" => $idLojaIntegradaFilho, "resourceUri" => $resourceUriFilho, "seo" => $seoFilho];
            $dataWhereCategoriaFilho = ["id_loja" => Config::ID_LOJA, "idFilho" => $catFilho['idFilho']];
            $categoriaFilho->updateTable('p_categorias_filho', $dataSetCategoriaFilho, $dataWhereCategoriaFilho);
            $cSucess ++;
        }
    }
}

echo Sistema::msgSucess("{$cSucess} categoria(s) inserida(s) e $cError com erro(s)!");


//INSERINDO EDITORAS / MARCAS
$hsEditoras = new HSEditoras();
$dataEditoras = $hsEditoras->getEditoras(false, false);
$marcaLojaIntegrada = new LojaIntegradaMarca();
$mSucess = 0;
$mError = 0;
foreach ($dataEditoras as $editora) {

    $dataEditora = $marcaLojaIntegrada->formatarLista($editora);
    $insertEditora = $marcaLojaIntegrada->cadastrarMarca($dataEditora);

    if (isset($insertEditora->error_message) || isset($insertEditora->error)) {
        echo Sistema::msgDanger($insertEditora->error_message);
//        var_dump($editora);
        $mError ++;
    } else {
        $idLojaIntegrada = isset($insertEditora->id) ? $insertEditora->id : "";
        $resourceUri = isset($insertEditora->resource_uri) ? $insertEditora->resource_uri : "";
        //----//
        $dataSetEditora = ["integrado" => 'S', "idLojaIntegrada" => $idLojaIntegrada, "resourceUri" => $resourceUri];
        $dataWhereEditora = ["id_loja" => Config::ID_LOJA, "id_editora_externo" => $editora['id_editora_externo']];
        $hsEditoras->updateTable('p_editoras', $dataSetEditora, $dataWhereEditora);
        $mSucess ++;
    }
}
echo Sistema::msgSucess("{$mSucess} marca(s) inserida(s) e $mError com erro!");


//INSERINDO OS PRODUTOS
$hsProdutos = new HsProdutos();
$listaProdutosCronuz = $hsProdutos->getProdutos($filtro);
$produtosLojaIntegrada = new LojaIntegradaProdutos();

$pSucess = 0;
$pError = 0;
foreach ($listaProdutosCronuz as $produto) {

    $dataProduto = $produtosLojaIntegrada->formatarLista($produto);
    $insertProduto = $produtosLojaIntegrada->cadastrarProduto($dataProduto);

    if (isset($insertProduto->error_message) || isset($insertProduto->error)) {
        echo Sistema::msgDanger($insertProduto->error_message . ' - Produto ' . $produto['COD_ITEM'] . ': título - ' . $produto['NOM_ITEM']);
//        var_dump($produto);
        $pError ++;
    } else {
        $idProdutoLojaIntegrada = isset($insertProduto->id) ? $insertProduto->id : "";
        $resourceUriProduto = isset($insertProduto->resource_uri) ? $insertProduto->resource_uri : "";
        //----//
        $dataSetProduto = ["integrado" => 'S', "idTerceiro" => $idProdutoLojaIntegrada, "resourceUri" => $resourceUriProduto];
        $dataWhereProduto = ["id_loja" => Config::ID_LOJA, "COD_ITEM" => $produto['COD_ITEM']];
        $hsProdutos->updateTable('hs_produtos', $dataSetProduto, $dataWhereProduto);


        $dataPreco = [
            "idLojaIntegrada" => $idProdutoLojaIntegrada,
            "cheio" => $produto['VLR_CAPA'],
            "custo" => 0,
            "promocional" => 0
        ];

        $insertPreco = $produtosLojaIntegrada->cadastrarPreco($dataPreco);

        $dataEstoque = [
            "idLojaIntegrada" => $idProdutoLojaIntegrada,
            "gerenciado" => true,
            "situacao_em_estoque" => 2,
            "situacao_sem_estoque" => -1,
            "quantidade" => $produto['SALDO_DISPONIVEL']
        ];

        $insertEstoque = $produtosLojaIntegrada->atualizarEstoque($dataEstoque);

//        var_dump($insertPreco, $insertEstoque);
        $pSucess ++;
    }
}

echo Sistema::msgSucess("{$pSucess} produto(s) inserido(s) e $pError com erro(s)!");
die;


$configuracao->updateDateIntegrador('loja-integrada-produto', 'Sincronização de produtos - Loja Integrada');
