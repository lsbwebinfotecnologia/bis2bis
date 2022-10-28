<?php


//GUARDANDO OS DADOS NAS VARIAVEIS
$idProduto = isset($_POST['p_id']) ? $_POST['p_id'] : "";
$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : "";
$editora = isset($_POST['editora']) ? $_POST['editora'] : "";
$autor = isset($_POST['autor']) ? $_POST['autor'] : "";
//$sku = isset($_POST['sku']) ? $_POST['sku'] : "";
//$isbn = isset($_POST['isbn']) ? $_POST['isbn'] : "";
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : "";
$tipoProduto = isset($_POST['tipoProduto']) ? $_POST['tipoProduto'] : "";
$peso = isset($_POST['peso']) ? $_POST['peso'] : "";
$altura = isset($_POST['altura']) ? $_POST['altura'] : "";
$largura = isset($_POST['largura']) ? $_POST['largura'] : "";
$comprimento = isset($_POST['comprimento']) ? $_POST['comprimento'] : "";
$precoCapa = isset($_POST['precoCapa']) ? $_POST['precoCapa'] : "";
$precoPromo = isset($_POST['precoPromo']) ? $_POST['precoPromo'] : "";
$situacao = isset($_POST['situacao']) ? $_POST['situacao'] : "";
//$status = isset($_POST['status']) ? $_POST['status'] : "";
$sinopse = isset($_POST['sinopse']) ? $_POST['sinopse'] : "";
$estoqueMinimoSkyhub = isset($_POST['estoqueMinimoSkyhub']) ? $_POST['estoqueMinimoSkyhub'] : "";
$unidades = isset($_POST['unidades']) ? $_POST['unidades'] : "";
$custoAtual = isset($_POST['custoAtual']) ? $_POST['custoAtual'] : "";


//SE ACTION FOR UPDATE
if (isset($_POST['action']) && $_POST['action'] == 'dadosGerais') {
    $evento = new EventosCronus();
    $dataSet = [
        "id_loja" => Config::ID_LOJA,
        "titulo" => $titulo,
        "id_editora" => $editora,
        "id_autor" => $autor,
        "id_cat" => $categoria,
        "id_tipo_produto" => $tipoProduto,
        "dimensoes" => $altura . "x" . $largura . "x" . $comprimento,
        "peso" => $peso,
        "estoqueMinimoSkyhub" => $estoqueMinimoSkyhub,
        "statusSkyhub" => $situacao,
        "priceSkyhub" => Sistema::formatNumberBanco($precoCapa),
        "promotionalPriceSkyhub" => Sistema::formatNumberBanco($precoPromo),
        "full_desc" => $sinopse,
        "updateSaldoSkyhub"=> "S",
        "updatePriceSkyhub"=> "S",
        "unidades" => $unidades,
        "custoAtual"=> $custoAtual
    ];

    $dataWhere = [
        "p_id" => $idProduto
    ];

    $evento->updateTable('p_produtos', $dataSet, $dataWhere);
    echo '<span class="label label-success">Produto Atualizado com Sucesso</span>';
    Rotas::redirecionar(1, Rotas::pagina_Produtos() . '/' . $idProduto);
}



