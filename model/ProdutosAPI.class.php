<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutosAPI
 *
 * @author licivando
 */
class ProdutosAPI extends Conexao{
    //put your code here
    
    public $metodo, $acao, $form = array(), $xml, $tipoUpdate, $produtos;
            
    function __construct() {
        parent::__construct();
    }
    
    function actionProdutcsAPI() { 
        $validacao = $this->form;
        if(!$validacao['Method']){
            echo 'Precisa Inoformar o método desejado!';
        }elseif(!$validacao['XMLRecords']){
            echo 'Precisa Inoformar o XML a ser enviado!';
        }elseif(!$this->acao){
            echo 'Precisa informar a ação desejada!';            
        }else{
            $apiFast = new ApiFastCommerce();
            $return = $apiFast->chamadaApi($this->getLink(), $this->form);
            $this->tratamentoRetornoAPI($return);
            //return 'Comando OK';
        }
        
    }
    
    function tratamentoRetornoAPI($return) {
        $getRetornoAPI = new SimpleXMLElement($return);
        $body = $getRetornoAPI->xpath('//API')[0];
        $resultado = json_decode(json_encode((array)$body), true);
        
        echo 'Sincronização finalizada! <br>';
        echo $resultado['Stats']['@attributes']['Sent'] . ' Produtos Enviados!<br>';
        echo $resultado['Stats']['@attributes']['Valid'] . ' Produtos Validados!<br>';
        echo $resultado['Stats']['@attributes']['Included'] . ' Produtos Inseridos!<br>';
        echo $resultado['Stats']['@attributes']['Deleted'] . ' Produtos Apagados!<br>';
        
        if(isset($resultado['Record'])){            
            foreach ($resultado['Record'] as $record){//PECORRENDO RECORD
                if(isset($record['Field'])){                    
                    $dados = $this->getRecordFildAPI($record['Field']);
                    $this->respostaUpdateBD($dados);
                }else{
                    $idProdutoLoja = $resultado['Record']['Field'][1]['@attributes']['Value'];
                    
                    if($resultado['ErrCod'] != '0'){
                        echo 'Erro ao enviar o produto ' . $idProdutoLoja .' -> Código: ' . $resultado['ErrCod'] . ' Descrição: ' .$resultado['ErrDescr'] . '<br>';                    
                        die ('Nenhum produto Inserido');
                    }else{
                        $this->updateSaldoProdutos($idProdutoLoja);
                        $this->updatePrecoProdutos($idProdutoLoja);
                        echo 'Produto ' . $idProdutoLoja . ' Atualizado Preço e Saldo<br>';
                    }
                    
                }                
            }
            
        }
    }
    
    function getRecordFildAPI($records) {                
        $dadosProdutoFast = array();
        foreach ($records as $field){//PECORRENDO RETORNO DA API FAST FILDS
            if($field['@attributes']['Name'] == 'COMANDO' || $field['@attributes']['Name'] == 'CODPROD' || $field['@attributes']['Name'] == 'IDPRODUTO'){
                $dadosProdutoFast[$field['@attributes']['Name']] = $field['@attributes']['Value'];
            }           
        }
        
        if($this->acao == "I"){
            if(isset($dadosProdutoFast['IDPRODUTO'])){
                $this->updateIdFastBD($dadosProdutoFast['CODPROD'], $dadosProdutoFast['IDPRODUTO']);
                $this->updateSaldoProdutos($dadosProdutoFast['IDPRODUTO']);
                $this->updatePrecoProdutos($dadosProdutoFast['IDPRODUTO']);
                $this->updateDadosProdutos($dadosProdutoFast['IDPRODUTO']);
            }            
        }elseif($this->acao == "A"){
            if($this->tipoUpdate == "saldo"){
                $this->updateSaldoProdutos($dadosProdutoFast['IDPRODUTO']);
            }elseif($this->tipoUpdate == "preco"){
                $this->updatePrecoProdutos($dadosProdutoFast['IDPRODUTO']);
            } elseif($this->tipoUpdate == "dados") {
                $this->updateDadosProdutos($dadosProdutoFast['IDPRODUTO']);
            }
            
        }
        
        return $dadosProdutoFast;
    }
    
