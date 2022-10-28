<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstoqueHorus
 *
 * @author licivando
 */
class EstoqueHorus extends WSHorus {

    //put your code here
    public $codEmpresa, $codFilial, $dataIni, $dataFim;

    public function __construct($codEmpresa, $codFilial) {

        $this->setCodEmpresa($codEmpresa);
        $this->setCodFilial($codFilial);
    }

    function getSaldoPorLocal($codLocal, $codItem = false) {
        $link = $this->getLinkWSProduto() . '/X_MostraSaldoItensLocal';
        $item = $codItem != false ? $codItem : false;
        
        $params = array(
            "Cod_Empresa" => $this->codEmpresa,
            "Cod_Filial" => $this->codFilial,
            "Cod_Local" => $codLocal,
            "Cod_Item" => $item
        );
        
        $retorno = $this->connectWebService($link, $params);
        
        return $retorno;
    }

    function getSaldoGeral($dataIni, $dataFim) {
        
    }

    function getCodEmpresa() {
        return $this->codEmpresa;
    }


    function getDataIni() {
        return $this->dataIni;
    }

    function getDataFim() {
        return $this->dataFim;
    }

    function getCodLocal() {
        return $this->codLocal;
    }

    function setCodEmpresa($codEmpresa) {
        $this->codEmpresa = $codEmpresa;
    }

    function setCodFilial($codFilial) {
        $this->codFilial = $codFilial;
    }

    function setDataIni($dataIni) {
        $this->dataIni = $dataIni;
    }

    function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
    }



}
