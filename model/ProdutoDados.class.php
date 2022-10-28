<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutoDados
 *
 * @author licivando
 */
class ProdutoDados extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function getDadosProdutos($filtros = []) {
        $query = "
            select 
                *,
                (select idLojaIntegrada from p_editoras pe where pe.id_editora_externo = hs.COD_EDITORA and pe.id_loja = :id_loja limit 1) as idMarca
            from hs_produtos hs where hs.id_loja = :id_loja";
        $params = [
            ":id_loja" => Config::ID_LOJA
        ];
        $ignorados = ["inIds", "limit"];
        if (count($filtros) > 0) {
            foreach ($filtros as $k => $valor) {
                if ($k == 'idTerceiroMaiorQue') {
                    $query .= " and idTerceiro > :idTerceiro";
                    $params[":idTerceiro"] = $valor;
                } elseif (!in_array($k, $ignorados)) {
                    $query .= " and {$k} = :{$k} ";
                    $params[":$k"] = $valor;
                }
            }
        }
        
        if (isset($filtros['inIds']) && count($filtros["inIds"]) > 0) {
            $ids = implode(",", $filtros["inIds"]);
            $query .= " and COD_ITEM in ($ids)";
        }

        if (isset($filtros['limit']) && $filtros['limit'] != false) {
            $query .= " limit :limit ";
            $params[":limit"] = $filtros['limit'];
        }

        $this->executeSQL($query, $params);
        $this->getListaDeProdutos();

        if ($this->totalDatas() > 0) {
            return $this->getDatas();
        } else {
            return false;
        }
    }

    private function getListaDeProdutos() {
        $i = 1;




        while ($list = $this->listDatas()) :
            $price = $list["VLR_CAPA"];
            $tipo = "Livros";
            if (preg_match('/PAPELARIA/', $list["NOM_GRUPO_ITEM"])) {
                $tipo = "Papelaria";
            } elseif (preg_match('/JOGOS/', $list["NOM_GRUPO_ITEM"])) {
                $tipo = "Jogos e Brinquedos";
            }
            if ($list['idMarca'] > 0) {
                $this->datas[$i] = array(
                    "id" => $list["idTerceiro"],
                    "sku" => $list["COD_BARRA_ITEM"],
                    "codItem" => $list["COD_ITEM"],
                    "name" => $list["NOM_ITEM"],
                    "group" => $list["NOM_GRUPO_ITEM"],
                    "typeProduct" => $tipo,
                    "description" => $list["DESC_SINOPSE"],
                    "weight" => (string) ($list["PESO_ITEM"] / 1000),
                    "visibility" => 4,
                    "manage_stock" => true,
                    "is_in_stock" => 1,
                    "status" => true,
                    "numero_edicao" => $list['EDICAO'],
                    "numero_paginas" => $list["QTD_PAGINAS"],
                    "peso" => $list["PESO_ITEM"] / 1000,
                    "ean" => $list["COD_BARRA_ITEM"],
                    "autor" => str_replace("AUTOR: ", "", $list["AUTORES_GERAIS_TIPO"]),
                    "editora" => $list["NOM_EDITORA"],
                    "marca" => [$list["NOM_EDITORA"]],
//                "Autor" => str_replace("AUTOR: ", "", $list["AUTORES_GERAIS_TIPO"]),
                    "qty" => (int) $list["SALDO_DISPONIVEL"],
                    "price" => (string) $price,
                    "ncm" => $list["TIPO"],
                    "altura" => $list["COMPRIMENTO_ITEM"] > 0 ? $list["COMPRIMENTO_ITEM"] : Config::COMPRIMENTO_DEFAULT,
                    "largura" => $list["LARGURA_ITEM"] > 0 ? $list["LARGURA_ITEM"] : Config::LARGURA_DEFAULT,
                    "profundidade" => $list["ALTURA_ITEM"] > 0 ? $list["ALTURA_ITEM"] : Config::ALTURA_DEFAULT,
                    "length" => $list["COMPRIMENTO_ITEM"] > 0 ? $list["COMPRIMENTO_ITEM"] : Config::COMPRIMENTO_DEFAULT,
                    "width" => $list["LARGURA_ITEM"] > 0 ? $list["LARGURA_ITEM"] : Config::LARGURA_DEFAULT,
                    "height" => $list["ALTURA_ITEM"] > 0 ? $list["ALTURA_ITEM"] : Config::ALTURA_DEFAULT,
                    "weight" => (string) ($list["PESO_ITEM"] / 1000),
                );

                $i ++;
            } else {
                echo Sistema::msgAlert("Não encontrou o ID da marca para loja integrada {$list["NOM_EDITORA"]}");
            }

        endwhile;
    }

}
