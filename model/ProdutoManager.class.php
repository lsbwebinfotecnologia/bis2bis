<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutoManagement
 *
 * @author licivando
 */
class ProdutoManager {
    //put your code here
    public $metodo, $acao, $form = array(), $xml, $retorno;
            
    function actionProdutcsAPI() { 
        $validacao = $this->form;
        if(!$validacao['Method']){
            echo 'Precisa Informar o método desejado!';            
        }elseif(!$validacao['ObjectID']){
            echo 'Precisa Informar o ObjetctID!';    
        }else{
            $apiFast = new ApiFastCommerce();
            $return = $apiFast->chamadaApi($this->getLink(), $this->form);
            $this->tratamentoRetornoAPI($return);
            //return 'Comando OK';
        }
        
    }
    
    function tratamentoRetornoAPI($return) {
        $getRetornoAPI = new SimpleXMLElement($return);
        $body = $getRetornoAPI->xpath('//Record');        
        $resultados = json_decode(json_encode((array)$body), true);
        $returnArray = array();
        $c = 0;
        foreach ($resultados as $resultado){//PECORRENDO             
            foreach ($resultado['Field'] as $field){//PECORRENDO RETORNO DA API FAST FILDS
                //var_dump($field);die;
                $returnArray[$c][$field['@attributes']['Name']] = $field['@attributes']['Value'];
            }
            $c ++;
        }
        //var_dump($dadosProdutoFast);
        $this->retorno = $returnArray;
                    
        
    }
    
    function getLink() {
        return "https://www.rumo.com.br/sistema/adm/APILogon.asp";
    }

    function getMetodo() {
        return 'ReportView';
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
    
    

    function setXml($xml) {
        $this->xml = $xml;
    }

    function setAcao($acao) {
        $this->acao = $acao;
    }

    function setForm($form) {
        $this->form = $form;
    }
    
    function getRetorno() {
        return $this->retorno;
    }

    function setRetorno($retorno) {
        $this->retorno = $retorno;
    }

            

    function atualizacaoDeProdutos($listProdutos, $tipoUpdate) {
        if(!isset($tipoUpdate)){
            die('Informe o tipo de atualização: "saldo", "preco" ou "dados"');            
        }
       
        if($listProdutos){
            $update = new ProdutosAPI();
            $update->setTipoUpdate($tipoUpdate);
            $update->setProdutos($listProdutos); // SETANDO OS PRODUTOS
            $update->setAcao("A"); // SETANDO A ACAO PARA UPDATE
            $addFormUpdate = array(//ADICIONANDO O METHODO E O XML COM OS DADOS
                "Method" => "ProductManagement",
                "XMLRecords" => $update->getXml()
            );
            $update->getForm($addFormUpdate);//ADICIONANDO NO FORM OS DADOS ADICIONAIS
            $update->actionProdutcsAPI(); //EXECUNTANDO A ACAO
            echo 'Alguns produtos foram atualizados! <br>';
        }else{
            echo 'Nenhum produto para atualizar! <br>';
        }
    }
    
    function deleteProdutos($produtos = array()) {        
        $listProdutos = $produtos;
        if($listProdutos){
            $delete = new ProdutosAPI();    
            $delete->setProdutos($listProdutos);
            $delete->setAcao("E");
            $addFormInsert = array(//ADICIONANDO O METHODO E O XML COM OS DADOS
                "Method" => "ProductManagement",
                "XMLRecords" => $delete->getXml()
            );
            $delete->getForm($addFormInsert);
            var_dump($delete->actionProdutcsAPI()); 
        }
    }
    
    function insertProdutos($listProdutos) {
        if($listProdutos){
            $insert = new ProdutosAPI();    
            $insert->setProdutos($listProdutos);
            $insert->setAcao("I");
            $addFormInsert = array(//ADICIONANDO O METHODO E O XML COM OS DADOS
                "Method" => "ProductManagement",
                "XMLRecords" => $insert->getXml()
            );
            $insert->getForm($addFormInsert);
            var_dump($insert->actionProdutcsAPI()); 
        }
    }
    
    
}
