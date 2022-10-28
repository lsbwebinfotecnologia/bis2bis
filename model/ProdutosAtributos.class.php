<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutosAtributos
 *
 * @author licivando
 */
class ProdutosAtributos extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function getAtributosIdsProduto($idProduto) {
        
        $query = "
            select 
                idProduto,
                idTipoAtributo,
                idAtributo
            from p_atributos_produtos where id_loja = :id_loja and idProduto = :idProduto ";
        $params = [
            ":id_loja"=> Config::ID_LOJA,
            ":idProduto"=>$idProduto
        ];
        
        $this->executeSQL($query, $params);
        $this->getLisAtributos();
        return $this->getDatas();
        
    }
    
    function getAtributos($idAtributo) {
        $query = "
            select 
                nomeAtributo 
            from p_atributos where id_loja = :id_loja and idAtributo = :idAtributo ";
        $params = [
            ":id_loja"=> Config::ID_LOJA,
            ":idAtributo"=>$idAtributo
        ];
        
        $this->executeSQL($query, $params);
        return $this->listDatas()['nomeAtributo'];
        
    }
    
    function getAtributosTipo($idTipoAtributo) {
        $query = "
            select 
                nomeTipoAtributo
            from p_atributos_tipo where id_loja = :id_loja and idTipoAtributo = :idTipoAtributo ";
        $params = [
            ":id_loja"=> Config::ID_LOJA,
            ":idTipoAtributo"=>$idTipoAtributo
        ];
        
        $this->executeSQL($query, $params);
        return $this->listDatas()['nomeTipoAtributo'];
        
    }
    
    function getAllAtributosTipo() {
        $query = "
            select 
                nomeTipoAtributo
            from p_atributos_tipo where id_loja = :id_loja ";
        $params = [
            ":id_loja"=> Config::ID_LOJA
        ];
        
        $this->executeSQL($query, $params);
        $this->getLisAllTipoAtributos();
        return $this->getDatas();
                
    }
    
    function getProdutoAtributos($idProduto) {
        $data = $this->getAtributosIdsProduto($idProduto);
        
        $resposta = array();
        $c = 0;
        foreach ($data as  $value) {
            //$resposta[$c]['item'] = $value['idProduto'];
            $resposta[$c]['tipoAtributo'] = $this->getAtributosTipo($value['tipoAtributo']);
            $resposta[$c]['atributo'] = $this->getAtributos($value['atributo']);
            $c ++;
        }
        
        
        return $resposta;
    }
    
    
    private function getLisAtributos() {   
        
        $i = 1;
       
        while ($list = $this->listDatas()) :
            
            $this->datas[$i] = array(
                'idProduto' => $list['idProduto'],
                'tipoAtributo' => $list['idTipoAtributo'],
                'atributo' => $list['idAtributo']
            );
            
            $i ++;
        endwhile;
        
    }
    
    private function getLisAllTipoAtributos() {   
        
        $i = 1;
       
        while ($list = $this->listDatas()) :
            
            $this->datas[$i] = array(
                'tipoAtributo' => $list['nomeTipoAtributo']
            );
            
            $i ++;
        endwhile;
        
    }
    
    
    
}
