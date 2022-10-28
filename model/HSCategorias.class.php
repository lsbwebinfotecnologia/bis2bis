<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSCategorias
 *
 * @author licivando
 */
class HSCategorias extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function insertCategoria($data = array()) {//verifica se a categoria existe e cadastra caso necessário
        $columnsInserts = [
            "id_loja" => Config::ID_LOJA,
            "nome" => $data->GENERO_NIVEL_1,
            "id_categoria_externo" => $data->COD_GENERO,
            "data_atualizacao" => $data->DAT_ULT_ATL
        ];
        $id = $this->insertTable('p_categorias', $columnsInserts);

        if ($id) {
            return $id;
        } else {
            echo Sistema::msgErroDanger("Erro ao inserir categoria {$data->GENERO_NIVEL_1} no Eros");
            return false;
        }
    }
    

    function getCategorias($idCategoriaERP = false, $integrado=true) {

        $query = "SELECT concat(Upper(substr(nome, 1,1)), lower(substr(nome, 2,length(nome)))) as nome, id_cat, id_categoria_externo, data_atualizacao FROM p_categorias WHERE id_loja = :id_loja ";
        $params = array(
            ':id_loja' => Config::ID_LOJA,
        );

        if ($idCategoriaERP) {
            $query .= " and id_categoria_externo = :id_categoria_externo";
            $params[':id_categoria_externo'] = $idCategoriaERP;
        }
        
        if(!$integrado){
            $query .= " and integrado = :integrado";
            $params[':integrado'] = 'N';
        }

        $this->executeSQL($query, $params);
        $this->getListCategorias();

        return $this->getDatas();
    }

    function categoriaExiste($idCategoria) {
        $query = "SELECT id_categoria_externo FROM p_categorias WHERE id_loja = :id_loja and id_categoria_externo = :idCategoria";
        $params = array(
            ':id_loja' => Config::ID_LOJA,
            ":idCategoria" =>$idCategoria
        );
        
        $this->executeSQL($query, $params);
        
        if($this->totalDatas() > 0){
            return true;
        }else{
            return false;
        }
    }

    private function getListCategorias() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
        $i = 1;
        while ($list = $this->listDatas()) :
            $key = isset($list['idPai']) ? $list['idPai'] : $list['id_categoria_externo'];
            $this->datas[$key] = array(
                'id_cat' => $list['id_cat'],
                'id_categoria_externo' => $list['id_categoria_externo'],
                'nome' => $list['nome'],
                'data_atualizacao' => $list['data_atualizacao'],
            );

            $i ++;
        endwhile;
    }

}