    function respostaUpdateBD($dados) {
        
        if($this->acao == 'I'){
            
            if(isset($dados['IDPRODUTO'])){
                echo 'Produto ID: ' . $dados['CODPROD'] . ' Inserido com sucesso na loja! <br>';
            } else {
                echo 'Houve um erro para inserir o produto ' . $dados['CODPROD'] . '<br>';
            }
            
        }elseif ($this->acao == 'A') {
            echo 'Produto <strong>' . $dados['IDPRODUTO'] . '</strong> atualizado com sucesso! <br>';
            return "ok";
        }
        
    }
    
    

    function updateSaldoProdutos($idProdutoLoja) {
        //A TRIGGER DA TABELA PRODUTOS, QUANDO VER QUE A UNIDADE É DIFERENTE DO SALDO QUE EXISTIA, COLOCA A TABELA P_PRODUTOS_FAST PARA '0',
        // ONDE APARECERA PARA ATUALIZAR NUMA PROXIMA CRON E ATAULIZANDO ELA, NA LOJA VOLTA PARA '1'
        $query = "UPDATE p_produtos_fast 
                  SET update_saldo = :update_saldo,
                      dat_ult_atl_saldo = NOW() 
                  WHERE id_produto_loja = :id_produto_loja AND id_loja = :id_loja";
        
        $params = array (
            ":id_loja"=> Config::ID_LOJA,
            ":id_produto_loja"=> $idProdutoLoja,
            ":update_saldo"=> '1'
        );
        $this->executeSQL($query, $params);
    }
    
    function updatePrecoProdutos($idProdutoLoja) {
        //A TRIGGER DA TABELA PRODUTOS, QUANDO VER QUE A UNIDADE É DIFERENTE DO SALDO QUE EXISTIA, COLOCA A TABELA P_PRODUTOS_FAST PARA '0',
        // ONDE APARECERA PARA ATUALIZAR NUMA PROXIMA CRON E ATAULIZANDO ELA, NA LOJA VOLTA PARA '1'
        $query = "UPDATE p_produtos_fast 
                  SET update_preco = :update_preco,
                      dat_utl_atl_preco = NOW() 
                  WHERE id_produto_loja = :id_produto_loja AND id_loja = :id_loja";
        
        $params = array (
            ":id_loja"=> Config::ID_LOJA,
            ":id_produto_loja"=> $idProdutoLoja,
            ":update_preco"=> '1'
        );
        $this->executeSQL($query, $params);
    }
    
    function deleteProdutoTbFast($idProdutoLoja) {
        $query = "DELETE FROM `p_produtos_fast` WHERE id_produto_loja = :id_produto_loja and id_loja = :id_loja";
        
        $params = array (
            ":id_loja"=> Config::ID_LOJA,
            ":id_produto_loja"=> $idProdutoLoja
        );
        $this->executeSQL($query, $params);
        
        $this->deleteIDFast($idProdutoLoja);
    }
    
    
    
    function updateDadosProdutos($idProdutoLoja) {
        //A TRIGGER DA TABELA PRODUTOS, QUANDO VER QUE A UNIDADE É DIFERENTE DO SALDO QUE EXISTIA, COLOCA A TABELA P_PRODUTOS_FAST PARA '0',
        // ONDE APARECERA PARA ATUALIZAR NUMA PROXIMA CRON E ATAULIZANDO ELA, NA LOJA VOLTA PARA '1'
        $query = "UPDATE p_produtos_fast 
                  SET update_dados = :update_dados,
                      dat_ult_atl_dados = NOW() 
                  WHERE id_produto_loja = :id_produto_loja AND id_loja = :id_loja";
        
        $params = array (
            ":id_loja"=> Config::ID_LOJA,
            ":id_produto_loja"=> $idProdutoLoja,
            ":update_dados"=> '1'
        );
        $this->executeSQL($query, $params);
    }
    
