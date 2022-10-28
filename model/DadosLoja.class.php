<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DadosLoja
 *
 * @author licivando
 */
class DadosLoja  extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function getDePara($name) {
        $query = "SELECT value FROM a_loja_dados WHERE id_loja = :id_loja and name = :name order by id_config desc limit 1";
        $params = [
            ":id_loja" => Config::ID_LOJA,
            ":name"=>$name
        ];
        
        $this->executeSQL($query, $params);
        
        return $this->listDatas()['value'];
    }
}
