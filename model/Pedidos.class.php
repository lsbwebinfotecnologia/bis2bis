<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pedidos
 *
 * @author licivando
 */
class Pedidos extends Conexao {

    public $idPedidoSkyhub, $statusSkyhub, $statusTypeSkyhub, $statusLabelSkyhub, $tipoFreteSkyhub, $canalSkyhub, $remoteCodeSkyhub, $typeCalculationFreteSkyhub; // Variaveis Skyhub
    public $total, $idCliente, $idEndereco, $frete, $statusProd, $statusPag, $totalDesconto, $tipoPagto, $freteMode; // VARIÁVEIS CRONUS - EROSCOMMERCE

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    public function insertOrder() {

        if ($this->verify()) {
            $columnsInserts = [
                "id_ped_skyhub" => $this->idPedidoSkyhub,
                "status_skyhub" => $this->statusSkyhub,
                "statusTypeSkyhub" => $this->statusTypeSkyhub,
                "statusLabelSkyhub" => $this->statusLabelSkyhub,
                "tipo_frete_skyhub" => $this->tipoFreteSkyhub,
                "canal_skyhub" => $this->canalSkyhub,
                "remoteCodeSkyhub" => $this->remoteCodeSkyhub,
                "typeCalculationFreteSkyhub" => $this->typeCalculationFreteSkyhub,
                "id_loja" => Config::ID_LOJA,
                "total" => $this->total,
                "id_cli_skyhub" => $this->idCliente,
                "id_endereco_skyhub" => $this->idEndereco,
                "frete" => $this->frete,
                "id_status_prod" => $this->statusProd,
                "status_pag" => $this->statusPag,
                "total_desc" => $this->totalDesconto,
                "tipoPagto" => $this->tipoPagto,
                "tipo_pedido" => "SKYHUB",
                "freteMode" => $this->freteMode
            ];

            if ($columnsInserts) {
                $evento = new EventosCronus();
                $evento->insertTable("l_vendas", $columnsInserts);
            }
        }
    }
    
    public function insertHistorico($idOrder, $idStatus){
        $evento = new EventosCronus();
        
        $columnsInserts = [
            "id_venda"=> $idOrder,
            "id_status"=> $idStatus,
            "id_loja"=> Config::ID_LOJA,
            "id_user"=>"-1"
        ];
        
        $evento->insertTable('l_vendas_historico', $columnsInserts);
    }
    
    public function insertHistoricoSkyhub($idOrder, $status){
        $evento = new EventosCronus();
        
        $columnsInserts = [
            "id_venda"=> $idOrder,
            "status"=> $status,
            "id_loja"=> Config::ID_LOJA,
            "user"=>"skyhub"
        ];
        
        $evento->insertTable('l_vendas_historico_skyhub', $columnsInserts);
    }

    public function updateOrder($table, $dataSet = array(), $dataWhere = array()) {

        if ($dataSet && $dataWhere) {
            $evento = new EventosCronus();
            $evento->updateTable($table, $dataSet, $dataWhere);
        }
    }

    public function getDataOrder($idOrderSkyhub) {
        $query = "SELECT * FROM l_vendas where id_ped_skyhub = :id_ped_skyhub AND id_loja = :id_loja";

        $params = array(
            ':id_ped_skyhub' => $idOrderSkyhub,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);

        if($this->totalDatas() > 0){
            return $this->listDatas();
        }else{
            return false;
        }
        
    }

    public function getIdOrder($idSkyHub) {
        $query = "SELECT v_id FROM l_vendas where id_ped_skyhub = :id_ped_skyhub AND id_loja = :id_loja";

        $params = array(
            ':id_ped_skyhub' => $idSkyHub,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);

        $pedidoBD = $this->listDatas();

        return $pedidoBD['v_id'];
    }

    public function verify() {
        $return = true;
        if (!$this->idPedidoSkyhub) {
            var_dump("Necessário informar idPedidoSkyhub");
            $return = false;
        }
        if (!$this->statusSkyhub) {
            var_dump("Necessário informar statusSkyhub");
            $return = false;
        }
        if (!$this->statusTypeSkyhub) {
            var_dump("Necessário informar statusTypeSkyhub");
            $return = false;
        }
        if (!$this->statusLabelSkyhub) {
            var_dump("Necessário informar statusLabelSkyhub");
            $return = false;
        }
        if (!$this->tipoFreteSkyhub) {
            var_dump("Necessário informar tipoFreteSkyhub");
            $return = false;
        }
        if (!$this->canalSkyhub) {
            var_dump("Necessário informar canalSkyhub");
            $return = false;
        }
        if (!$this->remoteCodeSkyhub) {
            var_dump("Necessário informar remoteCodeSkyhub");
            $return = false;
        }
        if (!$this->typeCalculationFreteSkyhub) {
            var_dump("Necessário informar typeCalculationFreteSkyhub");
            $return = false;
        }
        if (!$this->total) {
            var_dump("Necessário informar total");
            $return = false;
        }
        if (!$this->idCliente) {
            var_dump("Necessário informar idCliente");
            $return = false;
        }
        if (!$this->idEndereco) {
            var_dump("Necessário informar idEndereco");
            $return = false;
        }
//        if (empty($this->frete)){
//            var_dump("Necessário informar frete");
//            $return = false;
//        }
        if (!$this->statusProd) {
            var_dump("Necessário informar statusProd");
            $return = false;
        }
        if (!$this->statusPag) {
            var_dump("Necessário informar statusPag");
            $return = false;
        }
//        if (!$this->totalDesconto) {
//            var_dump("Necessário informar totalDesconto");
//            $return = false;
//        }
        if (!$this->tipoPagto) {
            var_dump("Necessário informar tipoPagto");
            $return = false;
        }
        if (!$this->freteMode) {
            var_dump("Necessário informar freteMode");
            $return = false;
        }

        return $return;
    }

