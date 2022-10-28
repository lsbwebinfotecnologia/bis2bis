<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosCronus
 *
 * @author licivando
 */
class PedidosCronus extends Conexao {

    public $idPedidoLoja, $idCliente, $idEndereco, $vlrTotal, $vlrFrete, $formaPagto, $qtdParcelas, $tipoFrete, $tipoPedido, $bandeira;

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function insertPedido() {

        if ($this->validaInsert()) {
            $evento = new EventosCronus();
            $columnsInserts = [
                "id_pedido_loja"=> $this->idPedidoLoja,
                "status_pag"=>'00',
                "total"=> $this->vlrTotal,
                "total_desc" => 0,
                "frete" => $this->vlrFrete,
                "prazo"=> 5,
                "id_cli"=> $this->idCliente,
                "id_endereco"=> $this->idEndereco,
                "id_loja"=> Config::ID_LOJA,
                "id_status_prod"=> Config::ID_STATUS_APROVADO,
                "freteMode"=> $this->tipoFrete,
                "tipoPagto"=> $this->formaPagto,
                "bandeira"=> $this->bandeira,
                "tipo_pedido" => $this->tipoPedido
            ];
            $evento->insertTable('l_vendas', $columnsInserts);
        }
    }

    function prepara($dataOrder = array()) {

        $idPedidoLoja = isset($dataOrder['idOrderLoja']) ? $dataOrder['idOrderLoja'] : false;
        $idCliente = isset($dataOrder['idCliente']) ? $dataOrder['idCliente'] : false;
        $idEndereco = isset($dataOrder['idEndereco']) ? $dataOrder['idEndereco'] : false;
        $vlrTotal = isset($dataOrder['vlrTotal']) ? $dataOrder['vlrTotal'] : false;
        $vlrFrete = isset($dataOrder['vlrFrete']) ? $dataOrder['vlrFrete'] : false;
        $formaPagto = isset($dataOrder['formaPagto']) ? $dataOrder['formaPagto'] : false;
        $qtdParcelas = isset($dataOrder['qtdParcelas']) ? $dataOrder['qtdParcelas'] : false;
        $tipoFrete = isset($dataOrder['tipoFrete']) ? $dataOrder['tipoFrete'] : false;
        $tipoPedido = isset($dataOrder['tipoOrder']) ? $dataOrder['tipoOrder'] : false;
        $bandeira = isset($dataOrder['bandeira']) ? $dataOrder['bandeira'] : false;
        $this->setIdPedidoLoja($idPedidoLoja);
        $this->setIdCliente($idCliente);
        $this->setIdEndereco($idEndereco);
        $this->setVlrTotal($vlrTotal);
        $this->setVlrFrete($vlrFrete);
        $this->setFormaPagto($formaPagto);
        $this->setQtdParcelas($qtdParcelas);
        $this->setTipoFrete($tipoFrete);
        $this->setTipoPedido($tipoPedido);
        $this->setBandeira($bandeira);
    }

    function validaInsert() {
        $return = true;

        if (!$this->idCliente) {
            echo Sistema::msgDanger('Obrigatório informar o ID do cliente para inserir o pedido');
            $return = false;
        }

        if (!$this->idEndereco) {
            echo Sistema::msgDanger('Obrigatório informar o ID do Endereco para inserir o pedido');
            $return = false;
        }

        if (!$this->vlrTotal) {
            echo Sistema::msgDanger('Obrigatório informar o Valor do pedido para inserir');
            $return = false;
        }

        if (!$this->idPedidoLoja) {
            echo Sistema::msgDanger('Obrigatório informar o ID do pedido da Loja (CS) para inserir no banco');
            $return = false;
        }

        if (!$this->tipoPedido) {
            echo Sistema::msgDanger('Obrigatório informar o tipo de Pedido do cliente para inserir no banco (01-Normal | 02-Reenvio | 03-Reenvio Parcial)');
            $return = false;
        }

        return $return;
    }

    function getIdPedidoLoja() {
        return $this->idPedidoLoja;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getIdEndereco() {
        return $this->idEndereco;
    }

    function getVlrTotal() {
        return $this->vlrTotal;
    }

    function getVlrFrete() {
        return $this->vlrFrete;
    }

    function getFormaPagto() {
        return $this->formaPagto;
    }

    function getQtdParcelas() {
        return $this->qtdParcelas;
    }

    function getTipoFrete() {
        return $this->tipoFrete;
    }

    function getTipoPedido() {
        return $this->tipoPedido;
    }

    function setIdPedidoLoja($idPedidoLoja) {
        $this->idPedidoLoja = $idPedidoLoja;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setIdEndereco($idEndereco) {
        $this->idEndereco = $idEndereco;
    }

    function setVlrTotal($vlrTotal) {
        $this->vlrTotal = $vlrTotal;
    }

    function setVlrFrete($vlrFrete) {
        $this->vlrFrete = $vlrFrete;
    }

    function setFormaPagto($formaPagto) {
        $this->formaPagto = $formaPagto;
    }

    function getBandeira() {
        return $this->bandeira;
    }

    function setBandeira($bandeira) {
        $this->bandeira = $bandeira;
    }

    function setQtdParcelas($qtdParcelas) {
        $this->qtdParcelas = $qtdParcelas;
    }

    function setTipoFrete($tipoFrete) {
        $this->tipoFrete = $tipoFrete;
    }

    function setTipoPedido($tipoPedido) {
        $this->tipoPedido = $tipoPedido;
    }

}
