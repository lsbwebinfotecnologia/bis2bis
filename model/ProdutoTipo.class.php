<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutoTipo
 *
 * @author licivando
 */
class ProdutoTipo extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function getTiposProduto() {
        $query = "select id_tipo_produto, nome from p_tipo_produto where id_loja = :id_loja";
        $params = [
            ":id_loja"=> Config::ID_LOJA
        ];
        $this->executeSQL($query, $params);
        $this->getListTiposProduto();
    
    }
    
    private function getListTiposProduto() {
     
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'id_tipo_produto' => $list['id_tipo_produto'],
            'nome' => $list['nome']
        );
        
        $i ++;
        endwhile;
        
    }
}
