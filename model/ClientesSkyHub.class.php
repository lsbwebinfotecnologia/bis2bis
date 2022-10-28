<?php

class ClientesSkyHub extends Conexao{
    
    private $nome, $apelido, $email, $cpfCnpj, $tipoClient, $password, $tipoCliente;
            
    function __construct() {
        parent::__construct();
    }

    function insertCliente() {

        $query = "INSERT INTO `c_clientes_skyhub` (`id_loja`, `nome`, `apelido`, `email`, `senha`, `ativo`,`cpf`, `cnpj`, `tipo`) VALUES (:id_loja, :nome, :apelido, :email, :senha, :ativo, :cpf, :cnpj, :tipo);";
        
        $cpf = "NULL"; 
        $cnpj = "NULL";
        
        if($this->tipoClient == "PF"){
            $cpf = $this->cpfCnpj;
        }else{
            $cnpj = $this->cpfCnpj;
        }
        
        $params = array(':id_loja' => Config::ID_LOJA, ':nome' => $this->nome, ':apelido' => $this->apelido, ':email' => $this->email, ':senha' => $this->password, ':ativo' => "1", ':cpf' => $cpf, ':cnpj' => $cnpj, ':tipo' => $this->tipoClient);
        
        if($this->executeSQL($query, $params)){
            return true;
        }else{
            return false;
        }
        
        
    }    
    
    function clienteExiste($cpfCnpj) {
        $caracter = array (" ", ".", "-", "/");
        
        $this->setCpfCnpj(str_replace($caracter, '', $cpfCnpj));        
        
        
        if($this->tipoClient == "PF"){
            $query = "SELECT id_cli FROM c_clientes_skyhub where cpf = :cpfCnpj AND id_loja = :id_loja";
        }else{
            $query = "SELECT id_cli FROM c_clientes_skyhub where cnpj = :cpfCnpj AND id_loja = :id_loja";
        }
        
        $params = array(
            ':cpfCnpj' => $this->cpfCnpj,
            ':id_loja' => Config::ID_LOJA
        );        
        
        $this->executeSQL($query, $params);       
        
        if($this->totalDatas() > 0){            
            return true;
        }else{
            return false;
        }  
    }
    
    function getIdClientePorEmail($email) {
        $query = "SELECT id_cli FROM c_clientes_skyhub where email = :email AND id_loja = :id_loja";
        
        $params = array(
            ':email' => $email,
            ':id_loja' => Config::ID_LOJA
        );        
        
        $this->executeSQL($query, $params);       
        
        if($this->totalDatas() > 0){            
            $idCliente = $this->listDatas();
            return $idCliente['id_cli'];
        }else{
            return 'Nenhum cliente para este e-mail';
        } 
        
    }
    
    function getIdClientePorCpf($cpfCnpj) {
        $caracter = array (" ", ".", "-", "/");
        
        $this->setCpfCnpj(str_replace($caracter, '', $cpfCnpj));
        
        if($this->tipoClient == "PF"){
            $query = "SELECT id_cli FROM c_clientes_skyhub where cpf = :cpfCnpj AND id_loja = :id_loja";
        }else{
            $query = "SELECT id_cli FROM c_clientes_skyhub where cnpj = :cpfCnpj AND id_loja = :id_loja";
        }
        
        $params = array(
            ':cpfCnpj' => $this->cpfCnpj,
            ':id_loja' => Config::ID_LOJA
        );        
        
        $this->executeSQL($query, $params);       
        
        
        
        if($this->totalDatas() > 0){            
            $idCliente = $this->listDatas();
            var_dump($idCliente);
            return $idCliente['id_cli'];
        }else{
            return 'Nenhum cliente para este CPF ou CNPJ';
        } 
        
    }
    
    function prepara($dataClient=array()) {
        $this->setNome($dataClient['nomeCliente']);
        $this->setApelido($dataClient['nomeCliente']);
        $this->setEmail($dataClient['email']);
        $this->setCpfCnpj($dataClient['cpfCnpj']);
        $this->setPassword("12345");
        
    }
    
    function verificaEmail($email) {
        $this->setEmail($email);
        
        $query = "SELECT id_cli FROM c_clientes_skyhub where email = :email AND id_loja = :id_loja";
        
        $params = array(
            ':email' => $this->email,
            ':id_loja' => Config::ID_LOJA
        ); 
        
        $this->executeSQL($query, $params);
        
        if($this->totalDatas() > 0){            
            return true;
            
        }else{
            return false;
        }
        
    }
    function getPassword() {
        return $this->password;
    }

    function setPassword($password) {
        
        $this->password = Sistema::Criptografia(Config::BD_PREFIXO_PASS.$password);
    }

    function getEmail() {
        return $this->email;
    }
    
    function getTipoCliente() {
        return $this->tipoCliente;
    }

    function setTipoCliente($cpfCnpj) {
        $this->tipoClient = 'PF';
        $caracter = array (" ", ".", "-", "/");
        if(strlen(str_replace($caracter, '', $cpfCnpj)) == 14){
            $this->tipoClient = 'PJ';
        }
        
        return $this->tipoClient;
    }
    
    function getCpfCnpj() {
        return $this->cpfCnpj;
    }

    function getTipoClient() {
        return $this->tipoClient;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCpfCnpj($cpfCnpj) {//SETANDO O CNPJ ELE SETARA O TIPO DE CLIENTE
        $caracter = array (" ", ".", "-", "/");
        $this->tipoClient = 'PF';
        $this->cpfCnpj = str_replace($caracter, '', $cpfCnpj);
        
        if(strlen(str_replace($caracter, '', $cpfCnpj)) == 14){
            $this->tipoClient = 'PJ';
        }
        
    }
   
    function getNome() {
        return $this->nome;
    }

    function getApelido() {
        return $this->apelido;
    }

    function setNome($nome) {
        if(strlen($nome) < 3){
            echo '<div class="alert alert-danger" role="alert">Houve um erro no momento do cadastro: Digite um nome válido!</div>';   
        }else{
            $this->nome = $nome;
        }
        
    }

    function setApelido($apelido) {
        $this->apelido = $apelido;
    }

}

