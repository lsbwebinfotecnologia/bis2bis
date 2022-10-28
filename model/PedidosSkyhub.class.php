<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosGestao
 *
 * @author licivando
 */
class PedidosSkyhub extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getPedidos($idStatusProd = null, $dataFilter=array()) {

        $query = "select *, (select color from l_vendas_status lvs where lvs.id_status = lv.id_status_prod) as color from l_vendas lv where lv.id_loja = :id_loja  ";
        $params = [
            ":id_loja" => Config::ID_LOJA
//            ":tipo_pedido" => 'SKYHUB'
        ];

        if ($idStatusProd) {
            $query .= " and lv.id_status_prod in (:id_status_prod) ";
            $params[":id_status_prod"] = $idStatusProd;
        }
        
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
        
        $query .= " order by v_id DESC ";
        
        
        $this->executeSQL($query, $params);
        $this->getLisPedidos();
    }
    
     function updateIdPedidoErp($idPedidoBD, $idPedidoERP, $status) {
        $query = "UPDATE `l_vendas` 
            SET `pedido_exportado_erp` = :pedido_exportado_erp, 
            `cod_pedido_erp` = :cod_pedido_erp, 
            `id_status_prod` = :id_status_prod 
            WHERE `id_loja` = :id_loja 
            AND v_id = :v_id;";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":pedido_exportado_erp"=> 1,
            ":cod_pedido_erp"=> $idPedidoERP,
            ":id_status_prod"=> $status,
            ":v_id"=> $idPedidoBD
        );
        $this->executeSQL($query, $params);
    }

    private function getLisPedidos() {
        $statusPedidos = new PedidosStatus();
        $clientesDadosSkyhub = new ClienteDadosSkyhub();
        $enderecoCliente = new ClienteDadosEnderecosSkyhub();        

        $i = 1;
        while ($list = $this->listDatas()) :
            
            $idCliente = $list['id_cli'];
        
            $this->datas[$i] = array(
                'v_id' => $list['v_id'],
                'cod_pedido_erp' => $list['cod_pedido_erp'],
                'id_cli_skyhub' => $list['id_cli'],
                'id_endereco_skyhub' => $list['id_endereco'],
                'freteMode' => $list['freteMode'],
                'frete' => Sistema::MoedaBR($list['frete']),
                'tipoPagto' => $list['tipoPagto'],
                'total' => Sistema::MoedaBR($list['total']),
                'id_ped_skyhub' => $list['id_ped_skyhub'],
                'tipo_frete_skyhub' => $list['tipo_frete_skyhub'],
                'typeCalculationFreteSkyhub' => $list['freteMode'],
                'canal_skyhub' => $list['canal_skyhub'],
                'color' => $list['color'],
                'statusLabelSkyhub' => $list['status_pag'],
                'status_prod' => $statusPedidos->getStatusPedido($list['id_status_prod']),
                'dadosCliente' => $clientesDadosSkyhub->getDadosClienteSkyhub($idCliente),
                'dadosEndereco' => $enderecoCliente->getDadosEnderecoClienteSkyhub($idCliente, $list['id_endereco'])
            );

            $i ++;
        endwhile;
    }

}
