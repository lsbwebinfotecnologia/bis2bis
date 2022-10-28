<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutoEditora
 *
 * @author licivando
 */
class ProdutoEditora extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getNameEditoraForId() {
        
    }

    public function getEditoras($filter=[]) {
        $query = "select * from p_editoras where id_loja = :id_loja";
        $params = [
            ":id_loja" => Config::ID_LOJA
        ];
        
        if(count($filter) > 0){
             foreach ($filter as $k => $valor) {
                $query .= " and {$k} = :{$k} ";
                $params[":$k"] = $valor;
            }
        }

        $this->executeSQL($query, $params);
        $this->getListEditora();
        
        return $this->getDatas();
    }

    private function getListEditora() {

        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$i] = array(
                'idEditora' => $list['id_editora'],
                'nome' => $list['nome'],
                'COD_EDITORA' => $list['id_editora_externo'],
                'integrado' => $list['integrado'],
                'idLojaIntegrada' => $list['idLojaIntegrada'],
            );

            $i ++;
        endwhile;
    }

}
