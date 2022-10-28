<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnderecoClienteSkyHub
 *
 * @author licivando
 */
class EnderecoClienteSkyHub extends Conexao {

    //put your code here

    private $idCliente, $logradouro, $numero, $complemento, $bairro, $cep, $cidade, $uf, $tipoEndereco, $idCidade, $idUF, $desEndereco, $principal, $telefone;

    function enderecoExiste($idCliente, $tipoEndereco) {
        if ($this->getEnderecoCliente($tipoEndereco, $idCliente)) {//BUSCA ENDERECO SE ELE EXISTIR NO BANCO
            return true;
        } else {
            return false;
        }
    }

    function insertEndereco() {
        $query = "INSERT IGNORE INTO `c_enderecos_skyhub` 
                    (`nome_end`, `id_cli`, `tipo`, `logradouro`, `bairro`, `numero`, `complemento`, `cidade`, `estado`, `cep`, `id_loja`, `principal`, `ativo`, `telefone`)
                  VALUES
                    (:nome_end, :id_cli, :tipo, :logradouro, :bairro, :numero, :complemento, :cidade, :estado, :cep, :id_loja, :principal, '1', :telefone);";
        $params = array(
            ":nome_end" => $this->desEndereco,
            ":id_cli" => $this->idCliente,
            ":tipo" => $this->tipoEndereco,
            ":logradouro" => $this->logradouro,
            ":bairro" => $this->bairro,
            ":numero" => $this->numero,
            ":complemento" => $this->complemento,
            ":cidade" => $this->idCidade,
            ":estado" => $this->idUF,
            ":cep" => $this->cep,
            ":principal" => $this->principal,
            ":telefone" => $this->telefone,
            ":id_loja" => Config::ID_LOJA
        );
        $this->executeSQL($query, $params);
    }

    function updateEndereco($idEndereco) {

        $query = "UPDATE `c_enderecos_skyhub` 
                  SET `tipo` = :tipo, 
                      `logradouro` = :logradouro, 
                      `bairro` = :bairro, 
                      `numero` = :numero, 
                      `complemento` = :complemento, 
                      `cidade` = :cidade, 
                      `estado` = :estado, 
                      `cep` = :cep, 
                      `id_loja` = :id_loja, 
                      `principal` = :principal  
                  WHERE id_e = :id_e 
                  AND id_cli = :id_cli 
                  AND id_loja = :id_loja;";

        $params = array(
            ":id_cli" => $this->idCliente,
            ":tipo" => $this->tipoEndereco,
            ":logradouro" => $this->logradouro,
            ":bairro" => $this->bairro,
            ":numero" => $this->numero,
            ":complemento" => $this->complemento,
            ":cidade" => $this->idCidade,
            ":estado" => $this->idUF,
            ":cep" => $this->cep,
            ":principal" => $this->principal,
            ":id_e" => $idEndereco,
            ":id_loja" => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);
    }

    function getEnderecoCliente($tipoEndereco, $idCliente) {
        $query = "SELECT id_e, tipo, principal FROM c_enderecos_skyhub where tipo = :tipo and id_cli = :id_cli and id_loja = :id_loja";
        $params = array(
            ":tipo" => $tipoEndereco,
            ":id_cli" => $idCliente,
            ":id_loja" => Config::ID_LOJA
        );
        $this->executeSQL($query, $params);

        $idEndereco = $this->listDatas();

        return $idEndereco;
    }

    function getIdEndereco($tipoEndereco, $idCliente) {//SEMPRE PEGA O ULTIMO
        $query = "SELECT id_e FROM c_enderecos_skyhub where tipo = :tipo and id_cli = :id_cli and id_loja = :id_loja ORDER BY id_e DESC LIMIT 1";
        $params = array(
            ":tipo" => $tipoEndereco,
            ":id_cli" => $idCliente,
            ":id_loja" => Config::ID_LOJA
        );
        $this->executeSQL($query, $params);

        $idEndereco = $this->listDatas();

        return $idEndereco['id_e'];
    }

    function getEnderecoPorId($idEndereco) {
        $query = "SELECT * FROM c_enderecos_skyhub where id_e = :id_e and id_loja = :id_loja";
        $params = array(
            ":id_e" => $idEndereco,
            ":id_loja" => Config::ID_LOJA
        );
        $this->executeSQL($query, $params);

        $dadosEndereco = $this->listDatas();

        return $dadosEndereco;
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

    function prepara($dataEnd = array()) {
        $this->setLogradouro($dataEnd['logradouro']);
        $this->setNumero($dataEnd['numero']);
        $this->setComplemento($dataEnd['complemento']);
        $this->setBairro($dataEnd['bairro']);
        $this->setCep($dataEnd['cep']);
        $this->setUf($dataEnd['uf']);
        $this->setCidade($dataEnd['cidade']);
        $this->setTipoEndereco($dataEnd['tipo']);
        $this->setPrincipal($dataEnd['tipo']);
        $this->setDesEndereco($dataEnd['tipo']);
        $this->setTelefone($dataEnd['telefone']);
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
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

    function getDesEndereco() {
        return $this->desEndereco;
    }

    function getPrincipal() {
        return $this->principal;
    }

    function setDesEndereco($desEndereco) {
        $this->desEndereco = $desEndereco;
    }

    function setPrincipal($principal) {

        if ($principal == "Principal") {
            $this->principal = "1";
        } elseif ($principal == "Entrega") {
            $this->principal = "0";
        } elseif ($principal == "Comercial") {
            $this->principal = "2";
        } elseif ($principal == "Outro") {
            $this->principal = "3";
        }
        $this->principal = $principal;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setCidade($cidade) {//BUSCA O MUNICIPIO, SE NAO ENCONTRAR INSERE E SETA AS IDS DE MUNICIPIO E UF
        $query = "SELECT id FROM c_cidades where nome = :cidade AND uf = :uf";
        $params = array(
            ":cidade" => $cidade,
            ':uf' => $this->uf
        );

        $this->executeSQL($query, $params);
        $idCidade = $this->listDatas();

        if (!$idCidade) {//SE NAO ENCONTROU A ID DO MUNICIPIO INSERE
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
