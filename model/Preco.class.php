<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Preco
 *
 * @author licivando
 */
class Preco extends Conexao{
    //put your code here
    
    public $idProdutoWS, $precoWS, $idProdutoBd, $dataAtualizacao, $desconto;
    
    function __construct() {
        parent::__construct();
    }
    
    function insertPreco() {
        
        $query = "INSERT INTO `p_precos` 
            (`id_loja`, `id_produto`, `data`, `valor`, `deleted`, `id_item_externo`, `data_atualizacao`, `desconto`) 
            VALUES 
            (:id_loja, :id_produto, NOW(), :valor, :deleted, :id_item_externo, :data_atualizacao, :desconto);";
                
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":id_produto"=> $this->getIdProdutoBD(),
            ":valor"=> $this->getPrecoWS(),
            ":desconto"=> $this->getDesconto(),
            ":deleted"=> 0,
            ":data_atualizacao"=> $this->getDataAtualizacao(),
            ":id_item_externo" => $this->getIdProdutoWS()
        );
        
        $this->executeSQL($query, $params);

        
    }
    
    function updatePreco() {        
        $query = "UPDATE `p_precos` 
                  SET `valor` = :valor, 
                  `data_atualizacao` = :data_atualizacao, 
                  `updatePriceSkyhub` = :updatePriceSkyhub 
                  WHERE `id_loja` = :id_loja AND id_item_externo = :id_item_externo;";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":valor"=> $this->getPrecoWS(),
            ":data_atualizacao"=> $this->getDataAtualizacao(),
            ":updatePriceSkyhub"=> 'S',
            ":id_item_externo" => $this->getIdProdutoWS()
        );
        
        $this->executeSQL($query, $params);
        
    }
    
    function getItensPreco() {
        
        $query = "select 
                    p_id,  
                    id_item_externo,  
                    (select valor from p_precos ppr where ppr.id_produto = pp.p_id order by id_preco desc limit 1) as vlr_preco, 
                    (select data_atualizacao from p_precos ppr where ppr.id_produto = pp.p_id order by id_preco desc limit 1) as data_atualizacao
                  from p_produtos pp where id_loja = :id_loja;";
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA 
        );     
        
        $this->executeSQL($query, $params);
        
        $this->getListItensSemPreco();
        $consultaItemPreco = $this->getDatas();
        $precoBD = array();
        foreach ($consultaItemPreco as $key => $consulta) { 
            $precoBD[$consulta['id_item_externo']]['vlr_preco'] = $consulta['vlr_preco'];        
            $precoBD[$consulta['id_item_externo']]['data_atualizacao'] = $consulta['data_atualizacao'];
        }
        return $precoBD;
    }
    
    function getPrecoItemBD($idProduto) {
        
        $query = "SELECT valor FROM p_precos WHERE id_loja = :id_loja and id_produto = :id_produto";
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":id_produto"=> $idProduto
        );        
        $this->executeSQL($query, $params);
        
        return $this->listDatas()['valor'];
        
    }
        
    function getIdProdutoWS() {
        return $this->idProdutoWS;
    }

    function getPrecoWS() {
        return $this->precoWS;
    }

    function getIdProdutoBd() {
        
        $query = "SELECT p_id FROM p_produtos WHERE id_loja = :id_loja AND id_item_externo = :id_item_externo;";
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":id_item_externo" => $this->getIdProdutoWS()
        );
        
        $this->executeSQL($query, $params);
        $this->idProdutoBd = $this->listDatas();
        return $this->idProdutoBd['p_id'];
        
        
        
    }

    function setIdProdutoBd($idProdutoBd) {
        $this->idProdutoBd = $idProdutoBd;
    }

        
    function setIdProdutoWS($idProdutoWS) {
        $this->idProdutoWS = $idProdutoWS;
    }

    function setPrecoWS($precoWS) {
        $this->precoWS = $precoWS;
    }

    function getDesconto() {
        return $this->desconto;
    }

    function setDesconto($desconto) {
        $this->desconto = $desconto;
    }

        function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }

    function setDataAtualizacao($dataAtualizacao) {
        $this->dataAtualizacao = $dataAtualizacao;
    }

    
    
    private function getListItensSemPreco() {
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'id_item_externo' => $list['id_item_externo'],
            'p_id' => $list['p_id'],
            'vlr_preco' => $list['vlr_preco'],
            'data_atualizacao' => $list['data_atualizacao']
        );
        
        $i ++;
        endwhile;
    }


    
    
}
