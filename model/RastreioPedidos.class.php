<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RastreioPedidos
 *
 * @author licivando
 */
class RastreioPedidos extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getPedidosEnvioRastreio() {

        $query = "
            select 
                v_id, 
                id_pedido_loja, 
                cod_pedido_erp, 
                notificadoRastreio, 
                codigo_rastreio 
            from l_vendas 
            where id_loja = :id_loja 
            and codigo_rastreio is not null 
            and notificadoRastreio = '0' 
            ";
        $params = [
            ":id_loja" => Config::ID_LOJA
        ];

        $this->executeSQL($query, $params);

        $this->getListOrder();

    }

    private function getListOrder() {
        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$i] = array(
                'v_id' => $list['v_id'],
                'id_pedido_loja' => $list['id_pedido_loja'],
                'cod_pedido_erp' => $list['cod_pedido_erp'],
                'notificadoRastreio' => $list['notificadoRastreio'],
                'codigo_rastreio' => $list['codigo_rastreio']
            );

            $i ++;
        endwhile;
    }

}
