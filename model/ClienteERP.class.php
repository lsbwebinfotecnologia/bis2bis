<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClienteERP
 *
 * @author licivando
 */
class ClienteERP extends Conexao{
    //put your code here
    
    public $inserido, $atualizado, $codCliERP, $codResponsavel, $nomeCli, $nomeReduzido, $nomeResponsavel, $email, $tipoCliWs, $cnpj, $cpf, $rg, $dataNascimento, $staContriuinte, $codTipoCli, $codTipoEnd;
            
    function __construct() {
        parent::__construct();
        $this->setCodResponsavel();
        $this->setNomeResponsavel();
        $this->setCodTipoCli();
        $this->setStaContriuinte();
        $this->setDataNascimento();
    }
    
    function consultaClientERP($cpfCnpj) {
        $wsHorus = new WSHorus();
        $linkCliente = $wsHorus->getLinkWSCliente().'/A_BuscaClienteCPF_CNPJ';

        $paramsCliente = ["CPF_CNPJ"=>$cpfCnpj];
        $clienteWS = $wsHorus->connectWebService($linkCliente, $paramsCliente);
//        var_dump($clienteWS['Table']['COD_CLI']);
//        die;
        return $clienteWS;
    }
    
    function insertOrUpdateClienteERP(){
        $params = array( 
                "COD_CLI"=> $this->codCliERP,
                "COD_RESPONSAVEL" => $this->codResponsavel,
                "NOM_CLI" => $this->nomeCli,
                "NOM_REDUZIDO" => $this->nomeReduzido,
                "NOM_CONTATO" => $this->nomeReduzido,
                "NOM_RESP" => $this->nomeResponsavel,
                "EMAIL" => $this->email,
                "TPO_PESSOA" => $this->tipoCliWs,
                "CNPJ" => $this->cnpj,
                "RG" => $this->rg,
                "CPF" => $this->cpf,
                "INSC_ESTADUAL"=> '',
                "INS_MUNICIPAL" => '',
                "ASSINANTE_CLI" => 'N',
                "DAT_NASCIMENTO" => $this->dataNascimento,
                "STA_CONTRIBUINTE" => $this->staContriuinte,
                "CAD_ORGAO" => 'N',
                "STA_ATIVO" => 'S',
                "IMAGEM1" => '',
                "IMAGEM2" => '',
                "OBS_ATIVO" => '',
                "ORGAO_PUBLICO" => ''            
            );
        $wsHorus = new WSHorus();
        $linkInsertCliWs = $wsHorus->getLinkWSCliente() .'/F_InsereCliente';
        $insertERP = $wsHorus->connectWebService($linkInsertCliWs, $params);
        return $insertERP;
    }
    
    function insertTipoClientWS() {
        $params = array( 
            "COD_CLI"=> $this->codCliERP,
            "COD_TIPO_CLIENTE"=> $this->codTipoCli,
            "STA_DEFAULT"=>'S'
        );
        $wsHorus = new WSHorus();
        $linkInsertTipoClient = $wsHorus->getLinkWSCliente() .'/G_InsereClientesTipo';
        $wsHorus->connectWebService($linkInsertTipoClient, $params);
        
    }
    
    function prepara($codCliERP, $nomeCli, $nomeReduzido, $email, $tipoCliWs, $cnpj, $cpf, $rg) {
        $this->setCodCliERP($codCliERP);
        $this->setNomeCli($nomeCli);
        $this->setNomeReduzido($nomeReduzido);
        $this->setEmail($email);
        $this->setTipoCliWs($tipoCliWs);
        $this->setCnpj($cnpj);
        $this->setCpf($cpf);
        $this->setRg($rg);
    }
    
    function updateIdClientErpInDB($codCliERP, $codCliBD) {
        $query = "UPDATE `c_clientes` SET `id_cliente_erp` = :id_cliente_erp 
                  WHERE `id_loja` = :id_loja AND id_cli = :id_cli;";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":id_cliente_erp"=> $codCliERP,
            ":id_cli"=> $codCliBD
        );
        
        $this->executeSQL($query, $params);
    }
    
    function getInserido() {
        return $this->inserido;
    }

    function getAtualizado() {
        return $this->atualizado;
    }

    function getCodCliERP() {
        return $this->codCliERP;
    }

    function getCodResponsavel() {
        return $this->codResponsavel;
    }

    function getNomeCli() {
        return $this->nomeCli;
    }

    function getNomeReduzido() {
        return $this->nomeReduzido;
    }

    function getNomeResponsavel() {
        return $this->nomeResponsavel;
    }

    function getEmail() {
        return $this->email;
    }

    function getTipoCliWs() {
        return $this->tipoCliWs;
    }

    function getCnpj() {
        return $this->cnpj;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getRg() {
        return $this->rg;
    }

    function getDataNascimento() {
        return $this->dataNascimento;
    }

    function getStaContriuinte() {
        return $this->staContriuinte;
    }

    function getCodTipoCli() {
        return $this->codTipoCli;
    }

    function getCodTipoEnd() {
        return $this->codTipoEnd;
    }

    function setInserido($inserido) {
        $this->inserido = $inserido;
    }

    function setAtualizado($atualizado) {
        $this->atualizado = $atualizado;
    }

    function setCodCliERP($codCliERP) {
        $this->codCliERP = $codCliERP;
    }

    function setCodResponsavel() {
        $configuracao = new Configuracoes();        
        $this->codResponsavel = $configuracao->getDadosConfig('codRespCli');
    }

    function setNomeCli($nomeCli) {
        $this->nomeCli = $nomeCli;
    }

    function setNomeReduzido() {
        $nomeReduzido = explode(' ', $this->nomeCli);
        $this->nomeReduzido = $nomeReduzido[0];
    }

    function setNomeResponsavel() {
        $configuracao = new Configuracoes();        
        $this->nomeResponsavel = $configuracao->getDadosConfig('nomeRespCli');
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTipoCliWs($tipoCliWs) {
        if($tipoCliWs == 'PF'){
            $this->tipoCliWs = 'F';
        } else {
            $this->tipoCliWs = 'J';
        }
        
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setDataNascimento($dataNascimento=null) {
        if($dataNascimento){
            $this->dataNascimento = $dataNascimento;
        } else {
            $this->dataNascimento = date('d/m/Y');
        }
        
    }

    function setStaContriuinte($staContriuinte=null) {
        
        if($staContriuinte){
            $this->staContriuinte = $staContriuinte;
        }else{
            $this->staContriuinte = 'N';
        }
        
    }

    function setCodTipoCli() {
        $configuracao = new Configuracoes();     
        $this->codTipoCli = $configuracao->getDadosConfig('codTipoCli');
    }

    function setCodTipoEnd() {
        $configuracao = new Configuracoes();     
        $this->codTipoEnd = $configuracao->getDadosConfig('codTipoEndCli');
    }


}
