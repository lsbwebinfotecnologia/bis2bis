<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GrupoProduto
 *
 * @author licivando
 */
class GrupoProduto extends Conexao {
    //put your code here
    
    public $nomeGrupo, $idGrupoItem, $dataAtualizacao;
            
    function __construct() {
        parent::__construct();
    }
    
    function insertGrupoItem() {
        $query = "INSERT INTO `p_grupo_item` (`nome`,`status`,`id_loja`,`id_grupo_externo`,`data_atualizacao`) 
                  VALUES (:nome, :status, :id_loja, :id_grupo_externo, :data_atualizacao);";
        
        $params = array(
            ":nome"  => $this->getNomeGrupo(),
            ":status"  => 1,
            ":id_loja"  => Config::ID_LOJA,
            ":id_grupo_externo"  => $this->getIdGrupoItem(),
            ":data_atualizacao"  => $this->getDataAtualizacao()
        );
        
        $this->executeSQL($query, $params);
    }
    
    function updateGrupoItem() {
        $query = "UPDATE `p_grupo_item` 
                 SET `nome` = :nome, 
                     `data_atualizacao` = :data_atualizacao 
                 WHERE `id_loja` = :id_loja AND id_grupo_externo = :id_grupo_externo ;";
        $params = array(
            ":nome"  => $this->getNomeGrupo(),
            ":id_loja"  => Config::ID_LOJA,
            ":id_grupo_externo"  => $this->getIdGrupoItem(),
            ":data_atualizacao"  => $this->getDataAtualizacao()
        );
        
        $this->executeSQL($query, $params);
    }
    
    function getGruposItens() {
        $query = "SELECT id_grupo_externo, data_atualizacao FROM p_grupo_item WHERE id_loja = :id_loja;";
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA
        );

        $this->executeSQL($query, $params);
        
        $this->getListGrupo();
        
        $consultaBD = $this->getDatas();
    
        $grupoItemBD = array();   

        foreach ($consultaBD as $key => $consulta) { 
            $grupoItemBD[$consulta['id_grupo_externo']] = $consulta['data_atualizacao'];        
        }
        
        return $grupoItemBD;
    }
    
    function getNomeGrupo() {
        return $this->nomeGrupo;
    }

    function getIdGrupoItem() {
        return $this->idGrupoItem;
    }

    function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }

    function setNomeGrupo($nomeGrupo) {
        $this->nomeGrupo = $nomeGrupo;
    }

    function setIdGrupoItem($idGrupoItem) {
        $this->idGrupoItem = $idGrupoItem;
    }

    function setDataAtualizacao($dataAtualizacao) {
        $this->dataAtualizacao = $dataAtualizacao;
    }
    
    function getListGrupo() {
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'id_grupo_externo' => $list['id_grupo_externo'],
            'data_atualizacao' => $list['data_atualizacao']
        );
        
        $i ++;
        endwhile;
    }


    
    
}
