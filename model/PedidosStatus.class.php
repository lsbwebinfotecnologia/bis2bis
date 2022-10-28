<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosStatus
 *
 * @author licivando
 */
class PedidosStatus extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getOrdersInvoiced() {
        $query = "
            select v_id, id_ped_skyhub as `order`, chave_nfe as `key`, volume as volume_qty from l_vendas 
            where id_loja = :id_loja 
            and id_status_prod = :id_status_prod 
            and tipo_pedido = :tipo_pedido 
            and sendInvoice = :sendInvoice 
            and chave_nfe is not null";
        $params = [
            ":id_loja" => Config::ID_LOJA,
            ":id_status_prod"=> Config::ID_STATUS_FATURADO,
            ":tipo_pedido" => "SKYHUB",
            ":sendInvoice"=> "0"
            
        ];

        $this->executeSQL($query, $params);
        $this->getListOrder();
        
        
    }
    
    
    public function getOrdersCanceled() {
        $query = "
            select v_id, id_ped_skyhub as `order`, chave_nfe as `key`, volume as volume_qty from l_vendas 
            where id_loja = :id_loja 
            and id_status_prod = :id_status_prod 
            and tipo_pedido = :tipo_pedido 
            and sendInvoice = :sendInvoice";
        $params = [
            ":id_loja" => Config::ID_LOJA,
            ":id_status_prod"=> Config::ID_STATUS_CANCELADO,
            ":tipo_pedido" => "SKYHUB",
            ":sendInvoice"=> "0"
        ];
        
        

        $this->executeSQL($query, $params);
        $this->getListOrder();
        
        
    }
    
    public function getStatusPedido($idStatus = null) {
        $query = "select * from l_vendas_status where id_loja = :id_loja ";
        $params = [
            ":id_loja"=> Config::ID_LOJA
            
        ];
        
        if($idStatus){
            $query .= " and id_status = :id_status ";
            $params["id_status"] = $idStatus;
        }
        
        $this->executeSQL($query, $params);
        return $this->listDatas()['nome'];
    }

    public function getOrdersShipped() {
        
    }


    
    private function getListOrder() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
              
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'v_id' => $list['v_id'],
            'order' => $list['order'],
            'key' => $list['key'],
            'volume_qty' => $list['volume_qty']
        );
        
        $i ++;
        endwhile;
        
    }

}
