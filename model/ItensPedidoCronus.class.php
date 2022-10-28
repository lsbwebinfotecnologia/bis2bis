<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItensPedidoCronus
 *
 * @author licivando
 */
class ItensPedidoCronus extends Conexao {

    public $idPedidoLoja, $idOrderCronus, $idItemErp, $idItemCronus, $vlrLiquido, $vlrDesconto, $vlrBruto, $qtd;

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function insertItemOrder($dataItens = array()) {

        if ($dataItens) {
            $this->prepare($dataItens);
        }

        if (!$this->itemExistInOrder($this->idItemCronus, $this->idOrderCronus)) {//VERIFICA TAMBEM SE O ITEM JA EXISTE NO PEDIDO PARA NAO DUPLICAR
            if ($this->verifyItem()) {
                $eventos = new EventosCronus();
                $columnsInserts = [
                    "id_venda" => $this->idOrderCronus,
                    "prod_id" => $this->idItemCronus,
                    "quantidade" => $this->qtd,
                    "val_unit" => $this->vlrLiquido,
                    "preco_bruto" => $this->vlrBruto,
                    "desconto" => 0,
                    "desconto_cupom" => 0,
                    "preco_liq" => $this->vlrBruto,
                    "id_loja" => Config::ID_LOJA
                ];
                $eventos->insertTable('l_itens_vendas', $columnsInserts);
            }
        }else{
            $msg = "O item <b>{$this->idItemCronus}</b> já consta no pedido <b>{$this->idOrderCronus}</b>, o mesmo não será inserido novamente! <br>";
            echo Sistema::msgAlert($msg);
        }
    }

    function verifyItem() {
        $return = true;

        if (!$this->idItemCronus) {
            echo Sistema::msgDanger("Não foi encontrado o idCronus do produto <b>{$this->idItemErp}</b> ");
            $return = false;
        } //JA VERIFICOU QUE TEM O ID DO ITEM DO CRONUS

        if (!$this->idOrderCronus) {
            echo Sistema::msgDanger("Não foi encontrado o idCronus para o pedido <b>{$this->idPedidoLoja} da loja </b> ");
            $return = false;
        }

        if (!$this->qtd) {
            echo Sistema::msgDanger("Necessário informar a quantidade do produto <b>{$this->idItemCronus}</b> para inserir no banco ");
            $return = false;
        }

        if (!$this->vlrBruto) {
            echo Sistema::msgDanger("Necessario informar o valor bruto do item <b>{$this->idPedidoLoja} para o pedido </b> ");
            $return = false;
        }

        if (!$return) {
            $this->deleteItensDoPedidoIncompleto($this->idPedidoLoja); //APAGANDO OS ITENS DO PEDIDO
            $this->deletePedidoIncompleto($this->idPedidoLoja);
            echo Sistema::msgDanger("Os itens do pedido da loja <b>{$this->idPedidoLoja}</b> foram apagados juntamente com o pedido");
        }

        return $return;
    }

    function prepare($dataItens = array()) {

        $idItemErp = isset($dataItens['idItemErp']) ? $dataItens['idItemErp'] : false;
        $idPedidoLoja = isset($dataItens['idOrderLoja']) ? $dataItens['idOrderLoja'] : false;
        $qtd = isset($dataItens['qtd']) ? $dataItens['qtd'] : false;
        $vlrItem = isset($dataItens['vlrItem']) ? $dataItens['vlrItem'] : false;
        $idOrderCronus = $this->getIdOrderCronus($idPedidoLoja) != false ? $this->getIdOrderCronus($idPedidoLoja) : false;
        $idItemCronus = $this->getIdItemCronus($idItemErp) != false ? $this->getIdItemCronus($idItemErp) : false;

        $this->setIdItemErp($idItemErp);
        $this->setIdPedidoLoja($idPedidoLoja);
        $this->setQtd($qtd);
        $this->setVlrBruto($vlrItem * $qtd);
        $this->setVlrLiquido($vlrItem);
        $this->setIdOrderCronus($idOrderCronus);
        $this->setIdItemCronus($idItemCronus);
    }

    function getIdOrderCronus($idPedidoLoja = false) {

        $idOrder = $this->idPedidoLoja;
        if ($idPedidoLoja) {
            $idOrder = $idPedidoLoja;
        }

        $query = "SELECT v_id FROM l_vendas where id_pedido_loja = :id_pedido_loja AND id_loja = :id_loja";

        $params = array(
            ':id_pedido_loja' => $idOrder,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {
            return $this->listDatas()['v_id'];
        } else {
            return false;
        }
    }

    function getIdItemCronus($idItemERP) {
        $query = "SELECT p_id FROM p_produtos WHERE id_loja = :id_loja and id_item_externo = :id_item_externo order by p_id desc limit 1";
        $params = array(
            "id_loja" => Config::ID_LOJA,
            "id_item_externo" => $idItemERP
        );
        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {
            return $this->listDatas()['p_id'];
        } else {
            echo '<strong style="color: red">ATENÇÃO</strong> -><strong>Pedido não importado, pois, não existe o item ' . $idItemERP . ' na BD!</strong><br>';
            return false;
        }
    }

    function deletePedidoIncompleto($idPedidoLoja) {
        $query = "DELETE FROM `l_vendas` WHERE id_pedido_loja = :id_pedido_loja AND id_loja = :id_loja";

        $params = array(
            ':id_pedido_loja' => $idPedidoLoja,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);
    }

    function deleteItensDoPedidoIncompleto($idPedidoLoja) {

        $idVenda = $this->getIdOrderCronus($idPedidoLoja);

        $query = "DELETE FROM `l_itens_vendas` WHERE id_venda = :id_venda AND id_loja = :id_loja";

        $params = array(
            ':id_venda' => $idVenda,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);
    }

    function itemExistInOrder($idItemCronus, $idOrderCronus) {
        $query = "SELECT id_item FROM `l_itens_vendas` WHERE id_venda = :id_venda AND prod_id = :prod_id AND id_loja = :id_loja";

        $params = array(
            ':id_venda' => $idOrderCronus,
            ':prod_id' => $idItemCronus,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getIdPedidoLoja() {
        return $this->idPedidoLoja;
    }

    function getIdItemErp() {
        return $this->idItemErp;
    }

    function getVlrLiquido() {
        return $this->vlrLiquido;
    }

    function getVlrDesconto() {
        return $this->vlrDesconto;
    }

    function getVlrBruto() {
        return $this->vlrBruto;
    }

    function setIdPedidoLoja($idPedidoLoja) {
        $this->idPedidoLoja = $idPedidoLoja;
    }

    function setIdItemErp($idItemErp) {
        $this->idItemErp = $idItemErp;
    }

    function setVlrLiquido($vlrLiquido) {
        $this->vlrLiquido = $vlrLiquido;
    }

    function setVlrDesconto($vlrDesconto) {
        $this->vlrDesconto = $vlrDesconto;
    }

    function setVlrBruto($vlrBruto) {
        $this->vlrBruto = $vlrBruto;
    }

    function getQtd() {
        return $this->qtd;
    }

    function setQtd($qtd) {
        $this->qtd = $qtd;
    }

    function setIdOrderCronus($idOrderCronus) {
        $this->idOrderCronus = $idOrderCronus;
    }

    function setIdItemCronus($idItemCronus) {
        $this->idItemCronus = $idItemCronus;
    }

}
