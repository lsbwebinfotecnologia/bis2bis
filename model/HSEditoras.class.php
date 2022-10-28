<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSEditoras
 *
 * @author licivando
 */
class HSEditoras extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function insertEditora($data = array()) {//INSERT EDITORA
        $columnsInserts = [
            "id_loja" => Config::ID_LOJA,
            "nome" => $data->NOM_EDITORA,
            "status" => "1",
            "data_atualizacao" => $data->DAT_ULT_ATL,
            "nom_fantasia" => $data->NOM_EDITORA,
            "id_editora_externo" => $data->COD_EDITORA,
        ];
        $id = $this->insertTable('p_editoras', $columnsInserts);
        if ($id) {
            return $id;
        } else {
            echo Sistema::msgErroDanger("Erro ao inserir editora {$data->COD_EDITORA} no Eros");
            return false;
        }
    }

    function editoraExiste($idEditora) {
        $query = "SELECT id_editora_externo FROM p_editoras WHERE id_loja = :id_loja and id_editora_externo = :idEditora";
        $params = array(
            ':id_loja' => Config::ID_LOJA,
            ":idEditora" => $idEditora
        );

        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getEditoras($filter=[]) {

        $query = "SELECT id_editora, concat(Upper(substr(nome, 1,1)), lower(substr(nome, 2,length(nome)))) as nome, id_editora_externo, data_atualizacao FROM p_editoras WHERE id_loja = :id_loja ";
        $params = array(
            ':id_loja' => Config::ID_LOJA,
        );

        if (isset($filter['id_editora_externo'])) {
            $query .= " and id_editora_externo = :id_editora_externo";
            $params[':id_editora_externo'] = $filter['id_editora_externo'];
        }

        if (isset($filter['integrado'])) {
            $query .= " and integrado = :integrado";
            $params[':integrado'] = $filter['integrado'];
        }

        $this->executeSQL($query, $params);

        $this->getListEditoras();

        return $this->getDatas();
    }

    private function getListEditoras() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$list['id_editora_externo']] = array(
                'id_editora' => $list['id_editora'],
                'id_editora_externo' => $list['id_editora_externo'],
                'nome' => $list['nome'],
                'data_atualizacao' => $list['data_atualizacao'],
            );
            $i ++;
        endwhile;
    }

}
