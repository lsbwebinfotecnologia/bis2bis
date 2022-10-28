<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSSelos
 *
 * @author licivando
 */
class HSSelos extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function insertSelo($data = array()) {//INSERT EDITORA
        $columnsInserts = [
            "id_loja" => Config::ID_LOJA,
            "nome_selo" => $data->SELO,
            "status" => "1",
            "data_atualizacao" => $data->DAT_ULT_ATL,
        ];
        $idSelo = $this->insertTable('p_selos', $columnsInserts);

        if ($idSelo) {
            $dataSet = ["id_selo_externo" => $idSelo];
            $dataWhere = ["id_loja" => Config::ID_LOJA, "id_selo" => $idSelo];
            if ($this->updateTable('p_selos', $dataSet, $dataWhere)) {
                return $idSelo;
            } else {
                echo Sistema::msgErroDanger("Erro ao atualizar selo do item {$data->SELO} no Eros");
                return false;
            }
        } else {
            echo Sistema::msgErroDanger("Erro ao inserir selo do item {$data->SELO} no Eros");
            return false;
        }
    }

    function getSelos($seloERP = false) {//COMO NÃO VEM NO JSON O CODITO SELO, É CONSIDERADO O NOME E COM ID MAIOR
        $query = "SELECT * FROM p_selos WHERE id_loja = :id_loja ";
        $params = array(
            ':id_loja' => Config::ID_LOJA
        );

        if ($seloERP) {
            $query .= " and nome_selo = :nome_selo order by id_selo desc limit 1";
            $params[':nome_selo'] = $seloERP;
        }

        $this->executeSQL($query, $params);
        $this->getListSelos();

        return $this->getDatas();
    }

    private function getListSelos() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$list['nome_selo']] = array(
                'id_selo' => $list['id_selo'],
                'id_selo_externo' => $list['id_selo_externo'],
                'nome_selo' => $list['nome_selo'],
                'data_atualizacao' => $list['data_atualizacao'],
            );

            $i ++;
        endwhile;
    }

}
