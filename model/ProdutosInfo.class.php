<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutosInfo
 *
 * @author licivando
 */
class ProdutosInfo extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function getProducts($status=null, $dataFilter=array()) {
        $query = "
            select 
                count(p_id) as total 
            from p_produtos
            where id_loja = :id_loja  
            
            ";
        $params = [
            ":id_loja"=> Config::ID_LOJA
        ];
        
        if($status && $status == 'noSend'){
            $query .= " and statusSkyhub = :status and skyhub != '1' ";
            $params[":status"] = $status;
        }elseif($status && $status == 'enabled'){
            $query .= "  and skyhub = '1' and statusSkyhub = :status ";
            $params[":status"] = $status;
        }elseif ($status && $status == 'disabled') {
            $query .= "and statusSkyhub = :status ";
            $params[":status"] = $status;
        }
        
        if (isset($dataFilter['status']) && $dataFilter['status'] != '0') {
            $query .= " and statusSkyhub = :status ";
            $params[":status"] = $dataFilter['status'];
        }
        
        $this->executeSQL($query, $params);
        
        return $this->listDatas()['total'];
        
    }
}
