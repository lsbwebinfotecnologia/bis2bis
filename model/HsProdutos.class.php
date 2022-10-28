<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produtos
 *
 * @author licivando
 */
class HsProdutos extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function getItensHorus($dataIdsERP = array()) {
        $query = "select COD_ITEM, idProduto, DAT_ULT_ATL from hs_produtos WHERE id_loja = :id_loja";
        $params = [
            ":id_loja" => Config::ID_LOJA,
        ];

        if ($dataIdsERP) {
            $qtdIds = count($dataIdsERP);
            $ids = "";
            $c = 1;
            foreach ($dataIdsERP as $id) {
                if ($c == $qtdIds) {//SE FOR IGUAL AO TOTAL DE IDS DO RETORNO COLOCA SEM A VIRGULA
                    $ids .= $id;
                } else {
                    $ids .= $id . ", ";
                }
                $c ++;
            }
            //$params[":ids"] = ' (' . filter_var($ids, FILTER_SANITIZE_STRIPPED) . ')';

            $query .= " and COD_ITEM in ($ids) "; //ESTA COM INJECTION, VERIFICAR COMO TIRAR
//            var_dump($params);
        }

        $this->executeSQL($query, $params);
        $this->getListItens();

        return $this->getDatas();
    }

    function getProdutos($filtro = []) {
        $query = "
            select 
                *,
                (select pe.idLojaIntegrada from p_editoras pe where pe.id_editora_externo = hp.COD_EDITORA order by id_editora desc limit 1) as idEditoraLojaIntegrada 
            from hs_produtos hp
            WHERE hp.id_loja = :id_loja ";
        $params = [
            ":id_loja" => Config::ID_LOJA
        ];

        $complementPaginacao = " WHERE hp.id_loja = :id_loja ";

        if (isset($filtro['integrado'])) {
            $query .= " and hp.integrado = :integrado ";
            $params[":integrado"] = $filtro['integrado'];
            $complementPaginacao .= " and hp.integrado = :integrado  ";
        }
        
        if (isset($filtro['titulo']) && $filtro['titulo']) {
            $query .= " and hp.NOM_ITEM like :NOM_ITEM ";
            $params[":NOM_ITEM"] = '%'.$filtro['titulo'].'%';
            $complementPaginacao .= " and hp.NOM_ITEM = :NOM_ITEM  ";
        }
        
        if (isset($filtro['sku']) && $filtro['sku']) {
            $query .= " and hp.cod_barra_item = :cod_barra_item ";
            $params[":cod_barra_item"] = $filtro['sku'];
            $complementPaginacao .= " and hp.cod_barra_item = :cod_barra_item  ";
        }
        
        $query .= " order by idProduto desc ";
        

        $query .= $this->paginacaoLinks('hp.idProduto', "hs_produtos hp $complementPaginacao ", $params);
        
        

        $this->executeSQL($query, $params);
        $this->getListProdutos();
        if ($this->totalDatas() > 0) {
            return $this->getDatas();
        } else {
            return [];
        }
    }

    function getTotalDeProdutos($filter = []) {
        $query = "
            select 
                count(idProduto) as total 
            from hs_produtos hp
            WHERE hp.id_loja = :id_loja ";
        $params = [
            ":id_loja" => Config::ID_LOJA
        ];
        $this->executeSQL($query, $params);
        return $this->listDatas()['total'];
    }

    private function getListProdutos() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$list['COD_ITEM']] = array(
                'idProduto' => $list['idProduto'],
                'COD_ITEM' => $list['COD_ITEM'],
                'COD_BARRA_ITEM' => $list['COD_BARRA_ITEM'],
                'NOM_ITEM' => $list['NOM_ITEM'],
                'DESC_SINOPSE' => $list['DESC_SINOPSE'],
                'PESO_ITEM' => $list['PESO_ITEM'],
                'COMPRIMENTO_ITEM' => $list['COMPRIMENTO_ITEM'],
                'LARGURA_ITEM' => $list['LARGURA_ITEM'],
                'ALTURA_ITEM' => $list['ALTURA_ITEM'],
                'SALDO_DISPONIVEL' => $list['SALDO_DISPONIVEL'],
                'CATEGORIAS' => $list['GENERO_NIVEL_1'],
                'EDITORA' => '/api/v1/marca/' . $list['idEditoraLojaIntegrada'],
                'IMG' => Sistema::imgExist($list["COD_BARRA_ITEM"]),
                'VLR_CAPA' => Sistema::MoedaBR($list['VLR_CAPA'])
            );

            $i ++;
        endwhile;
    }

    private function getListItens() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$list['COD_ITEM']] = array(
                'idProduto' => $list['idProduto'],
                'COD_ITEM' => $list['COD_ITEM'],
                'DAT_ULT_ATL' => $list['DAT_ULT_ATL'],
            );

            $i ++;
        endwhile;
    }

}
