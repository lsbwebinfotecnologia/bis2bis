<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StatusPedidos
 *
 * @author licivando
 */
class StatusPedidos  extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function getStatusPedidos($idStatus=null) {
        $query = "select * from l_vendas_status where id_loja = :id_loja";
        $params = [
            ":id_loja"=> Config::ID_LOJA
        ];
        
        if($idStatus){
            $query .= " and id_status = :id_status";
            $params[":id_status"] = $idStatus;
        }
        
        $this->executeSQL($query, $params);
        $this->getListStatus();
    }
    
    
    private function getListStatus() {
     
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'id_status' => $list['id_status'],
            'nome' => $list['nome'],
            'color'=>$list['color'],
            'tipo'=>$list['tipo']
        );
        
        $i ++;
        endwhile;
        
    }
}
