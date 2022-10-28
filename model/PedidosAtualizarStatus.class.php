<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosAtualizarStatus
 *
 * @author licivando
 */
class PedidosAtualizarStatus extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getPedidosAtualizarStatus($idStatus, $tipo = null, $nfe = false) {
        $skyhub = '';

        if ($tipo && $tipo == 'skyhub') {
            $skyhub = '_skyhub';
        }

        $query = "
            select 
                lv.id_ped_skyhub,
                lv.v_id,
                lv.id_cli{$skyhub} as id_cli,
                (select id_cliente_erp from c_clientes{$skyhub} where id_cli = lv.id_cli{$skyhub}) as id_cliente_erp, 
                lv.tipoPagto, 
                lv.cod_pedido_erp, 
                (select nome from l_vendas_status lvs where lvs.id_status = lv.id_status_prod and lvs.id_loja = lv.id_loja) as status 
            from l_vendas lv 
            where lv.id_loja = :id_loja 
            and lv.pedido_exportado_erp in ('1') 
            
        ";

        if($idStatus == Config::ID_STATUS_FATURADO){//SE O PEDIDO FOR FATURADO PRECISA VER QUEM NÃO TEM NOTA
            $query .= " and lv.id_status_prod = :id_status_prod AND chave_nfe is null ";
        }else{
            $query .= " and lv.id_status_prod in (:id_status_prod)  ";
        }

        $params = array(
            ":id_loja" => Config::ID_LOJA,
            ":id_status_prod" => $idStatus            
        );

        if ($tipo == 'skyhub') {
            $query .= " and lv.id_cli_skyhub is not null ";
        }

        if ($nfe) {
            $query .= " and lv.chave_nfe is null ";
        }


        $this->executeSQL($query, $params);
        $this->getListPedidosUpdate();
    }

    function updateSatatusPedido($idPedidoERP, $status) {
        $query = "UPDATE `l_vendas` 
            SET `id_status_prod` = :id_status_prod 
            WHERE `id_loja` = :id_loja 
            AND `cod_pedido_erp` = :cod_pedido_erp ";
        $params = array(
            ":id_loja" => Config::ID_LOJA,
            ":cod_pedido_erp" => $idPedidoERP,
            ":id_status_prod" => $status
        );
        $this->executeSQL($query, $params);
    }

    function updateNFPedido($idPedidoERP, $chaveNF, $nroNf) {
        $query = "UPDATE `l_vendas` 
            SET `chave_nfe` = :chave_nfe, 
                `nro_nota_fiscal` = :nro_nota_fiscal 
            WHERE `id_loja` = :id_loja 
            AND `cod_pedido_erp` = :cod_pedido_erp ";
        $params = array(
            ":id_loja" => Config::ID_LOJA,
            ":cod_pedido_erp" => $idPedidoERP,
            ":nro_nota_fiscal" => $nroNf,
            ":chave_nfe" => $chaveNF
        );
        $this->executeSQL($query, $params);
    }

    private function getListPedidosUpdate() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$i] = array(
                'v_id' => $list['v_id'],
                'id_cli' => $list['id_cli'],
                'id_ped_skyhub' => $list['id_ped_skyhub'],
                'id_cliente_erp' => $list['id_cliente_erp'],
                'tipoPagto' => $list['tipoPagto'],
                'cod_pedido_erp' => $list['cod_pedido_erp'],
                'status' => $list['status']
            );

            $i ++;
        endwhile;
    }

}
