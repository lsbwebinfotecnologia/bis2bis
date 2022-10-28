<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DadosDePara
 *
 * @author licivando
 */
class DadosDePara extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function getDePara($type, $de) {
        $query = "SELECT para FROM a_conf_de_para WHERE id_loja = :id_loja and tipo_configuracao = :type and de = :de order by id_configuracao desc limit 1";
        $params = [
            ":id_loja" => Config::ID_LOJA,
            ":type"=>$type,
            ":de"=>$de
        ];
        
        $this->executeSQL($query, $params);
        
        return $this->listDatas()['para'];
    }
}
