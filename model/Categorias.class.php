<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categorias
 *
 * @author licivando
 */
class Categorias extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function getCategoriasPai($filtro=[]) {
        $query = "SELECT idPai, concat(Upper(substr(nome, 1,1)), lower(substr(nome, 2,length(nome)))) as slogan, nome, idArvore, integrado, idTerceiro FROM p_categorias_pai WHERE id_loja = :id_loja ";
        $params = array(
            ':id_loja' => Config::ID_LOJA,
        );
        
        if(isset($filtro['idPai'])){
            $query .= " and idPai = :idPai ";
            $params[":idPai"]= $filtro['idPai'];
        }
        
        if(isset($filtro['nome'])){
            $query .= " and nome = :nome ";
            $params[":nome"]= $filtro['nome'];
        }
        
        if(isset($filtro['integrado'])){
            $query .= " and integrado = :integrado ";
            $params[":integrado"]= $filtro['integrado'];
        }
        
        $this->executeSQL($query, $params);
        $this->getListCategorias();
        if($this->totalDatas() > 0){
            return $this->getDatas();
        }else{
            return array();
        }
    }
    function getCategoriasFilho($filtro=[]) {
        $query = "
            SELECT 
                pcf.idPai, 
                (select pcp.idTerceiro from p_categorias_pai pcp where pcp.idPai = pcf.idPai and pcp.id_loja = :id_loja) as idPaiLojaIntegrada, 
                pcf.idFilho, 
                nome,
                concat(Upper(substr(pcf.nome, 1,1)), lower(substr(pcf.nome, 2,length(pcf.nome)))) as slogan, 
                pcf.integrado, 
                pcf.idTerceiro 
            FROM p_categorias_filho pcf
            WHERE pcf.id_loja = :id_loja ";
        $params = array(
            ':id_loja' => Config::ID_LOJA,
        );
        
        if(isset($filtro['idPai'])){
            $query .= " and pcf.idPai = :idPai ";
            $params[":idPai"]= $filtro['idPai'];
        }
        
        if(isset($filtro['idFilho'])){
            $query .= " and pcf.idFilho = :idFilho ";
            $params[":idFilho"]= $filtro['idFilho'];
        }
        
        if(isset($filtro['integrado'])){
            $query .= " and pcf.integrado = :integrado ";
            $params[":integrado"]= $filtro['integrado'];
        }
        
        if(isset($filtro['nome'])){
            $query .= " and pcf.nome = :nome ";
            $params[":nome"]= $filtro['nome'];
        }
        
        $this->executeSQL($query, $params);
        $this->getListCategorias();
        if($this->totalDatas() > 0){
            return $this->getDatas();
        }else{
            return array();
        }
    }
    
     private function getListCategorias() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
        $i = 1;
        while ($list = $this->listDatas()) :
            $key = isset($list['idFilho']) ? $list['idFilho'] : $list['nome'];
            $this->datas[$key] = array(
                'idPai' => $list['idPai'],
                'idFilho' => isset($list['idFilho']) ? $list['idFilho'] : false,
                'idArvore' => isset($list['idArvore']) ? $list['idArvore'] : false,
                'nome' => ($list['nome']),
                'slogan' => $list['slogan'],
                'integrado' => $list['integrado'],
                'idTerceiro' => $list['idTerceiro'],
                'idPaiLojaIntegrada' => isset($list['idPaiLojaIntegrada']) ? $list['idPaiLojaIntegrada'] : false
            );
            $i ++;
        endwhile;
    }
}
