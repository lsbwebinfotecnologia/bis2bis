<?php

class Login extends Conexao {

    private $user, $pass, $idCliente, $ip, $session;

    function __construct() {
        parent::__construct();
    }

    function getLoginAdmin($user, $pass) {//FUNCAO PARA BUSCAR OS CLIENTES NO ADMIN
        $this->setUser($user);
        $this->setPass($pass);

        $query = "SELECT * FROM a_users WHERE login = :login AND senha = :pass";

        $params = array(
            ':login' => $this->getUser(),
            ':pass' => $this->getPass()
        );

        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {
            $list = $this->listDatas();
        }
    }

    function getLogin($user, $pass) {//FUNCAO PARA BUSCAR DADOS DO CLEINTE NO FRONT
        $this->setUser($user);
        $this->setPass($pass);

        $query = "SELECT * FROM a_users WHERE login = :login AND senha = :pass";

        $params = array(
            ':login' => $this->getUser(),
            ':pass' => Sistema::Criptografia(Config::BD_PREFIXO_PASS . $this->getPass())
        );
        
//        var_dump($params);

        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {//SE LOGADO CRIA A SESSAO DE LOGIN
            $list = $this->listDatas();
            $this->idCliente = $list['id_u'];
            $this->ip = $_SERVER["REMOTE_ADDR"];
            $this->session = $_SESSION["SID"];
            $this->insertLogAcess();

            //CRIA A SESSAO DO CLIENTE SE ESTIVER COM OS DADOS OK
            $_SESSION["USUARIO"]['ID_U'] = $list['id_u'];
            $_SESSION["USUARIO"]['NOME'] = $list['nome'];
            $_SESSION["USUARIO"]['LOGIN'] = $list['login'];
            $_SESSION["USUARIO"]['EMAIL'] = $list['email'];

            return TRUE;
        } else {
            return FALSE;
        }
    }

    function insertLogAcess() {
        $query = "INSERT INTO `l_acessos` 
		(`id_loja`, `id_cliente`, `data_hora`, `ip`, `sid`)
                VALUES 
                (:id_loja, :id_cliente, NOW(), :ip, :sid);";

        $params = array(
            ":id_loja" => Config::ID_LOJA,
            ":id_cliente" => $this->idCliente,
            ":ip" => $this->ip,
            ":sid" => $this->session
        );

        $this->executeSQL($query, $params);
    }

    static function logado() {
        if (isset($_SESSION["USUARIO"]['ID_U'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    static function logoff() {
        unset($_SESSION["USUARIO"]);

        Rotas::redirecionar(0, Rotas::get_SiteHome());
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getIp() {
        return $this->ip;
    }

    function getSession() {
        return $this->session;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setSession($session) {
        $this->session = $session;
    }

    private function setUser($user) {
        $this->user = $user;
    }

    private function setEmail($email) {
        $this->email = $email;
    }

    private function setPass($pass) {
        $this->pass = $pass; //Sistema::Criptografia(Config::BD_PREFIXO_PASS.$pass);
    }

    function getUser() {
        return $this->user;
    }

    function getEmail() {
        return $this->email;
    }

    function getPass() {
        return $this->pass;
    }

}
