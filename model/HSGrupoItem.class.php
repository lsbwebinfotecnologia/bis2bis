<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSGrupoItem
 *
 * @author licivando
 */
class HSGrupoItem extends Conexao {//TRABALHA COM APENAS O CODIGO DO GRUPO EXTERNO
    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function insertGrupo($data = array()) {//verifica se a editora existe e cadastra caso necessário

        $columnsInserts = [
            "id_loja" => Config::ID_LOJA,
            "status" => '1',
            "nome" => $data->NOM_GRUPO_ITEM,
            "id_grupo_externo" => $data->COD_GRUPO_ITEM,
            "data_atualizacao" => $data->DAT_ULT_ATL
        ];

        $id = $this->insertTable('p_grupo_item', $columnsInserts);
        
        if($id){
            return $id;
        }else{
            echo Sistema::msgErroDanger("Erro ao inserir grupo do item {$data->COD_GRUPO_ITEM} no Eros");
            return false;
        }
        
    }

    function getGruposItens($idGrupoERP = false) {

        $query = "SELECT id_grupo_externo, nome, id_grupo_item, data_atualizacao FROM p_grupo_item WHERE id_loja = :id_loja ";
        $params = array(
            ':id_loja' => Config::ID_LOJA,
        );

        if ($idGrupoERP) {
            $query .= " and id_grupo_externo = :id_grupo_externo";
            $params[':id_grupo_externo'] = $idGrupoERP;
        }

        $this->executeSQL($query, $params);
        $this->getListGrupos();

        return $this->getDatas();
    }

    private function getListGrupos() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$list['id_grupo_externo']] = array(
                'id_grupo_item' => $list['id_grupo_item'],
                'id_grupo_externo' => $list['id_grupo_externo'],
                'nome' => $list['nome'],
                'data_atualizacao' => $list['data_atualizacao'],
            );

            $i ++;
        endwhile;
    }

}
