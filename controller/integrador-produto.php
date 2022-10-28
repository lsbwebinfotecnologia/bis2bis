<?php

/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL); 
/* Habilita a exibição de erros */
ini_set("display_errors", 1);

$wsHorus = new WSHorus();
$configuracao = new Configuracoes();
//echo '<pre>';
//BUSCANDO INFORMACOES DOS PRODUTOS NO WS DO ERP
$linkProduto = $wsHorus->getLinkWSProduto().'/M_ItensEstoque'; //OLHAR DOCUMENTACAO DO LINKS DO ERP
$dateBD = $configuracao->getInfoIntegrador('integrador-produto');
$urlCapa = $wsHorus->getLinkWSCapas();

$paramsProduto = array (    
    "Data_Ini"=> date("d/m/Y", strtotime("-45 days", strtotime(str_replace("-", "/", substr($dateBD['data_sicronizacao'], 0, -9))))),
    "Data_Fim"=> date("d/m/Y"),
    "Cod_Editora" => "",
    "Cod_Tipo_Caract" =>  $configuracao->getDadosConfig('codTipoCaracteristica'),
    "Cod_Caract" => $configuracao->getDadosConfig('codCaracteristica')
);

$produtosWS = $wsHorus->connectWebService($linkProduto, $paramsProduto);
//echo '<pre>';
//var_dump($produtosWS);
//die;

if($produtosWS){    
    $produto = new Produto();    
    $produtosBD = $produto->getProdutos();
    
    $dataProdutosWS = isset($produtosWS['Table'][0]) ? $produtosWS['Table'] : $produtosWS;
    
    foreach ($dataProdutosWS as $produtoWS) {
        $idProdutoWs = $produtoWS['COD_ITEM'];
        $dataAtualizacaoWS = $produtoWS['DAT_ULT_ATL'];
        $isbn = $produtoWS['COD_BARRA_ITEM'];
        
        $sinopse = "Sem descricao para este livro";
        $dataLanctoWs = NULL;
        if(!$produtoWS["DESC_SINOPSE"] == array()){
            $sinopse = $produtoWS["DESC_SINOPSE"];
        }
        
        if(isset($produtoWS["DAT_EXP_LANCTO"])){
            //$data = substr(($item["DAT_EXP_LANCTO"]), 0, -19);
            $dataLanctoWs = date("Y-m-d", strtotime("-1 days", strtotime(substr(($produtoWS["DAT_EXP_LANCTO"]), 0, -19))));
        }       

        $codigoSelo = isset($produtoWS['COD_SELO']) ? $produtoWS['COD_SELO'] : 0;
        
        //SETANDO AS INFORMÇÕES COM OS DADOS DO PRODUTO 
        $produto->setTitulo($produtoWS['NOM_ITEM']);
        $produto->setSinopse($sinopse);
        $produto->setIdCategoriaWs($produtoWS['COD_GENERO']);///SE SET CATEGORIA WS AUTOMATICO TEREI A CATEGORIA BD
        $produto->setAtivo(1);
        $produto->setIsbn($isbn);
        $produto->setIdEditoraWs($produtoWS['COD_EDITORA']);//SETANDO O ID DA EDITORA WS AUTOMATICO TEREI ID DA EDITORA BD
        $produto->setPaginas($produtoWS['QTD_PAGINAS']);
        $produto->setDimensoes($produtoWS["ALTURA_ITEM"]."x".$produtoWS["LARGURA_ITEM"]."x".$produtoWS["COMPRIMENTO_ITEM"]);
        $produto->setPeso($produtoWS['PESO_ITEM']);
        $produto->setIdTipoProdutoWs($produtoWS['COD_TIPO']);//SETANDO O ID TIPO PRODUTO DO WS AUTOMATICO TEREMOS O ID TIPO BD
        $produto->setSituacaoItem($produtoWS['SITUACAO_ITEM']);
        $produto->setDataAtualizacaoWs($produtoWS['DAT_ULT_ATL']);
        $produto->setIdSeloWs($codigoSelo);//SETANDO O ID SELO WS AUTOMATICAMENTE TEREMOS O ID SELO BD
        $produto->setIdProdutoWs($produtoWS['COD_ITEM']);
        $produto->setIdGrupoWs($produtoWS['COD_GRUPO_ITEM']);
        $produto->setStatusItemWs($produtoWS['STATUS_ITEM']);
        $produto->setDataLanctoWs($dataLanctoWs);
               
        if(isset($produtosBD[$idProdutoWs])){//SE TEM O PRODUTO NO BANCO            
            $dataAtualizacaoBD = $produtosBD[$idProdutoWs];
            if($dataAtualizacaoWS != $dataAtualizacaoBD){//SE A DATA DA ATUALIZACAO É DIFERENTE                
                $produto->updateProduto(); 
                echo 'Produto '.$idProdutoWs.' atualizado com sucesso!<br>';
            }
            
        }else{///SE NAO TEM O PRODUTO NA BD
            $produto->insertProduto();
            echo 'Produto '.$idProdutoWs.' inserida com sucesso!<br>';
        }
        
        
        //COPIAR A IMAGEM
        $urlOrigem = $urlCapa . '/' . $isbn . '.jpg';        
        if(Sistema::url_exists($urlOrigem)){//URL DA CAPA SE EXISITIR ELE COPIA PARA A PASTA CONFIGURADA NA ROTA
            $urlDestino = Rotas::get_DirImagesCapas() . '/' . $isbn . '.jpg';
            Sistema::copiaImagem($urlOrigem, $urlDestino);
        }
        //die;
        
    }
    echo '<div class="alert alert-success alert-block"> <h4 class="alert-heading">Sincronizacao de produto realizada com sucesso!</h4></div>';
    Rotas::redirecionar(5, Rotas::pagina_Integradores());
    $configuracao->updateDateIntegrador('integrador-produto');
    
} else {
    echo 'Algum erro na chamada do WS ou Nenhuma informação Encontrada no WS';
    
}





