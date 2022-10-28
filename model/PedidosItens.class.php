<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosItens
 *
 * @author licivando
 */
class PedidosItens extends Conexao {

    public $idPedido;

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function insertItensPedido($dataItens = array()) {

        //var_dump($this->idPedido);

        if (!$this->idPedido) {
            var_dump("Necessário informar o Id do pedido para inserir os itens");
        } else {
            $vlrDescUnitario = 0;

            if ($dataItens) {

                //$qtdTitulos = count($dataItens);

                foreach ($dataItens as $itemCart) {
                    $isbn = $itemCart['product_id'];

                    if ($this->getIdItem($isbn)) {

                        $pId = $this->getIdItem($isbn);
                        $vlrDescUnitario = ($itemCart['original_price'] - $itemCart['special_price']);
                        $query = "
                        INSERT INTO `l_itens_vendas`
                        (`id_venda`, `prod_id`, `quantidade`, `val_unit`, `preco_bruto`, `desconto`, `desconto_cupom`, `preco_liq`, `id_loja`, `data`) 
                        VALUES 
                        (:id_venda, :prod_id, :quantidade, :val_unit, :preco_bruto, :desconto, :desconto_cupom, :preco_liq, :id_loja, NOW());
                    ";
                        $params = array(
                            ":id_venda" => $this->idPedido,
                            ":prod_id" => $pId,
                            ":quantidade" => $itemCart['qty'],
                            ":val_unit" => number_format(($itemCart['original_price']), 4, '.', ''),
                            ":preco_bruto" => $itemCart['original_price'] * (int) $itemCart['qty'],
                            ":desconto" => $vlrDescUnitario,
                            ":desconto_cupom" => 0, //((($produto["preco"]*$qntd)*($percentualCupom['desconto']))/100),
                            ":preco_liq" => number_format(($itemCart['original_price'] * $itemCart['qty']) - $vlrDescUnitario, 4, '.', ''),
                            ":id_loja" => Config::ID_LOJA
                        );
                        $this->executeSQL($query, $params);
                        $this->subtrairUnidades($pId, $itemCart['qty']);
                    } else {
                        echo 'Não econtrou o id do isbn ' . $isbn . ' na BD <br>';
                    }
                }
            } else {
                echo 'Necessário informar os itens do Pedido';
            }
        }
    }

    function getIdItem($isbn) {
        $query = "SELECT p_id FROM p_produtos WHERE id_loja = :id_loja and isbn = :isbn order by p_id desc limit 1";
        $params = array(
            "id_loja" => Config::ID_LOJA,
            "isbn" => $isbn
        );
        $this->executeSQL($query, $params);
        $retorno = $this->listDatas();

        if ($retorno) {
            return $retorno['p_id'];
        } else {
            echo '<strong style="color: red">ATENÇÃO</strong> -><strong>Pedido não importado, pois, não existe o item ' . $isbn . ' na BD!</strong><br>';
            $this->deleteItensDoPedidoIncompleto($this->idPedido);
            $this->deleteHistoricoPedido($this->idPedido);
            $this->deletePedidoIncompleto($this->idPedido);
            return false;
        }
    }
    
    function subtrairUnidades($idProduto, $qtd) {
        $query = " update p_produtos set unidades = :qtd, updateSaldoSkyhub = 'S' where p_id = :id_produto and id_loja = :id_loja ";
        $params = [
            ":id_loja" => Config::ID_LOJA,
            ":qtd"=>$qtd,
            ":id_produto"=>$idProduto
        ];
        
        $this->executeSQL($query, $params);
    }

    function deletePedidoIncompleto($idPedido) {
        $query = "DELETE FROM `l_vendas` WHERE v_id = :v_id AND id_loja = :id_loja";

        $params = array(
            ':v_id' => $idPedido,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);
    }
    
    function deleteHistoricoPedido($idPedido) {
        $query = "DELETE FROM `l_vendas_historico` WHERE id_venda = :id_venda AND id_loja = :id_loja";

        $params = array(
            ':id_venda' => $idPedido,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);
    }

    function deleteItensDoPedidoIncompleto($idVenda) {
        $query = "DELETE FROM `l_itens_vendas` WHERE id_venda = :id_venda AND id_loja = :id_loja";

        $params = array(
            ':id_venda' => $idVenda,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);
    }

    function getIdPedido() {
        return $this->idPedido;
    }

    function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

}
