<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SkyHubCategorias
 *
 * @author licivando
 */
class ErosTipoProduto extends Conexao {

    //put your code here

    function getTipoDeProdutosEros() {

        $query = " 
            SELECT  
                id_tipo_produto as code,
                nome as name 
            FROM p_tipo_produto 
            WHERE id_loja = :id_loja ";
        
        $params = array(
            ":id_loja" => Config::ID_LOJA,
        );
        
        $this->ExecuteSQL($query, $params);
        
        $this->getListTipoProdutos();
    }
    
    private function getListTipoProdutos() {   
        
        $i = 1;
       
        while ($list = $this->listDatas()) :
            
            $this->datas[$i] = array(
                'code' => $list['code'],
                'name' => $list['name']
                
            );
            
            $i ++;
        endwhile;
        
    }
    
    
}
