<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Editora
 *
 * @author licivando
 */
class Editora extends Conexao{
    //put your code here
    public $nomeEditora, $nomeFantasia, $dataAtualizacao, $status, $idEditoraErp, $idEditoraBd, $desconto;
    function __construct() {
        parent::__construct();
    }
    
    function insertEditora() {
        $query = "
            INSERT INTO `p_editoras`
            (`id_loja`, `nome`, `status`, `id_editora_externo`, `vlr_desconto_editora`, `nom_fantasia`, `data_atualizacao`)
            VALUES(
            :id_loja, :nome, :status, :id_editora_externo, :vlr_desconto_editora, :nom_fantasia, :data_atualizacao);";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":nome"=> $this->getNomeEditora(),
            ":status"=> 1,
            ":id_editora_externo"=> $this->getIdEditoraErp(),
            ":vlr_desconto_editora"=>$this->getDesconto(),
            ":nom_fantasia"=> $this->getNomeFantasia(),
            ":data_atualizacao"=> $this->getDataAtualizacao()
        );
        
        $this->executeSQL($query, $params);
    }
    
    function updateEditora() {
        
        $query = "UPDATE `p_editoras`
                SET `nome` = :nome,
                    `id_editora_externo` = :id_editora_externo,
                    `vlr_desconto_editora` = :vlr_desconto_editora,
                    `nom_fantasia` = :nom_fantasia,
                    `data_atualizacao` = :data_atualizacao
                WHERE `id_loja` = :id_loja AND id_editora_externo = :id_editora_externo ;";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":nome"=> $this->getNomeEditora(),
            ":vlr_desconto_editora"=> $this->getDesconto(),
            ":nom_fantasia"=> $this->getNomeFantasia(),
            ":data_atualizacao"=> $this->getDataAtualizacao(),
            ":id_editora_externo"=> $this->getIdEditoraErp()
        );
        
        $this->executeSQL($query, $params);
    }
    
    function getEditorasBD($idEditora=false) {
        $query = "SELECT id_editora_externo, data_atualizacao FROM p_editoras WHERE id_loja = :id_loja;";
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA
        );

        $this->executeSQL($query, $params);
        
        $this->getListEditora();
        
        $consultaBD = $this->getDatas(); //LISTA DE EDITORAS NO BANCO
    
        $editorasBD = array();   

        foreach ($consultaBD as $key => $consulta) { 
            $editorasBD[$consulta['id_editora_externo']] = $consulta['data_atualizacao'];        
        }
        
        return $editorasBD;
    }
    
    function getNomeEditora() {
        return $this->nomeEditora;
    }

    function getNomeFantasia() {
        return $this->nomeFantasia;
    }

    function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }

    function getStatus() {
        return $this->status;
    }

    function setNomeEditora($nomeEditora) {
        $this->nomeEditora = $nomeEditora;
    }

    function setNomeFantasia($nomeFantasia) {
        $this->nomeFantasia = $nomeFantasia;
    }

    function setDataAtualizacao($dataAtualizacao) {
        $this->dataAtualizacao = $dataAtualizacao;
    }

    function setStatus($status) {
        $this->status = $status;
    }
    function getIdEditoraErp() {
        return $this->idEditoraErp;
    }

    function getIdEditoraBd() {
        return $this->idEditoraBd;
    }

    function setIdEditoraErp($idEditoraErp) {
        $this->idEditoraErp = $idEditoraErp;
    }

    function setIdEditoraBd($idEditoraBd) {
        $this->idEditoraBd = $idEditoraBd;
    }
    function getDesconto() {
        return $this->desconto;
    }

    function setDesconto($desconto) {
        $this->desconto = $desconto;
    }

    private function getListEditora() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
              
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'id_editora_externo' => $list['id_editora_externo'],
            'data_atualizacao' => $list['data_atualizacao']
        );
        
        $i ++;
        endwhile;
        
    }





    
    
    
    
    
    
}
