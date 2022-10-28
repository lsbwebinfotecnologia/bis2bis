<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnderecoClienteERP
 *
 * @author licivando
 */
class EnderecoClienteERP {
    //put your code here
    public $codigoTipoEndereco, $codClientERP, $pais, $estado, $uf, $cidade, $nameContact, $bairro, $logradouro, $numero, $complemento, $cep, $celular, $statusDefault;
    
    function insertEnderecoWS() {
        $params = array(
            "COD_CLI"=> $this->codClientERP,
            "COD_TPO_END" => $this->codigoTipoEndereco,
            "NOM_PAIS"=> $this->pais,//POR ENQUANTO VALIDACAO APENAS NACIONAL
            "SIGLA_UF"=> $this->uf,
            "NOME_UF"=> $this->estado,
            "NOM_LOCAL"=> $this->cidade,
            "NOM_CONTATO"=> $this->nameContact,
            "NOM_BAIRRO"=> $this->bairro,
            "DESC_ENDERECO"=> $this->logradouro,
            "NUM_END"=> $this->numero,
            "COM_ENDERECO"=> $this->complemento,
            "CEP"=> $this->cep,
            "TEL_ENDERECO"=> '',
            "CEL_ENDERECO"=> $this->celular,
            "FAX_ENDERECO"=>'',
            "STA_DEFAULT" => $this->statusDefault,
            "STA_VALIDO"=> 'S'
        );
        $wsHorus = new WSHorus();
        $linkInsertEndereco = $wsHorus->getLinkWSCliente() .'/H_InsereEnderecosCliente';
        $wsHorus->connectWebService($linkInsertEndereco, $params);
        //return $insertERP;
    }
    
    function prepara($codigoTipoEndereco, $codClientERP, $pais, $uf, $estado, $cidade, $nameContact, $bairro, $logradouro, $numero, $complemento, $cep, $celular, $statusDefault) {
        $this->setCodigoTipoEndereco($codigoTipoEndereco);
        $this->setCodClientERP($codClientERP);
        $this->setPais($pais);
        $this->setEstado($estado);
        $this->setUf($uf);
        $this->setCidade($cidade);
        $this->setNameContact($nameContact);
        $this->setBairro($bairro);
        $this->setLogradouro($logradouro);
        $this->setNumero($numero);
        $this->setComplemento($complemento);
        $this->setCep($cep);
        $this->setCelular($celular);
        $this->setStatusDefault($statusDefault);
    }
    
    function getCodigoTipoEndereco() {
        return $this->codigoTipoEndereco;
    }

    function getCodClientERP() {
        return $this->codClientERP;
    }

    function getPais() {
        return $this->pais;
    }
    function getUf() {
        return $this->uf;
    }

    function setUf($uf) {
        $this->uf = $uf;
    }

        function getEstado() {
        return $this->estado;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getNameContact() {
        return $this->nameContact;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getNumero() {
        return $this->numero;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getCep() {
        return $this->cep;
    }

    function getCelular() {
        return $this->celular;
    }

    function getStatusDefault() {
        return $this->statusDefault;
    }

    function setCodigoTipoEndereco($codigoTipoEndereco) {
        $this->codigoTipoEndereco = $codigoTipoEndereco;
    }

    function setCodClientERP($codClientERP) {
        $this->codClientERP = $codClientERP;
    }

    function setPais($pais) {
        $this->pais = $pais;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setNameContact($nameContact) {
        $this->nameContact = $nameContact;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setCelular($celular) {
        if($celular){
            $this->celular = $celular;
        }else{
            $this->celular = '(00)00000-0000';
        }
        
    }

    function setStatusDefault($statusDefault) {
        $this->statusDefault = $statusDefault;
    }


}
