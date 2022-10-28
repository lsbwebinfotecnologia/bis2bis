<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$wsHorus = new WSHorus();
$configuracao = new Configuracoes();
//BUSCANDO INFORMACOES DAS EDITORAS NO WS DO ERP
$linkGrupo = $wsHorus->getLinkWSProduto().'/F_GrupoItens'; //OLHAR DOCUMENTACAO DO LINKS DO ERP
$dateBD = $configuracao->getInfoIntegrador('integrador-grupoitem');
$paramsGrupoItem = array (
    "Data_Ini"=> date("d/m/Y", strtotime("-10000 days", strtotime(str_replace("-", "/", substr($dateBD['data_sicronizacao'], 0, -9))))),
    "Data_Fim"=> date("d/m/Y")
);

$grupoItensWS = $wsHorus->connectWebService($linkGrupo, $paramsGrupoItem);

if($grupoItensWS){
    $grupoItem = new GrupoProduto();
    $grupoItemBD = $grupoItem->getGruposItens();
    
    $dataGrupoItensWS = isset($grupoItensWS['Table'][0]) ? $grupoItensWS['Table'] : $grupoItensWS;
    
    
    foreach ($dataGrupoItensWS as $grupoItemWS) {
        
        
        
        $idGrupoItemWS = $grupoItemWS["COD_GRUPO_ITEM"]; 
        $nomeGrupoItem = $grupoItemWS['NOM_GRUPO_ITEM'];
        $dataAtualizacaoWS = $grupoItemWS["DAT_ULT_ATL"];  
        
        
        //SETANDO AS INFORMÇÕES COM OS DADOS DA EDITORA
        $grupoItem->setNomeGrupo($nomeGrupoItem);
        $grupoItem->setIdGrupoItem($idGrupoItemWS);
        $grupoItem->setDataAtualizacao($dataAtualizacaoWS);
        
  
        if(isset($grupoItemBD[$idGrupoItemWS])){//SE TEM A EDITORA NO BANCO
            $dataAtualizacaoBD = $grupoItemBD[$idGrupoItemWS];

            if($dataAtualizacaoWS != $dataAtualizacaoBD){//SE A DATA DA ATUALIZACAO É DIFERENTE                
                $grupoItem->updateGrupoItem(); 
                echo 'Grupo de Item '.$idGrupoItemWS.' atualizado com sucesso!<br>';
            }
            
        }else{///SE NAO TEM A EDITORA NA BD
            $grupoItem->insertGrupoItem();
            echo 'Grupo de Item '.$idGrupoItemWS.' inserido com sucesso!<br>';
        }  
        $configuracao->updateDateIntegrador('integrador-grupoitem');
        
    }
    echo '<div class="alert alert-success alert-block"> <h4 class="alert-heading">Sincronizacao de grupo de item realizada com sucesso!</h4></div>';
    
}else{
    echo 'Nenhum Grupo de Item Encontrado no WS<br>';
    $configuracao->updateDateIntegrador('integrador-grupoitem');
}

Rotas::redirecionar(3, Rotas::pagina_Integradores());