<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutoCategoria
 *
 * @author licivando
 */
class ProdutoCategoria extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function getCategorias() {
        $query = "select id_cat, nome, id_categoria_externo, DATE_FORMAT(data_atualizacao,'%d/%m/%Y') as data_atualizacao from p_categorias where id_loja = :id_loja";
        $params = [
            ":id_loja"=> Config::ID_LOJA
        ];
        $this->executeSQL($query, $params);
        $this->getLisCategorias();
    
    }
    
    public function getIdCategoriaPaiPorNome($nomeGenero) {
        $generos = explode("/", $nomeGenero);
        
        $query = "select idTerceiro from p_categorias_pai where id_loja = :id_loja and nome = :nome and integrado = :integrado";
        $params = [
            ":id_loja"=> Config::ID_LOJA,
            ":nome"=>trim($generos[0]),
            ":integrado"=>"S"
        ];
        $this->executeSQL($query, $params);
        if($this->totalDatas() > 0){
            return $this->listDatas()['idTerceiro'];
        }else{
            return false;
        }
    }
    
    private function getLisCategorias() {
     
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'id_cat' => $list['id_cat'],
            'nome' => $list['nome'],
            'id_categoria_externo' => $list['id_categoria_externo'],
            'data_atualizacao' => $list['data_atualizacao']
        );
        
        $i ++;
        endwhile;
        
    }
}
