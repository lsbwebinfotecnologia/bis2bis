<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosItensAdmin
 *
 * @author licivando
 */
class PedidosItensAdmin extends Conexao{
    //put your code here
    public $qtdTotalItens, $vlrTotalProdutos, $vlrTotalDesconto, $pesoTotal;
    
    public function __construct() {
        parent::__construct();
    }
    
    function getItensPedido($idPedido) {
        $query = "
            SELECT
                prod_id,
                desconto,
                desconto_cupom,
                quantidade,
                preco_bruto,
                preco_liq,
                val_unit,
                (SELECT PESO_ITEM FROM hs_produtos WHERE idProduto = liv.prod_id AND id_loja = :id_loja) AS peso,
                (SELECT NOM_ITEM FROM hs_produtos WHERE idProduto = liv.prod_id AND id_loja = :id_loja) AS titulo,
                (SELECT COD_ITEM FROM hs_produtos WHERE idProduto = liv.prod_id AND id_loja = :id_loja) AS id_item_externo,
                (SELECT COD_BARRA_ITEM FROM hs_produtos WHERE idProduto = liv.prod_id AND id_loja = :id_loja) AS isbn 
            FROM l_itens_vendas liv 
            WHERE id_venda = :id_venda 
            AND id_loja = :id_loja
        ";
        $params =[
            ":id_loja"=> Config::ID_LOJA,
            ":id_venda"=>$idPedido
        ];
        $this->executeSQL($query, $params);
        $this->getListaDeItens();
                
    }
    
    function getPesoTotal() {
        return $this->pesoTotal;
    }

    function setPesoTotal($pesoTotal) {
        $this->pesoTotal = $pesoTotal;
    }

        
    function getTotalDescontoCupom($idPedido) {
        $query = "
            SELECT 
                total_desc 
            FROM l_vendas  
            WHERE v_id = :id_venda and id_loja = :id_loja 
        ";
        $params =[
            ":id_loja"=> Config::ID_LOJA,
            ":id_venda"=>$idPedido
        ];
        $this->executeSQL($query, $params);
        return $this->listDatas()['total_desc'];
    }

    
    function getQtdTotalItens() {
        return $this->qtdTotalItens;
    }

    function setQtdTotalItens($qtdTotalItens) {
        $this->qtdTotalItens = $qtdTotalItens;
    }
    
    
    function getVlrTotalProdutos() {
        return $this->vlrTotalProdutos;
    }

    function getVlrTotalDesconto() {
        return $this->vlrTotalDesconto;
    }

    function setVlrTotalProdutos($vlrTotalProdutos) {
        $this->vlrTotalProdutos = $vlrTotalProdutos;
    }

    function setVlrTotalDesconto($vlrTotalDesconto) {
        $this->vlrTotalDesconto = $vlrTotalDesconto;
    }

    private function getListaDeItens() {
        $i = 1;

        $vlrTotalProduto = 0;
        $vlrTotalDesconto = 0;
        $pesoTotal = 0;
        while ($list = $this->listDatas()) :
            
            $this->datas[$i] = array(
                'p_id' => $list['prod_id'],
                'desconto' => Sistema::MoedaBR(($list['desconto'] / $list['quantidade'])),
                'desconto_cupom' => Sistema::MoedaBR(($list['desconto_cupom'] / $list['quantidade'])),
                'quantidade' => $list['quantidade'],
                'valor_vendido'=> Sistema::MoedaBR(($list['val_unit'] - (($list['desconto_cupom'] / $list['quantidade']) + ($list['desconto'] / $list['quantidade'])))),
                'total'=> Sistema::MoedaBR((($list['val_unit'] - ($list['desconto'] / $list['quantidade'])) - ($list['desconto_cupom'] / $list['quantidade'])) * $list['quantidade']),
                'preco_bruto' => Sistema::MoedaBR($list['preco_bruto']),
                'preco_liq' => Sistema::MoedaBR($list['preco_liq']),
                'precoBrutoBD' => $list['preco_bruto'],
                'precoLiquidoBD' => $list['preco_liq'],
                'val_unit' => Sistema::MoedaBR($list['val_unit']),
                'id_item_externo' => $list['id_item_externo'],
                'titulo' => $list['titulo'],
//                'urlImg'=> Rotas::get_UrlImagesPadrao() . '/' . Sistema::imgExist($list['isbn']),
                'isbn' => $list['isbn']
                
            );
            
            $pesoTotal += $list["peso"] * $list ["quantidade"];	
            $vlrTotalProduto += $list ["val_unit"] * $list ["quantidade"];
            $vlrTotalDesconto += $list['desconto'];
            
            $i ++;
        endwhile;
        $this->setPesoTotal($pesoTotal);
        $this->setVlrTotalProdutos($vlrTotalProduto);
        $this->setVlrTotalDesconto($vlrTotalDesconto);
        $this->setQtdTotalItens($i - 1);
    }
}
