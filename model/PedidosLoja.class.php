<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosLoja
 *
 * @author licivando
 */
class PedidosLoja extends Conexao{
    //put your code here
    public $idStatusProd, $tipoPagto, $vlrCupomDesconto, $idCliente, $idPedidoLoja, $totalComFrete, $prazo, $freteVlr, $freteTipo, $idItemBD, $retorno, $itensPedido=array();
    function __construct() {
        parent::__construct();
    }
    
    function newPedido() {
        $this->retorno = false;
        $query = "
            INSERT INTO `l_vendas` 
                (`id_pedido_loja`, `status_pag`, `total`, `total_desc`, `frete`, `prazo`, `id_cli`, `id_endereco`, `id_loja`, `obs`, `data`, `id_status_prod`, `freteMode`, `tipoPagto`) 
            VALUES 
                (:id_pedido_loja, '1', :total, :total_desc, :frete, :prazo, :id_cli, :id_endereco, :id_loja, :obs, NOW(), :id_status_prod, :freteMode, :tipoPagto);
        ";          
        
        $params = array(
            ":id_pedido_loja" => $this->idPedidoLoja,
            ":total" => $this->totalComFrete,
            ":total_desc" => 0,
            ":frete" => $this->freteVlr, //$freteValor,
            ":prazo" => $this->prazo,
            ":id_cli" => $this->idCliente,
            ":id_endereco" => 1,
            ":id_loja"=> Config::ID_LOJA,
            ":obs" => "",
            ":id_status_prod" => $this->idStatusProd,
            ":freteMode" => $this->freteTipo,
            ":tipoPagto" => $this->tipoPagto
        );
        
        $this->executeSQL($query, $params);
        $id_pedido = $this->lastInsertID();
        $this->insertItensPedido($id_pedido);
        //GRAVAR OS ITENS DO PEDIDO        
        
        $this->retorno = true;
        
        return $this->retorno;
        
    }
    
    function idStatusProd($status) {
        $query = "SELECT id_status FROM l_vendas_status where nome = :nome AND id_loja = :id_loja limit 1";
        
        $params = array(
            ':nome' => $status,
            ':id_loja' => Config::ID_LOJA
        );        
        
        $this->executeSQL($query, $params);       
        
        $pedidoBD = $this->listDatas();
        
        return $pedidoBD['id_status'];
    }
    
   
    function insertItensPedido($id_pedido) {
        $vlrDescUnitario = 0;
        $qtdTitulos = count($this->itensPedido);
        
        if($this->vlrCupomDesconto > 0){
            (float)$vlrDescUnitario = $this->vlrCupomDesconto / $qtdTitulos;
        }
        
        if($this->itensPedido){
            foreach ($this->itensPedido as $itemCart) {
                $this->setIdItemBD($itemCart['prodRef']);
                if($this->idItemBD){
                    $query = "
                        INSERT INTO `l_itens_vendas`
                        (`id_venda`, `prod_id`, `quantidade`, `val_unit`, `preco_bruto`, `desconto`, `desconto_cupom`, `preco_liq`, `id_loja`, `data`) 
                        VALUES 
                        (:id_venda, :prod_id, :quantidade, :val_unit, :preco_bruto, :desconto, :desconto_cupom, :preco_liq, :id_loja, NOW());
                    ";            
                    $params = array(
                        ":id_venda"=> $id_pedido,
                        ":prod_id"=> $this->idItemBD,
                        ":quantidade"=> $itemCart['qtd'],
                        ":val_unit"=>number_format($itemCart['precoUnit'] - ($vlrDescUnitario / $itemCart['qtd']), 4, '.', ''),
                        ":preco_bruto"=>$itemCart['precoUnit']* (int)$itemCart['qtd'],
                        ":desconto"=> ($itemCart["precoUnit"]*$itemCart['qtd'])-($itemCart['precoUnit']*$itemCart['qtd']),
                        ":desconto_cupom"=> $vlrDescUnitario / $itemCart['qtd'], //((($produto["preco"]*$qntd)*($percentualCupom['desconto']))/100),
                        ":preco_liq"=>number_format(($itemCart['precoUnit'] * $itemCart['qtd']) - $vlrDescUnitario, 4, '.', ''),
                        ":id_loja"=> Config::ID_LOJA
                    );            
                    $this->executeSQL($query, $params);
                }else{
                    echo 'Não econtrou o Item ' . $itemCart['prodRef'] . ' na BD <br>';
                }
                
            }
        }else{
            echo 'Necessário informar os itens do Pedido';
        }
        
    }
    
