<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarios
 *
 * @author horusweb
 */
class Usuarios extends Conexao{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    function getUsers() {
        $query = "select * from a_users where loja_id = :id_loja ";
        $params = [
            ":id_loja" => Config::ID_LOJA
        ];
        
        $this->executeSQL($query, $params);
        $this->getListUsers();
        
        return $this->getDatas();
        
    }
    
    
    
    private function getListUsers() {
     
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'id_u' => $list['id_u'],
            'email' => $list['email'],
            'nome' => $list['nome'],
            'login' => $list['login']
        );
        
        $i ++;
        endwhile;
        
    }
}
