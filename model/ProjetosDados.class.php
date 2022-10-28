<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjetosDados
 *
 * @author licivando
 */
class ProjetosDados extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function getTotalProjetos($filter=[]) {
        $query = "
            select  
                nomeProjeto, 
                statusEntrega, 
                sum(qtdLivros) as total 
            from b_projetos_dados 
            where id_loja = :id_loja 
            group by nomeProjeto, statusEntrega 
            order by nomeProjeto
        ";
        
        $params = [
            ":id_loja"=> Config::ID_LOJA
        ];
    }
}
