<?php

$smarty = new Template();

//BREADCRUMBS OBRIGATÓRIO NAS PÁGINAS
$PagesBreadCrumbs = [
    "Home"=> Rotas::get_SiteHome(),
    "Gestão Produtos" => Rotas::pagina_ProdutosGestao()
];
$smarty->assign('BREADCRUMBS', $PagesBreadCrumbs);
$page = [
    'link'=> Rotas::pagina_Produtos(),
    'title'=> 'Produtos'
];
$smarty->assign('PAGE', $page);
//FIM BREADCRUMBS

if(isset(Rotas::$pag[1])){
    $idProduto = Rotas::$pag[1];
    $produto = new ProdutosCronus();
    
    $editora = new ProdutoEditora();
    $editora->getEditoras();    
    $autores = new ProdutoAutor();
    $autores->getAutores();
    $categorias = new ProdutoCategoria();
    $categorias->getCategorias();
    $tipoProduto = new ProdutoTipo();
    $tipoProduto->getTiposProduto();
    
    $dataProduto = $produto->getProducts($idProduto);
    
//    var_dump($dataProduto);
    $smarty->assign('PRODUTO', $dataProduto);
    $smarty->assign('EDITORAS', $editora->getDatas());
    $smarty->assign('AUTORES', $autores->getDatas());
    $smarty->assign('CATEGORIAS', $categorias->getDatas());
    $smarty->assign('TIPOSPRODUTO', $tipoProduto->getDatas());
    
//    $smarty->assign('PRECOCHEIO', Sistema::MoedaBR($dataProduto['precoCheio']));
    $smarty->assign('PRECOPROMO', Sistema::MoedaBR($dataProduto['precoPromo']));
    
    $smarty->assign('PAGINA_ACTION_PRODUTO', Rotas::pagina_ActionProduto());
    
    $dimensoes = explode('x', $dataProduto['dimensoes']);
    $smarty->assign('ALTURA', $dimensoes[0]);
    $smarty->assign('LARGURA', $dimensoes[1]);
    $smarty->assign('COMPRIMENTO', $dimensoes[2]);
    
    //var_dump($produto->getProducts($idProduto));
    
    
}else{
    Rotas::redirecionar(0, Rotas::pagina_ProdutosGestao());
}







$smarty->display('produto.tpl');


