<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TrayConfig
 *
 * @author licivando
 */
class TrayConfig extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function getConfigs($ambiente = 'teste') {
        $query = "SELECT * FROM `a_tray_dados` where id_loja = :id_loja and ambiente = :ambiente";
        $params = [
            ":id_loja" => Config::ID_LOJA,
            ":ambiente" => $ambiente
        ];

        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {
            return $this->listDatas();
        } else {
            return false;
        }
    }

}
