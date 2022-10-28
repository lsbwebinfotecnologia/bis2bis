<?php

class Clientes extends Conexao {

    private $nome, $apelido, $email, $cpfCnpj, $tipoClient, $password, $tipoCliente, $telefone, $celular;

    function __construct() {
        parent::__construct();
    }

    function insertCliente() {

        $query = "INSERT INTO `c_clientes` (`id_loja`, `nome`, `apelido`, `email`, `senha`, `data_cad`, `ativo`,`cpf`, `cnpj`, `tipo`, telefone, celular) VALUES (:id_loja, :nome, :apelido, :email, :senha, NOW(), :ativo, :cpf, :cnpj, :tipo, :telefone, :celular);";

        $cpf = "NULL";
        $cnpj = "NULL";

        if ($this->tipoClient == "PF") {
            $cpf = $this->cpfCnpj;
        } else {
            $cnpj = $this->cpfCnpj;
        }

        $params = array(':id_loja' => Config::ID_LOJA, ':nome' => $this->nome, ':apelido' => $this->apelido, ':email' => $this->email, ':senha' => $this->password, ':ativo' => "1", ':cpf' => $cpf, ':cnpj' => $cnpj, ':tipo' => $this->tipoClient, ':telefone' => $this->telefone, ':celular' => $this->celular);

        if ($this->executeSQL($query, $params)) {
            return true;
        } else {
            return false;
        }
    }

    function clienteExiste($cpfCnpj) {
        $caracter = array(" ", ".", "-", "/");

        $this->setCpfCnpj(str_replace($caracter, '', $cpfCnpj));


        if ($this->tipoClient == "PF") {
            $query = "SELECT id_cli FROM c_clientes where cpf = :cpfCnpj AND id_loja = :id_loja";
        } else {
            $query = "SELECT id_cli FROM c_clientes where cnpj = :cpfCnpj AND id_loja = :id_loja";
        }

        $params = array(
            ':cpfCnpj' => $this->cpfCnpj,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {
            return $this->listDatas()['id_cli'];
        } else {
            return false;
        }
    }

    function getIdClientePorEmail($email) {
        $query = "SELECT id_cli FROM c_clientes where email = :email AND id_loja = :id_loja";

        $params = array(
            ':email' => $email,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {
            $idCliente = $this->listDatas();
            return $idCliente['id_cli'];
        } else {
            return 'Nenhum cliente para este e-mail';
        }
    }

    function getIdClientePorCpf($cpfCnpj) {
        $caracter = array(" ", ".", "-", "/");

        $this->setCpfCnpj(str_replace($caracter, '', $cpfCnpj));
        
        

        if ($this->tipoClient == "PF") {
            $query = "SELECT id_cli FROM c_clientes where cpf = :cpfCnpj AND id_loja = :id_loja";
        } else {
            $query = "SELECT id_cli FROM c_clientes where cnpj = :cpfCnpj AND id_loja = :id_loja";
        }

        $params = array(
            ':cpfCnpj' => $this->cpfCnpj,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {
            
            return $this->listDatas()['id_cli'];
        } else {
            return 'Nenhum cliente para este CPF ou CNPJ';
        }
    }

    function prepara($dataCliente=array()) {
        $this->setNome($dataCliente["nome"]);
        $this->setApelido($dataCliente["apelido"]);
        $this->setEmail($dataCliente["email"]);
        $this->setCpfCnpj($dataCliente["cpfCnpj"]);
        $this->setCelular($dataCliente["celular"]);
        $this->setTelefone($dataCliente["telefone"]);
        $this->setPassword($dataCliente["password"]);
    }

    function verificaEmail($email) {
        $this->setEmail($email);

        $query = "SELECT id_cli FROM c_clientes where email = :email AND id_loja = :id_loja";

        $params = array(
            ':email' => $this->email,
            ':id_loja' => Config::ID_LOJA
        );

        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getPassword() {
        return $this->password;
    }

    function setPassword($password) {

        $this->password = Sistema::Criptografia(Config::BD_PREFIXO_PASS . $password);
    }

    function getEmail() {
        return $this->email;
    }

    function getTipoCliente() {
        return $this->tipoCliente;
    }

    function setTipoCliente($cpfCnpj) {
        $this->tipoClient = 'PF';
        $caracter = array(" ", ".", "-", "/");
        if (strlen(str_replace($caracter, '', $cpfCnpj)) == 14) {
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
        $caracter = array(" ", ".", "-", "/");
        $this->tipoClient = 'PF';
        $this->cpfCnpj = str_replace($caracter, '', $cpfCnpj);

        if (strlen(str_replace($caracter, '', $cpfCnpj)) == 14) {
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
        if (strlen($nome) < 3) {
            echo '<div class="alert alert-danger" role="alert">Houve um erro no momento do cadastro: Digite um nome válido!</div>';
        } else {
            $this->nome = $nome;
        }
    }

    function setApelido($apelido) {
        $this->apelido = $apelido;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getCelular() {
        return $this->celular;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }


}
