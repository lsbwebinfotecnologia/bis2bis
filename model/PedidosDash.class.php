<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosDash
 *
 * @author licivando
 */
class PedidosDash extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function getValorTotalPedidos($dataFilter = array()) {
        $query = "select sum(total) as total from l_vendas lv where lv.id_loja = :id_loja and lv.tipo_pedido = :tipo_pedido ";
        $params = [
            ":id_loja" => Config::ID_LOJA,
            ":tipo_pedido" => 'SKYHUB'
        ];

        if (isset($dataFilter['dataIni'])) {
            $query .= " AND DATE(lv.`dateCreate`) >= :dataIni AND DATE(lv.`dateCreate`) <= :dataFim ";
            $params[":dataIni"] = $dataFilter['dataIni'];
            $params[":dataFim"] = $dataFilter['dataFim'];
        }

        if (isset($dataFilter['status']) && $dataFilter['status'] != '0') {
            $query .= " AND lv.id_status_prod = :id_status_prod ";
            $params[":id_status_prod"] = $dataFilter['status'];
        }
        
        if (isset($dataFilter['id']) && $dataFilter['id'] != false) {
            $query .= " AND lv.v_id = :id ";
            $params[":id"] = $dataFilter['id'];
        }

        $this->executeSQL($query, $params);

        return $this->listDatas()['total'];
    }

    function getValorTotalFrete($dataFilter = array()) {
        $query = "select sum(frete) as total from l_vendas lv where lv.id_loja = :id_loja and lv.tipo_pedido = :tipo_pedido ";
        $params = [
            ":id_loja" => Config::ID_LOJA,
            ":tipo_pedido" => 'SKYHUB'
        ];

        if (isset($dataFilter['dataIni'])) {
            $query .= " AND DATE(lv.`dateCreate`) >= :dataIni AND DATE(lv.`dateCreate`) <= :dataFim ";
            $params[":dataIni"] = $dataFilter['dataIni'];
            $params[":dataFim"] = $dataFilter['dataFim'];
        }

        if (isset($dataFilter['status']) && $dataFilter['status'] != '0') {
            $query .= " AND lv.id_status_prod = :id_status_prod ";
            $params[":id_status_prod"] = $dataFilter['status'];
        }
        
        if (isset($dataFilter['id']) && $dataFilter['id'] != false) {
            $query .= " AND lv.v_id = :id ";
            $params[":id"] = $dataFilter['id'];
        }
        

        $this->executeSQL($query, $params);

        return $this->listDatas()['total'];
    }

    function getCustoTotal($dataFilter = array()) {

        $params = [
            ":id_loja" => Config::ID_LOJA,
            ":tipo_pedido" => 'SKYHUB'
        ];

        $where = " select v_id from l_vendas lv where lv.id_loja = :id_loja and lv.tipo_pedido = :tipo_pedido ";

        if (isset($dataFilter['dataIni'])) {
            $where .= " AND DATE(lv.`dateCreate`) >= :dataIni AND DATE(lv.`dateCreate`) <= :dataFim ";
            $params[":dataIni"] = $dataFilter['dataIni'];
            $params[":dataFim"] = $dataFilter['dataFim'];
        }

        if (isset($dataFilter['status']) && $dataFilter['status'] != '0') {
            $where .= " AND lv.id_status_prod = :id_status_prod ";
            $params[":id_status_prod"] = $dataFilter['status'];
        }

        if (isset($dataFilter['id']) && $dataFilter['id'] != false) {
            $where .= " AND lv.v_id = :id ";
            $params[":id"] = $dataFilter['id'];
        }


        $query = "
            select 
                (select sum(custoAtual) from p_produtos pp where pp.p_id = liv.prod_id) * liv.quantidade as custo
            from l_itens_vendas liv
            where id_venda in (
                $where
            )
        ";


        $this->executeSQL($query, $params);



        $i = 1;
        $total = 0;
        while ($list = $this->listDatas()) :
            $total += $list['custo'];

            $i ++;
        endwhile;

        return $total;
    }

}
