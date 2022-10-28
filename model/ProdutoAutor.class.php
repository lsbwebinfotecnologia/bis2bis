<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutoAutor
 *
 * @author licivando
 */
class ProdutoAutor extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function getAutores() {
        $query = "select id_autor, nome_autor from p_autores where id_loja = :id_loja";
        $params = [
            ":id_loja"=> Config::ID_LOJA
        ];
        $this->executeSQL($query, $params);
        $this->getListAutores();
    
    }
    
    private function getListAutores() {
     
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'id_autor' => $list['id_autor'],
            'nome_autor' => $list['nome_autor']
        );
        
        $i ++;
        endwhile;
        
    }
}
