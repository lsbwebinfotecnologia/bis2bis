<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estoque
 *
 * @author licivando
 */
class Estoque extends Conexao{
    //put your code here
    
    public $idProdutoWs, $idProdutoBd, $dataAtualizacao, $unidades;
    
    function __construct() {
        parent::__construct();
    }
    
    function updateSaldoItem() {
        
        $query = "UPDATE `p_produtos` 
                  SET `unidades` = :unidades, 
                      `dat_ult_atl_saldo` = :dat_ult_atl_saldo,
                      `updateSaldoSkyhub` = :updateSaldoSkyhub
                  WHERE `id_loja` = :id_loja AND id_item_externo = :id_item_externo;";
        $params = array (
            ":id_loja"=> Config::ID_LOJA,
            ":unidades"=> $this->getUnidades(),
            ":id_item_externo"=> $this->getIdProdutoWs(),
            ":updateSaldoSkyhub"=> 'S',
            ":dat_ult_atl_saldo"=> $this->getDataAtualizacao()
        );
        
        $this->executeSQL($query, $params);
        
    }
    
    function getSaldoItens() {
        $query = "SELECT id_item_externo, p_id, dat_ult_atl_saldo, unidades, titulo FROM p_produtos WHERE id_loja = :id_loja;";
        
        $params = array (
            ":id_loja"=> Config::ID_LOJA
        );
        $this->executeSQL($query, $params);        
        $this->getListSaldoItens();
        $consultaItemSaldo = $this->getDatas();
        $saldoBD = array();
        foreach ($consultaItemSaldo as $key => $consulta) { 
            $saldoBD[$consulta['id_item_externo']]['idHorus'] = $consulta['id_item_externo'];  
            $saldoBD[$consulta['id_item_externo']]['titulo'] = $consulta['titulo'];  
            $saldoBD[$consulta['id_item_externo']]['qtdCronuz'] = $consulta['unidades'];        
            $saldoBD[$consulta['id_item_externo']]['dat_ult_atl_saldo'] = $consulta['dat_ult_atl_saldo'];
        }
        return $saldoBD;
        
    }
    
    function getIdProdutoWs() {
        return $this->idProdutoWs;
    }

    function getIdProdutoBd() {
        $query = "SELECT p_id FROM p_produtos WHERE id_loja = :id_loja and id_item_externo = :id_item_externo order by p_id desc limit 1";
        
        $params = array (
            ":id_loja"=> Config::ID_LOJA,
            ":id_item_externo" => $this->getIdProdutoWs()
        );
        $this->executeSQL($query, $params);
        
        $this->idProdutoBd = $this->listDatas();
        
        return $this->idProdutoBd['p_id'];
        
    }

    function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }

    function setIdProdutoWs($idProdutoWs) {
        $this->idProdutoWs = $idProdutoWs;
    }

    function setIdProdutoBd($idProdutoBd) {
        $this->idProdutoBd = $idProdutoBd;
    }
    function getUnidades() {
        return $this->unidades;
    }

    function setUnidades($unidades) {
        $this->unidades = $unidades;
    }

        function setDataAtualizacao($dataAtualizacao) {
        $this->dataAtualizacao = $dataAtualizacao;
    }

    private function getListSaldoItens() {   
        
        $i = 1;
       
        while ($list = $this->listDatas()) :
            
            $this->datas[$i] = array(
                'id_item_externo' => $list['id_item_externo'],
                'p_id' => $list['p_id'],
                'titulo' => $list['titulo'],
                'dat_ult_atl_saldo' => $list['dat_ult_atl_saldo'],
                'unidades' => $list['unidades']
            );
            
            $i ++;
        endwhile;
        
    }

}