    public function existOrder($idOrderSkyHub) {
        $query = "SELECT v_id FROM l_vendas where id_ped_skyhub = :id_ped_skyhub AND id_loja = :id_loja";

        $params = array(
            ':id_ped_skyhub' => $idOrderSkyHub,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);

        $pedidoBD = $this->listDatas();

        return $pedidoBD['v_id'];
    }

    public function prepare($dataOrderSkyhub = array()) {
        $this->setIdPedidoSkyhub($dataOrderSkyhub['idPedSkyhub']);
        $this->setStatusSkyhub($dataOrderSkyhub['statusSkyhub']);
        $this->setStatusTypeSkyhub($dataOrderSkyhub['statusTypeSkyhub']);
        $this->setStatusLabelSkyhub($dataOrderSkyhub['statusLabelSkyhub']);
        $this->setTipoFreteSkyhub($dataOrderSkyhub['tipoFreteSkyhub']);
        $this->setCanalSkyhub($dataOrderSkyhub['canalSkyhub']);
        $this->setRemoteCodeSkyhub($dataOrderSkyhub['remoteCodeSkyhub']);
        $this->setTypeCalculationFreteSkyhub($dataOrderSkyhub['typeCalculationFreteSkyhub']);
        $this->setTotal($dataOrderSkyhub['total']);
        $this->setFrete($dataOrderSkyhub['frete']);
        $this->setStatusProd($dataOrderSkyhub['statusProd']);
        $this->setStatusPag($dataOrderSkyhub['statusPag']);
        $this->setTotalDesconto($dataOrderSkyhub['totalDesconto']);
        $this->setTipoPagto($dataOrderSkyhub['tipoPagto']);
        $this->setFreteMode($dataOrderSkyhub['freteMode']);
    }

    function getIdPedidoSkyhub() {
        return $this->idPedidoSkyhub;
    }

    function getStatusSkyhub() {
        return $this->statusSkyhub;
    }

    function getStatusTypeSkyhub() {
        return $this->statusTypeSkyhub;
    }

    function getStatusLabelSkyhub() {
        return $this->statusLabelSkyhub;
    }

    function getTipoFreteSkyhub() {
        return $this->tipoFreteSkyhub;
    }

    function getCanalSkyhub() {
        return $this->canalSkyhub;
    }

    function getRemoteCodeSkyhub() {
        return $this->remoteCodeSkyhub;
    }

    function setRemoteCodeSkyhub($remoteCodeSkyhub) {
        $this->remoteCodeSkyhub = $remoteCodeSkyhub;
    }

    function getTotal() {
        return $this->total;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getIdEndereco() {
        return $this->idEndereco;
    }

    function getTypeCalculationFreteSkyhub() {
        return $this->typeCalculationFreteSkyhub;
    }

    function setTypeCalculationFreteSkyhub($typeCalculationFreteSkyhub) {
        $this->typeCalculationFreteSkyhub = $typeCalculationFreteSkyhub;
    }

    function getFrete() {
        return $this->frete;
    }

    function getStatusProd() {
        return $this->statusProd;
    }

    function getStatusPag() {
        return $this->statusPag;
    }

    function getTotalDesconto() {
        return $this->totalDesconto;
    }

    function getTipoPagto() {
        return $this->tipoPagto;
    }

    function getFreteMode() {
        return $this->freteMode;
    }

    function setIdPedidoSkyhub($idPedidoSkyhub) {
        $this->idPedidoSkyhub = $idPedidoSkyhub;
    }

    function setStatusSkyhub($statusSkyhub) {
        $this->statusSkyhub = $statusSkyhub;
    }

    function setStatusTypeSkyhub($statusTypeSkyhub) {
        $this->statusTypeSkyhub = $statusTypeSkyhub;
    }

    function setStatusLabelSkyhub($statusLabelSkyhub) {
        $this->statusLabelSkyhub = $statusLabelSkyhub;
    }

    function setTipoFreteSkyhub($tipoFreteSkyhub) {
        $this->tipoFreteSkyhub = $tipoFreteSkyhub;
    }

    function setCanalSkyhub($canalSkyhub) {
        $this->canalSkyhub = $canalSkyhub;
    }

    function setTotal($total) {
        $this->total = $total;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setIdEndereco($idEndereco) {
        $this->idEndereco = $idEndereco;
    }

    function setFrete($frete) {
        $this->frete = $frete;
    }

    function setStatusProd($statusProd) {
        $this->statusProd = $statusProd;
    }

    function setStatusPag($statusPag) {
        $this->statusPag = $statusPag;
    }

    function setTotalDesconto($totalDesconto) {
        $this->totalDesconto = $totalDesconto;
    }

    function setTipoPagto($tipoPagto) {
        $this->tipoPagto = $tipoPagto;
    }

    function setFreteMode($freteMode) {
        $this->freteMode = $freteMode;
    }

}
