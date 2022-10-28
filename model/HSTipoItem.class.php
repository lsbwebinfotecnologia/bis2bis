<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSTipoItem
 *
 * @author licivando
 */
class HSTipoItem extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function insertTipo($data = array()) {//verifica se a editora existe e cadastra caso necessário
        $columnsInserts = [
            "id_loja" => Config::ID_LOJA,
            "status" => '1',
            "nome" => $data->TIPO,
            "id_tipo_externo"=>0,
            "data_atualizacao" => $data->DAT_ULT_ATL
        ];

        $idTipo = $this->insertTable('p_tipo_produto', $columnsInserts);

        if ($idTipo) {
            $dataSet = ["id_tipo_externo" => $idTipo];
            $dataWhere = ["id_loja" => Config::ID_LOJA, "id_tipo_produto" => $idTipo];
            if ($this->updateTable('p_tipo_produto', $dataSet, $dataWhere)) {
                return $idTipo;
            } else {
                echo Sistema::msgErroDanger("Erro ao atualizar tipo do item {$data->TIPO} no Eros");
                return false;
            }
        } else {
            echo Sistema::msgErroDanger("Erro ao inserir tipo do item {$data->TIPO} no Eros");
            return false;
        }
    }

    function getTiposItem($tipoERP = false) {//COMO NÃO VEM NO JSON O CODITO TIPO, É CONSIDERADO O NOME E COM ID MAIOR
        $query = "SELECT id_tipo_produto, nome, id_tipo_externo, data_atualizacao FROM p_tipo_produto WHERE id_loja = :id_loja ";
        $params = array(
            ':id_loja' => Config::ID_LOJA
        );

        if ($tipoERP) {
            $query .= " and nome = :nome order by id_tipo_produto desc limit 1";
            $params[':nome'] = $tipoERP;
        }

        $this->executeSQL($query, $params);
        $this->getListTipos();

        return $this->getDatas();
    }

    private function getListTipos() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$list['nome']] = array(
                'id_tipo_produto' => $list['id_tipo_produto'],
                'id_tipo_externo' => $list['id_tipo_externo'],
                'nome' => $list['nome'],
                'data_atualizacao' => $list['data_atualizacao'],
            );

            $i ++;
        endwhile;
    }

}
