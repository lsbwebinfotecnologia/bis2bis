<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnderecoCliente
 *
 * @author licivando
 */
class EnderecoCliente extends Conexao{
    //put your code here
    
    private $idCliente, $logradouro, $numero, $complemento, $bairro, $cep, $cidade, $uf, $tipoEndereco, $idCidade, $idUF;
    
    function enderecoExiste($idCliente, $tipoEndereco) {                
        if($this->getEnderecoCliente($tipoEndereco, $idCliente)){//BUSCA ENDERECO SE ELE EXISTIR NO BANCO
            return true;
        } else {
            return false;
        }        
    }
    
    function getEnderecos($filter=[]) {
        $query = "SELECT * FROM c_enderecos where id_loja = :id_loja";
        $params = [
            ":id_loja"=> Config::ID_LOJA
        ];
        
        if(isset($filter['cep'])){
            $query .= " and cep = :cep";
            $params[':cep']=$filter['cep'];
        }
        
        if(isset($filter['id_cli'])){
            $query .= " and id_cli = :id_cli";
            $params[':id_cli']=$filter['id_cli'];
        }
        
        $this->executeSQL($query, $params);
        
        if($this->totalDatas() > 0){
            return $this->listDatas();
        }else{
            return false;
        }
    }
    
    
    
    function getEnderecoCliente($tipoEndereco, $idCliente) {
        $query = "SELECT id_e, tipo, principal FROM c_enderecos where tipo = :tipo and id_cli = :id_cli and id_loja = :id_loja";
        $params = array(
            ":tipo" => $tipoEndereco,
            ":id_cli" => $idCliente,
            ":id_loja" => Config::ID_LOJA
        ); 
        $this->executeSQL($query, $params);
        
        $idEndereco = $this->listDatas();
        
        return $idEndereco;
    }

    
    function getIdCidade() {
        return $this->idCidade;
    }
    
    function getIdUf() {
        return $this->idUF;
    }
    
    function insertCidade($nome, $uf) {
        
        $codigoUF = $this->getIdUf($uf);
        
        $query = "INSERT INTO `c_cidades` (estado, uf, nome) VALUES (:estado, :uf, :nome)";        
        
        $params = array(
            ':estado' => $codigoUF,
            ':uf' => $uf,
            ':nome' => $nome
        ); 
        
        $this->executeSQL($query, $params);
        
    }
    
    
    function getIdCliente() {
        return $this->idCliente;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getNumero() {
        return $this->numero;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCep() {
        return $this->cep;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getUf() {
        return $this->uf;
    }
    
    function setIdCidade($idCidade) {        
        $this->setIdCidade = $idCidade;
    }

    function setIdUF($idUF) {
        $this->idUF = $idUF;
    }

        
    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }
    function getComplemento() {
        return $this->complemento;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    
    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCep($cep) {
        $caracter = [" ", "-", ".", ".."];
        $this->cep = str_replace($caracter, '', $cep);
    }

    function setCidade($cidade) {//BUSCA O MUNICIPIO, SE NAO ENCONTRAR INSERE E SETA AS IDS DE MUNICIPIO E UF
        $query = "SELECT id FROM c_cidades where nome = :cidade AND uf = :uf";
        $params = array(
            ":cidade" => $cidade,
            ':uf' => $this->uf
        ); 
        
        $this->executeSQL($query, $params);
        $idCidade = $this->listDatas();
        
        if(!$idCidade){//SE NAO ENCONTROU A ID DO MUNICIPIO INSERE
            $this->insertCidade($cidade, $this->uf);
            $this->executeSQL($query, $params);
            $idCidade = $this->listDatas();
            $this->cidade = $cidade;
            $this->idCidade = $idCidade['id'];
        } else {
            $this->cidade = $cidade;
            $this->idCidade = $idCidade['id'];  
        }             
        
    }

    function setUf($uf) {
        $query = "SELECT id FROM c_estados where uf = :uf";
        
        $params = array(
            ':uf' => $uf
        ); 
        
        $this->executeSQL($query, $params);
        
        $idUF = $this->listDatas();
        $this->idUF = $idUF['id'];
        $this->uf = $uf;

    }

    function getTipoEndereco() {
        return $this->tipoEndereco;
    }

    function setTipoEndereco($tipoEndereco) {   
        $this->tipoEndereco = $tipoEndereco;
        
        
    }


    
}
