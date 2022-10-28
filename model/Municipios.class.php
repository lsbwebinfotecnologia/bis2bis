<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Municipios
 *
 * @author licivando
 */
class Municipios extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
     public function getCidade($idCidade) {
        $query = "select * from c_cidades where id = :id ";
        $params = [
            ":id" => $idCidade
        ];
        $this->executeSQL($query, $params);
        return $this->listDatas();
    }
}
