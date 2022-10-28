<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Assunto
 *
 * @author licivando
 */
class Assunto extends Conexao{
    //put your code here
    
    public $nomeCategoria, $idCategoriaExterno, $dataAtualizacao;
            
    function __construct() {
        parent::__construct();
    }
    
    function insertAssunto() {
        $query = "
            INSERT INTO `p_categorias` 
                  (`nome`, `id_loja`, `id_categoria_externo`, `data_atualizacao`)
            VALUES(:nome, :id_loja, :id_categoria_externo, :data_atualizacao);";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":nome"=> $this->getNomeCategoria(),
            ":id_categoria_externo"=> $this->getIdCategoriaExterno(),
            ":data_atualizacao"=> $this->getDataAtualizacao()
        );
        
        $this->executeSQL($query, $params);
    }
    
    function updateAssunto() {
        
        $query = "UPDATE `p_categorias` 
                  SET `nome` = :nome, 
                      `data_atualizacao` = :data_atualizacao 
                  WHERE `id_loja` = :id_loja AND id_categoria_externo = :id_categoria_externo;";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":nome"=> $this->getNomeCategoria(),
            ":id_categoria_externo"=> $this->getIdCategoriaExterno(),
            ":data_atualizacao"=> $this->getDataAtualizacao()
        );
        
        $this->executeSQL($query, $params);
        
    }
    
    function getAssuntosBD() {
        $query = "SELECT id_categoria_externo, data_atualizacao, id_cat FROM p_categorias WHERE id_loja = :id_loja;";
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA
        );

        $this->executeSQL($query, $params);
        
        $this->getListAssuntos();
        
        $consultaBD = $this->getDatas();
    
        $assuntosBD = array();   

        foreach ($consultaBD as $key => $consulta) { 
            $assuntosBD[$consulta['id_categoria_externo']] = $consulta['data_atualizacao'];        
        }
        
        return $assuntosBD;
    }
    
    function getNomeCategoria() {
        return $this->nomeCategoria;
    }

    function getIdCategoriaExterno() {
        return $this->idCategoriaExterno;
    }

    function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }

    function setNomeCategoria($nomeCategoria) {
        $this->nomeCategoria = $nomeCategoria;
    }

    function setIdCategoriaExterno($idCategoriaExterno) {
        $this->idCategoriaExterno = $idCategoriaExterno;
    }

    function setDataAtualizacao($dataAtualizacao) {
        $this->dataAtualizacao = $dataAtualizacao;
    }
    
    

    private function getListAssuntos() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
              
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'id_categoria_externo' => $list['id_categoria_externo'],
            'data_atualizacao' => $list['data_atualizacao'],
            'id_cat' => $list['id_cat']
        );
        
        $i ++;
        endwhile;
        
    }


    
}
