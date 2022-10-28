<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosItensSkyhub
 *
 * @author licivando
 */
class PedidosItensSkyhub extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
     function getItensPedidoSkyhub($idPedido) {
        $query = "
            select  
                iv.id_venda as v_id, 
                (select id_item_externo from p_produtos where p_id = iv.prod_id) as id_item_ws,
                iv.prod_id as id_item_eros,
                iv.quantidade,
                iv.val_unit,
                iv.desconto_cupom,
                iv.preco_bruto,
                iv.preco_liq
            from l_itens_vendas iv 
            where iv.id_loja = :id_loja 
            AND iv.id_venda = :id_pedido;";
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":id_pedido"=> $idPedido
        );

        $this->executeSQL($query, $params);
        $this->getListItensPedidos();
        
    }
    
     private function getListItensPedidos() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
              
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'v_id' => $list['v_id'],
            'id_item_ws' => $list['id_item_ws'],
            'id_item_eros' => $list['id_item_eros'],
            'quantidade' => $list['quantidade'],
            'val_unit' => $list['val_unit'],
            'desconto_cupom' => $list['desconto_cupom'],
            'preco_bruto' => $list['preco_bruto'],
            'preco_liq' => $list['preco_liq']

        );
        
        $i ++;
        endwhile;
        
    }
}
