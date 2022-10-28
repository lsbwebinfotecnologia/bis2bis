<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosCronuzItens
 *
 * @author licivando
 */
class PedidosCronuzItens extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function getItensDoPedido($filter=[]) {
        $query = "select * from l_itens_vendas where id_loja = :id_loja ";
        $params = [
            ":id_loja"=> Config::ID_LOJA
        ];
        if(isset($filter['id_venda'])){
            $query .= " and id_venda = :id_venda ";
            $params[":id_venda"]=$filter["id_venda"];
        }
        
        if(isset($filter['prod_id'])){
            $query .= " and prod_id = :prod_id ";
            $params[":prod_id"]=$filter["prod_id"];
        }
        
        
        if(isset($filter['sku'])){
            $query .= " and COD_BARRA_ITEM = :COD_BARRA_ITEM ";
            $params[":COD_BARRA_ITEM"]=$filter["sku"];
        }
        
//        var_dump($params);
//        echo '<pre>';
//        print_r($query);
//        
//        die;
        
        $this->executeSQL($query, $params);
        
        if($this->totalDatas() > 0){
            return true;
        }else{
            return false;
        }
    }
    
    function getIdProduto($filter=[]) {
        $query = "select idProduto from hs_produtos where id_loja = :id_loja ";
        $params = [
            ":id_loja"=> Config::ID_LOJA
        ];
        
        if(isset($filter['idTerceiro'])){
            $query .= " and idTerceiro = :idTerceiro ";
            $params[":idTerceiro"]=$filter["idTerceiro"];
        }
        
        if(isset($filter['sku'])){
            
                $query .= " and COD_BARRA_ITEM = :COD_BARRA_ITEM ";
                $params[":COD_BARRA_ITEM"]=$filter["sku"];
        }
        
        $this->executeSQL($query, $params);
        
        if($this->totalDatas() > 0){
            return $this->listDatas()['idProduto'];
        }else{
            return false;
        }
    }
    
     
    
}
