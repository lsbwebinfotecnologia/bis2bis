<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL); 
/* Habilita a exibição de erros */
ini_set("display_errors", 1);

$wsHorus = new WSHorus();
$configuracao = new Configuracoes();

//BUSCANDO INFORMACOES DOS PRECOS NO WS DO ERP
$linkPreco = $wsHorus->getLinkWSProduto().'/O_PrecoCapaItens'; //OLHAR DOCUMENTACAO DO LINKS DO ERP
$dateBD = $configuracao->getInfoIntegrador('integrador-preco');
$paramsPreco = array (
    "Data_Ini"=> date("d/m/Y", strtotime("-10000 days", strtotime(str_replace("-", "/", substr($dateBD['data_sicronizacao'], 0, -9))))), //SUBTRAINDO 5 ANOS PARA BUSCA
    "Data_Fim"=> date('d/m/Y')
);

$precosWS = $wsHorus->connectWebService($linkPreco, $paramsPreco);
//var_dump($precosWS);
//die;

if($precosWS){
    
    $preco = new Preco();
    $precoBD = $preco->getItensPreco();
    
    $dataPrecosWS = isset($precosWS['Table'][0]) ? $precosWS['Table'] : $precosWS;

    foreach ($dataPrecosWS as $precoWS) {

        //SETANDO INFORMACOES DOS PRECOS        
        $idProdutoWS = $precoWS['COD_ITEM'];
        $dataAtualizacaoWS = $precoWS['DAT_ULT_ATL'];
        $valorWS = $precoWS['VLR_CAPA'];
        $descontoWS = $precoWS['VLR_DESCONTO'];
        
        $preco->setDataAtualizacao($dataAtualizacaoWS);
        $preco->setIdProdutoWS($idProdutoWS);//AUTOMATICAMENTE SETA O ID DO PRODUTO DO BANCO        
        $preco->setPrecoWS($valorWS);
        $preco->setDesconto($descontoWS);

        if(isset($precoBD[$idProdutoWS])){//SE TEM O ITEM NA LISTA REALIZA A ACAO   
            $dataAtualizacaoBD = $precoBD[$idProdutoWS]['data_atualizacao'];
            $valorBD = $precoBD[$idProdutoWS]['vlr_preco'];             
            
            if(is_numeric($valorBD)){//VERIFICA SE TEM O PRECO NA TABELA
                if($dataAtualizacaoBD != $dataAtualizacaoWS){//ATUALIZA O PRECO SE TIVER A DATA DIFERENTE
                    $preco->updatePreco();
                    echo 'ATUALIZADO O PREÇO PARA R$ - ' . $valorWS .  ' PARA O ID DO PRODUTO ' . $preco->getIdProdutoBd() . '<br>';
                }                
            }else{//SE NAO FOR NUMERO NO SELECT DO BANCO, SIGNIFICA QUE NAO TEM PRECO NA TABELA P_PRECOS E INSERE
                $preco->insertPreco();
                echo 'INSERIDO O PREÇO DE R$ - ' . $valorWS .  ' PARA O ID DO PRODUTO ' . $preco->getIdProdutoBd() . '<br>';
            }            
        } else {
            echo 'O ID-ERP DO PRODUTO <strong>' . $idProdutoWS . '</strong> NÃO ESTA NO BD CRONUS.<br>';
        }
        
        
    }
    
    $configuracao->updateDateIntegrador('integrador-preco');
    
}

Rotas::redirecionar(10, Rotas::pagina_Integradores());

