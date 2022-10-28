<?php

/*

 * ORDEM DE INSERÇÃO
 * 1 - EDITORA
 * 2 - ASSUNTO -> GENERO


 */
$wsHorus = new WSHorus();
$configuracao = new Configuracoes();
//BUSCANDO INFORMACOES DAS EDITORAS NO WS DO ERP
$linkEditora = $wsHorus->getLinkWSProduto() . '/A_EditorasItens'; //OLHAR DOCUMENTACAO DO LINKS DO ERP
$dateBD = $configuracao->getInfoIntegrador('integrador-editora');
$paramsEditora = array(
    "Data_Ini" => date("d/m/Y", strtotime("-10000 days", strtotime(str_replace("-", "/", substr($dateBD['data_sicronizacao'], 0, -9))))),
    "Data_Fim" => date("d/m/Y")
);

$editorasWS = $wsHorus->connectWebService($linkEditora, $paramsEditora);


if ($editorasWS) {
    $editora = new Editora();
    $editorasBD = $editora->getEditorasBD();

    $dataEditorasWS = isset($editorasWS['Table'][0]) ? $editorasWS['Table'] : $editorasWS;


    foreach ($dataEditorasWS as $editoraWS) {

        $idEditoraWS = $editoraWS["COD_EDITORA"];
        $dataAtualizacaoWS = $editoraWS["DAT_ULT_ATL"];
        $descontoWS = 0;
        if (isset($editoraWS["VLR_DESCONTO"])) {
            $descontoWS = $editoraWS["VLR_DESCONTO"];
        }

        //SETANDO AS INFORMÇÕES COM OS DADOS DA EDITORA
        $editora->setNomeEditora($editoraWS['NOM_EDITORA']);
        $editora->setDesconto($descontoWS);
        $editora->setNomeFantasia($editoraWS['NOM_FANTASIA']);
        $editora->setDataAtualizacao($dataAtualizacaoWS);
        $editora->setIdEditoraErp($idEditoraWS);

        if (isset($editorasBD[$idEditoraWS])) {//SE TEM A EDITORA NO BANCO
            $dataAtualizacaoBD = $editorasBD[$idEditoraWS];
            if ($dataAtualizacaoWS != $dataAtualizacaoBD) {//SE A DATA DA ATUALIZACAO É DIFERENTE                
                $editora->updateEditora();
                echo 'Editora ' . $idEditoraWS . ' atualizada com sucesso!<br>';
            }
        } else {///SE NAO TEM A EDITORA NA BD
            $editora->insertEditora();
            echo 'Editora ' . $idEditoraWS . ' inserida com sucesso!<br>';
        }
        $configuracao->updateDateIntegrador('integrador-editora');
    }




    echo '<div class="alert alert-success alert-block"> <h4 class="alert-heading">Sincronizacao de editora realizada com sucesso!</h4></div>';
    Rotas::redirecionar(5, Rotas::pagina_Integradores());
} else {
    echo 'Nenhuma Editora Encontrada no WS<br>';
    $configuracao->updateDateIntegrador('integrador-editora');
}