    function updateIdEnderecoPedido($idPedidoBD, $idEnderecoBD) {
        $query = "UPDATE `l_vendas` SET id_endereco = :id_endereco WHERE v_id = :v_id AND id_loja = :id_loja";
        
        $params = array(
            ':v_id' => $idPedidoBD,
            ':id_endereco' => $idEnderecoBD,
            ':id_loja' => Config::ID_LOJA
        );        
        
        $this->executeSQL($query, $params);   
    }
            
    function existePedidoNaBD($idPedidoLoja) {
        $query = "SELECT v_id FROM l_vendas where id_pedido_loja = :id_pedido_loja AND id_loja = :id_loja";
        
        $params = array(
            ':id_pedido_loja' => $idPedidoLoja,
            ':id_loja' => Config::ID_LOJA
        );        
        
        $this->executeSQL($query, $params);       
        
        $pedidoBD = $this->listDatas();
        
        return $pedidoBD['v_id'];
        
    }
    
    function deletePedidoIncompleto() {
        $query = "DELETE FROM `l_vendas` WHERE id_pedido_loja = :id_pedido_loja AND id_loja = :id_loja";
        
        $params = array(
            ':id_pedido_loja' => $this->idPedidoLoja,
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
    
    function getListPedidos() {
        $query = "
            SELECT 
                v_id,
                cod_pedido_erp,
                id_pedido_loja,
                lv.freteMode,
                lv.update_status_remetido, 
                (select nome from c_clientes cc where cc.id_cli = lv.id_cli and cc.id_loja = lv.id_loja) as cliente, 
                (select nome from l_vendas_status lvs where lvs.id_status = lv.id_status_prod and lvs.id_loja = lv.id_loja) as status, 
                id_status_prod,
                total, 
                pedido_exportado_erp,
                (select count(id_item) from l_itens_vendas liv where liv.id_venda = lv.v_id and liv.id_loja = lv.id_loja) as qtd_titulos,
                (select sum(quantidade) from l_itens_vendas liv where liv.id_venda = lv.v_id and liv.id_loja = lv.id_loja) as qtd_itens,
                DATE_FORMAT(data, '%d/%m/%Y (%H:%i)') AS data, 
                frete, 
                nro_nota_fiscal, 
                codigo_rastreio,
                chave_nfe 
            FROM feb.l_vendas lv 
            WHERE id_loja = :id_loja 
        ";
        $query .= " ORDER BY v_id desc";
        $query .= $this->paginacaoLinks("v_id", "l_vendas");
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA
        );
        
        $this->executeSQL($query, $params);
        
        $this->getListDataOrder();                
        
        return $this->getDatas();
        
    }
    
    function getIdPedido($idPedidoLoja) {
        $query = "SELECT v_id FROM l_vendas where id_pedido_loja = :id_pedido_loja AND id_loja = :id_loja";
        
        $params = array(
            ':id_pedido_loja' => $idPedidoLoja,
            ':id_loja' => Config::ID_LOJA
        );        
        
        $this->executeSQL($query, $params);       
        
        $pedidoBD = $this->listDatas();
        
        return $pedidoBD['v_id'];
    }
    
    function getIdCliente() {
        return $this->idCliente;
    }

    function getIdPedidoLoja() {
        return $this->idPedidoLoja;
    }

    function getTotalComFrete() {
        return $this->totalComFrete;
    }
    function getVlrCupomDesconto() {
        return $this->vlrCupomDesconto;
    }

    function setVlrCupomDesconto($vlrCupomDesconto) {
        $this->vlrCupomDesconto = $vlrCupomDesconto;
    }

    function getIdItemBD() {
        return $this->idItemBD;
    }

    function setIdItemBD($idItemERP) {
        $query = "SELECT p_id FROM p_produtos WHERE id_loja = :id_loja and id_item_externo = :id_item_externo order by p_id desc limit 1";
        $params = array (
            "id_loja"=> Config::ID_LOJA,
            "id_item_externo" => $idItemERP
        );
        $this->executeSQL($query, $params);
        $retorno = $this->listDatas();
        
        if($retorno){
            $this->idItemBD = $retorno['p_id'];
            return $this->idItemBD;
        }else{
            echo '<strong style="color: red">ATENÇÃO</strong> -><strong>Pedido não importado, pois, não existe o item '. $idItemERP . ' na BD!</strong><br>';
            $this->deleteItensDoPedidoIncompleto($this->getIdPedido($this->idPedidoLoja));
            $this->deletePedidoIncompleto();

        }        
    }
        
    function getPrazo() {
        return $this->prazo;
    }

    function getFreteVlr() {
        return $this->freteVlr;
    }

    function getFreteTipo() {
        return $this->freteTipo;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }
    function getItensPedido() {
        return $this->itensPedido;
    }

    function setItensPedido($itensPedido) {
        $this->itensPedido = $itensPedido;
    }

    function setIdPedidoLoja($idPedidoLoja) {
        $this->idPedidoLoja = $idPedidoLoja;
    }

    function setTotalComFrete($totalComFrete) {
        $this->totalComFrete = $totalComFrete;
    }

    function getIdStatusProd() {
        return $this->idStatusProd;
    }

    function getTipoPagto() {
        return $this->tipoPagto;
    }

    function setIdStatusProd($status) {        
        $this->idStatusProd($status);
        $this->idStatusProd = $this->idStatusProd($status);
    }

    function setTipoPagto($tipoPagto) {
        $this->tipoPagto = $tipoPagto;
    }

        
    function getRetorno() {
        return $this->retorno;
    }

    function setRetorno($retorno) {
        $this->retorno = $retorno;
    }

    function setPrazo($prazo) {
        $this->prazo = $prazo;
    }

    function setFreteVlr($freteVlr) {
        $this->freteVlr = $freteVlr;
    }

    function setFreteTipo($freteTipo) {
        $this->freteTipo = $freteTipo;
    }
    private function getListDataOrder() {
        $i = 1;       
        while ($list = $this->listDatas()) :            
            $this->datas[$i] = array(
                'v_id' => $list['v_id'],
                'cliente' => $list['cliente'],
                'cod_pedido_erp' => $list['cod_pedido_erp'],
                'id_pedido_loja' => $list['id_pedido_loja'],
                'qtd_titulos' => $list['qtd_titulos'],
                'qtd_itens' => $list['qtd_itens'],
                'total' => $list['total'],
                'totalBR' => Sistema::MoedaBR($list['total']),
                'data' => $list['data'],
                'freteMode' => $list['freteMode'],
                'id_status_prod' => $list['id_status_prod'],
                'frete' => $list['frete'],
                'codigo_rastreio' => $list['codigo_rastreio'],
                'nro_nota_fiscal' => $list['nro_nota_fiscal'],
                'status' => $list['status'],
                'pedido_exportado_erp' => $list['pedido_exportado_erp'],
                'chave_nfe' => $list['chave_nfe'],
                'remetido' => $list['update_status_remetido']
            );            
            $i ++;
        endwhile;
    }
}
