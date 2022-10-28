<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estados
 *
 * @author licivando
 */
class Estados extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
     public function getEstado() {
        $query = "select * from c_estados ";

        $this->executeSQL($query);

        $data = [];
        while ($list = $this->listDatas()) :
            $data[$list['uf']] = $list['nome'];
        endwhile;
        

        return $data;
    }
}
