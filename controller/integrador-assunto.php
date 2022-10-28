<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$wsHorus = new WSHorus();
$configuracao = new Configuracoes();
//BUSCANDO INFORMACOES DAS EDITORAS NO WS DO ERP
$linkAssunto = $wsHorus->getLinkWSProduto().'/C_GeneroItensNivel1'; //OLHAR DOCUMENTACAO DO LINKS DO ERP
$dateBD = $configuracao->getInfoIntegrador('integrador-assunto');
$paramsAssunto = array (
    "Data_Ini"=> date("d/m/Y", strtotime("-4000 days", strtotime(str_replace("-", "/", substr($dateBD['data_sicronizacao'], 0, -9))))),
    "Data_Fim"=> date("d/m/Y H:i:s")
);

$assuntosWS = $wsHorus->connectWebService($linkAssunto, $paramsAssunto);

if($assuntosWS){
    $assunto = new Assunto();
    $assuntosBD = $assunto->getAssuntosBD();
    
    $dataAssuntosWS = isset($assuntosWS['Table'][0]) ? $assuntosWS['Table'] : $assuntosWS;
    
    foreach ($dataAssuntosWS as $assuntoWS) {
        $idCategoriaWS = $assuntoWS["COD_GENERO"]; 
        $nomeCategoria = $assuntoWS['NOM_GENERO'];
        $dataAtualizacaoWS = $assuntoWS["DAT_ULT_ATL"];  
        
        //SETANDO AS INFORMÇÕES COM OS DADOS DA EDITORA
        $assunto->setNomeCategoria($nomeCategoria);
        $assunto->setIdCategoriaExterno($idCategoriaWS);
        $assunto->setDataAtualizacao($dataAtualizacaoWS);
        
  
        if(isset($assuntosBD[$idCategoriaWS])){//SE TEM A EDITORA NO BANCO
            $dataAtualizacaoBD = $assuntosBD[$idCategoriaWS];

            if($dataAtualizacaoWS != $dataAtualizacaoBD){//SE A DATA DA ATUALIZACAO É DIFERENTE                
                $assunto->updateAssunto(); 
                echo 'Assunto '.$idCategoriaWS.' atualizado com sucesso!<br>';
            }
            
        }else{///SE NAO TEM A EDITORA NA BD
            $assunto->insertAssunto();
            echo 'Assunto '.$idCategoriaWS.' inserido com sucesso!<br>';
        }    
        $configuracao->updateDateIntegrador('integrador-assunto');
    }
    echo '<div class="alert alert-success alert-block"> <h4 class="alert-heading">Sincronizacao de categoria realizada com sucesso!</h4></div>';
    
}else{
    echo 'Nenhum Assunto Encontrado no WS<br>';
    $configuracao->updateDateIntegrador('integrador-assunto');
}

Rotas::redirecionar(3, Rotas::pagina_Integradores());