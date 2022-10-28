<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$wsHorus = new WSHorus();
$configuracao = new Configuracoes();
//BUSCANDO INFORMACOES DAS EDITORAS NO WS DO ERP
$linkTipoProduto = $wsHorus->getLinkWSProduto().'/G_TipoItens'; //OLHAR DOCUMENTACAO DO LINKS DO ERP
$dateBD = $configuracao->getInfoIntegrador('integrador-tipoproduto');
$paramsTipoProduto = array (
    "Data_Ini"=> date("d/m/Y", strtotime("-10000 days", strtotime(str_replace("-", "/", substr($dateBD['data_sicronizacao'], 0, -9))))),
    "Data_Fim"=> date("d/m/Y")
);

var_dump($paramsTipoProduto);


$tipoProdutoWS = $wsHorus->connectWebService($linkTipoProduto, $paramsTipoProduto);

if($tipoProdutoWS){
    $tipoProduto = new TipoProduto();
    $tipoProdutoBD = $tipoProduto->getTiposProdutos();
    
    $dataTipoProdutosWS = isset($tipoProdutoWS['Table'][0]) ? $tipoProdutoWS['Table'] : $tipoProdutoWS;
    
    foreach ($dataTipoProdutosWS as $tipoProdutoWS) {
        $idTipoProdutoWS = $tipoProdutoWS["COD_TIPO"]; 
        $nomeTipoProduto = $tipoProdutoWS['NOM_TIPO'];
        $dataAtualizacaoWS = $tipoProdutoWS["DAT_ULT_ATL"];  
        
        
        //SETANDO AS INFORMÇÕES COM OS DADOS DA EDITORA
        $tipoProduto->setNome($nomeTipoProduto);
        $tipoProduto->setIdTipoProdutoWs($idTipoProdutoWS);
        $tipoProduto->setDataAtualizacao($dataAtualizacaoWS);
        
  
        if(isset($tipoProdutoBD[$idTipoProdutoWS])){//SE TEM A EDITORA NO BANCO
            $dataAtualizacaoBD = $tipoProdutoBD[$idTipoProdutoWS];

            if($dataAtualizacaoWS != $dataAtualizacaoBD){//SE A DATA DA ATUALIZACAO É DIFERENTE                
                $tipoProduto->updateTipoProduto(); 
                echo 'Tipo de Item '.$idTipoProdutoWS.' atualizado com sucesso!<br>';
            }
            
        }else{///SE NAO TEM A EDITORA NA BD
            $tipoProduto->insertTipoProduto();
            echo 'Tipo de Item '.$idTipoProdutoWS.' inserido com sucesso!<br>';
        }    
        $configuracao->updateDateIntegrador('integrador-tipoproduto');
    }
    
    echo '<div class="alert alert-success alert-block"> <h4 class="alert-heading">Sincronizacao de tipo de item realizada com sucesso!</h4></div>';
}else{
    echo 'Nenhuma Tipo de produto encontrado no WS<br>';
    $configuracao->updateDateIntegrador('integrador-tipoproduto');
}

Rotas::redirecionar(3, Rotas::pagina_Integradores());