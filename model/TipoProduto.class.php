<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoProduto
 *
 * @author licivando
 */
class TipoProduto extends Conexao{
    //put your code here
    
    public $nome, $idTipoProdutoWs, $dataAtualizacao;
            
    function __construct() {
        parent::__construct();
    }
    
    function updateTipoProduto() {
        $query = "
            UPDATE `p_tipo_produto` 
            SET `nome` = :nome, 
                `data_atualizacao` = :data_atualizacao 
            WHERE `id_loja` = :id_loja 
            AND id_tipo_externo = :id_tipo_externo;";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":nome"=> $this->getNome(),
            ":id_tipo_externo"=> $this->getIdTipoProdutoWs(),
            ":data_atualizacao"=> $this->getDataAtualizacao()
        );
        
        $this->executeSQL($query, $params);
        
    }
    
    function insertTipoProduto() {
        $query = "
            INSERT INTO `p_tipo_produto`
            (`nome`,`status`,`id_loja`,`id_tipo_externo`,`data_atualizacao`) 
            VALUES(:nome, :status, :id_loja, :id_tipo_externo, :data_atualizacao);";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":status"=> 1,
            ":nome"=> $this->getNome(),
            ":id_tipo_externo"=> $this->getIdTipoProdutoWs(),
            ":data_atualizacao"=> $this->getDataAtualizacao()
        );
        
        $this->executeSQL($query, $params);
    }
    
    function getTiposProdutos() {
        $query = "SELECT id_tipo_externo, data_atualizacao FROM p_tipo_produto WHERE id_loja = :id_loja;";
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA
        );

        $this->executeSQL($query, $params);
        
        $this->getListTipoProduto();
        
        $consultaBD = $this->getDatas();
    
        $tipoProdutoBD = array();   

        foreach ($consultaBD as $key => $consulta) { 
            $tipoProdutoBD[$consulta['id_tipo_externo']] = $consulta['data_atualizacao'];        
        }
        
        return $tipoProdutoBD;
    }
    
    function getNome() {
        return $this->nome;
    }

    function getIdTipoProdutoWs() {
        return $this->idTipoProdutoWs;
    }

    function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setIdTipoProdutoWs($idTipoProdutoWs) {
        $this->idTipoProdutoWs = $idTipoProdutoWs;
    }

    function setDataAtualizacao($dataAtualizacao) {
        $this->dataAtualizacao = $dataAtualizacao;
    }
    
    private function getListTipoProduto() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
              
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'id_tipo_externo' => $list['id_tipo_externo'],
            'data_atualizacao' => $list['data_atualizacao']
        );
        
        $i ++;
        endwhile;
        
    }


}