    function updateIdFastBD($idProdutoErp, $idProdutoLoja) {//ATUALIZACAO DO ID DO PRODUTO NA BASE DE DADOS UTILIZADO DEPOIS DE CHAMAR A API E CADASTRAR O LIVOR NA LOJA
        
        $query = "UPDATE p_produtos 
                  SET idProdutoLoja = :idProdutoLoja, 
                      integradoLoja = :integradoLoja 
                  WHERE id_item_externo = :id_item_externo AND id_loja = :id_loja";
        
        $params = array (
            ":id_loja"=> Config::ID_LOJA,
            ":idProdutoLoja"=> $idProdutoLoja,
            ":integradoLoja"=> 1,
            ":id_item_externo" => $idProdutoErp
        );
        $this->executeSQL($query, $params);
        
    }
    
    function deleteIDFast($idProdutoLoja) {
        
        $query = "UPDATE p_produtos 
                  SET idProdutoLoja = NULL, 
                      integradoLoja = :integradoLoja 
                  WHERE idProdutoLoja = :idProdutoLoja AND id_loja = :id_loja";
        
        $params = array (
            ":id_loja"=> Config::ID_LOJA,
            ":idProdutoLoja"=> $idProdutoLoja,
            ":integradoLoja"=> 0
        );
        $this->executeSQL($query, $params);
        
    }

    
    
    function getLink() {
        return "https://www.rumo.com.br/sistema/adm/APILogon.asp";
    }

    function getMetodo() {
        return 'ProductManagement';
    }

    function getAcao() {
        return $this->acao;
    }

    function getForm($addForm = array()) {//O FORMULARIO ADICIONA ATRAVES DO ARRAY OS CAMPOS ADICIONAIS COMO POR EXEMPLO O METHODO ENTRE OUTROS
        $configuracao = new Configuracoes();
        $dadosForm = $configuracao->getdadosLojaApi();    
        
        if($addForm){
            foreach ($addForm as $key => $value){
                $dadosForm[$key] = $value;
            }
        }
        $this->form = $dadosForm;
        return $this->form;
    }
    
    function getXml() {//GERAR O ARQUIVO XML PARA ENVIO DOS PRODUTOS
        $xml = new DOMDocument('1.0', 'ISO-8859-1');
        $xml->formatOutput = true;
        $records = $xml->createElement('Records');        
        $acao = $this->acao;        
        foreach ($this->produtos as $produto) {//CRIANDO O XML COM OS PRODUTOS A SEREM INSERIDOS VIA API FAST    
            $record = $xml->createElement("Record");   
            $c = 0;//ZERA O CONTADOR
            foreach ($produto as $key => $value) {
                //COMANDO
                $field = $xml->createElement('Field');
                if($c == 0){//ACRESCENTANDO A FIELD COMANDO COM A ACAO
                    $comando = $xml->createElement('Field');
                    $comando->setAttribute("Name", "Comando");
                    $comando->setAttribute("Value", $acao);
                    $record->appendChild($comando);
                }
                $field->setAttribute("Name", $key);
                $field->setAttribute("Value", $value);
                $record->appendChild($field);
                $c ++;
            }    
            $records->appendChild($record);    
        }
        $xml->appendChild($records);
        //SALVANDO O XML PARA ENVIO DE INFORMACOES DOS PRODUTOS
        $xmlDados = $xml->saveXML();
        return $xmlDados;
    }

    function setXml($xml) {
        $this->xml = $xml;
    }

    function setAcao($acao) {
        $this->acao = $acao;
    }

    function setForm($form) {
        $this->form = $form;
    }
    
    function getTipoUpdate() {
        return $this->tipoUpdate;
    }

    function setTipoUpdate($tipoUpdate) {
        $this->tipoUpdate = $tipoUpdate;
    }
    function getProdutos() {
        return $this->produtos;
    }

    function setProdutos($produtos) {
        $this->produtos = $produtos;
    }





    
    
}
