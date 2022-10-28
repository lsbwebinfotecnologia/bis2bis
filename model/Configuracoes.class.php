<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Configuracoes
 *
 * @author licivando
 */
class Configuracoes extends Conexao {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    function updateConfiguracoesWS($name, $value) {

        $verifica = $this->getTotalData($name);

        
        if ($verifica > 0) {
            //var_dump($name.' - '.$value.' - '.$verifica.'<br>');

            $query = "UPDATE `a_conf_integracao` 
                  SET `value` = :value 
                  WHERE `name` = :name 
                  AND `id_loja` = :id_loja;";
            $params = array(
                ":id_loja" => Configuracoes::ID_LOJA,
                ":name" => $name,
                ":value" => $value
            );

//            var_dump($params, $query);
            
            $this->executeSQL($query, $params);
        } else {
            $this->insertConfiguracoesWS($name, $value);
        }
    }
    
        function getDadosConfigGeral($filter = []) {
        $query = "SELECT * FROM a_conf_integracao WHERE id_loja = :id_loja ";
        $params = array(
            ":id_loja" => Config::ID_LOJA,
        );

        $this->executeSQL($query, $params);
        $data = [];
        while ($list = $this->listDatas()) :
            $data[$list['name']] = $list['value'];
        endwhile;
        return $data;
    }
    

    function insertConfiguracoesWS($name, $value) {
        $query = "INSERT INTO `a_conf_integracao` (`id_loja`, `name`, `value`) VALUES( :id_loja, :name, :value);";

        $params = array(
            ":id_loja" => Configuracoes::ID_LOJA,
            ":name" => $name,
            ":value" => $value
        );

        $this->ExecuteSQL($query, $params);
    }

    function getDadosConfig($name) {
        $query = "SELECT name, value FROM a_conf_integracao WHERE id_loja = :id_loja and name = :name order by id_config desc limit 1";

        $params = array(
            ":id_loja" => Config::ID_LOJA,
            ":name" => $name
        );

        $this->ExecuteSQL($query, $params);

        $list = $this->listDatas();

        return isset($list['value']) ?? false;
    }
    
    function getTodosDadosConfig() {
        $query = "SELECT * FROM a_conf_integracao WHERE id_loja = :id_loja ";

        $params = array(
            ":id_loja" => Config::ID_LOJA,
        );

        $this->ExecuteSQL($query, $params);
        $dados = [];
        
        while ($list = $this->listDatas()) :
            $dados[$list['name']] = $list['value'];
        endwhile;

        return $dados;
    }

    function getDadosAPIHorus() {
        $query = "SELECT * FROM a_dados_horus_api WHERE id_loja = :id_loja ";

        $params = array(
            ":id_loja" => Config::ID_LOJA
        );

        $this->ExecuteSQL($query, $params);

        if ($this->totalDatas() > 0) {
            return $this->listDatas();
        } else {
            return false;
        }
    }

    function getDadosLojaIntegrada() {
        $query = "SELECT * FROM a_dados_loja_integrada WHERE id_loja = :id_loja ";

        $params = array(
            ":id_loja" => Config::ID_LOJA
        );

        $this->ExecuteSQL($query, $params);

        if ($this->totalDatas() > 0) {
            return $this->listDatas();
        } else {
            return false;
        }
    }

    function getDePara($tipo_configuracao) {
        $query = "SELECT de, para FROM a_conf_de_para WHERE id_loja = :id_loja and tipo_configuracao = :tipo_configuracao order by id_configuracao desc limit 1";

        $params = array(
            ":id_loja" => Config::ID_LOJA,
            ":tipo_configuracao" => $tipo_configuracao
        );

        $this->ExecuteSQL($query, $params);

        return $this->listDatas();
    }

    function getTotalData($name) {
        $query = "SELECT name, value FROM a_conf_integracao WHERE id_loja = :id_loja and name = :name order by id_config desc ";

        $params = array(
            ":id_loja" => Config::ID_LOJA,
            ":name" => $name
        );

        $this->ExecuteSQL($query, $params);

        return $this->totalDatas();
    }

    function updateDateIntegrador($tipoSincronizacao, $slogan = null) {
        if ($this->getInfoIntegrador($tipoSincronizacao)) {
            $query = "update a_sicronizacao_integrador set data_sicronizacao = now() where tipo_sicronizacao = :tipo_sicronizacao and id_loja = :id_loja";
            $params = array(
                ":id_loja" => Config::ID_LOJA,
                ":tipo_sicronizacao" => $tipoSincronizacao
            );
            $this->ExecuteSQL($query, $params);
        } else {
            $query = "insert into a_sicronizacao_integrador (id_loja, tipo_sicronizacao, slogan, data_sicronizacao) values (:id_loja, :tipo_sicronizacao, :slogan, now())";
            $params = array(
                ":id_loja" => Config::ID_LOJA,
                ":tipo_sicronizacao" => $tipoSincronizacao,
                ":slogan" => $slogan
                
            );
            $this->ExecuteSQL($query, $params);
        }
    }

    function getdadosLojaApi() {
        $query = "SELECT StoreName, StoreID, Username, Password FROM a_dados_fast WHERE id_loja = :id_loja order by id_dado_fast desc limit 1";

        $params = array(
            ":id_loja" => Config::ID_LOJA
        );

        $this->ExecuteSQL($query, $params);

        return $this->listDatas();
    }

    function getInfoIntegrador($tipoSincronizacao) {
        $query = "SELECT tipo_sicronizacao, data_sicronizacao FROM a_sicronizacao_integrador WHERE id_loja = :id_loja and tipo_sicronizacao = :tipo_sicronizacao";

        $params = array(
            ":id_loja" => Config::ID_LOJA,
            ":tipo_sicronizacao" => $tipoSincronizacao
        );

        $this->ExecuteSQL($query, $params);

        return $this->listDatas();
    }

    function getIntegradores($type) {
        $query = "SELECT tipo_sicronizacao, data_sicronizacao, slogan FROM a_sicronizacao_integrador WHERE id_loja = :id_loja and tipo_sicronizacao like '$type%'";

        $params = array(
            ":id_loja" => Config::ID_LOJA
        );

        $this->ExecuteSQL($query, $params);

        $this->getListIntegradores();

        return $this->getDatas();
    }

    function getIntegradoresERP() {
        $query = "SELECT tipo_sicronizacao, data_sicronizacao FROM a_sicronizacao_integrador WHERE id_loja = :id_loja and tipo_sicronizacao not like 'api%'";

        $params = array(
            ":id_loja" => Config::ID_LOJA
        );

        $this->ExecuteSQL($query, $params);

        $this->getListIntegradores();

        return $this->getDatas();
    }

    function getIntegradoresAPI() {
        $query = "SELECT tipo_sicronizacao, data_sicronizacao FROM a_sicronizacao_integrador WHERE id_loja = :id_loja and tipo_sicronizacao like 'api%'";

        $params = array(
            ":id_loja" => Config::ID_LOJA
        );

        $this->ExecuteSQL($query, $params);

        $this->getListIntegradores();

        return $this->getDatas();
    }

    function updateConfiguracoesAPILoja($name, $value) {

        $verifica = $this->getTotalData($name);


        if ($verifica > 0) {
            //var_dump($name.' - '.$value.' - '.$verifica.'<br>');

            $query = "UPDATE `a_conf_integracao` 
                  SET `value` = :value 
                  WHERE `name` = :name 
                  AND `id_loja` = :id_loja;";
            $params = array(
                ":id_loja" => Configuracoes::ID_LOJA,
                ":name" => $name,
                ":value" => $value
            );

            $this->executeSQL($query, $params);
        } else {
            $this->insertConfiguracoesWS($name, $value);
        }
    }

    function insertConfiguracoesAPILoja($value = array()) {
        $query = "INSERT INTO `a_dados_fast` (`StoreName`, `StoreID`, `Username`, `Password`, `url_api`, `id_loja`) VALUES( :StoreName, :StoreID, :Username, :Password, :url_api, :id_loja);";

        $params = array(
            ":id_loja" => Configuracoes::ID_LOJA,
            ":StoreName" => $value['StoreName'],
            ":StoreID" => $value['StoreID'],
            ":Username" => $value['Username'],
            ":Password" => $value['Password'],
            ":url_api" => $value['url_api']
        );

        $this->ExecuteSQL($query, $params);
    }

    function getLink($name) {
        $query = "SELECT name, value FROM a_conf_integracao WHERE id_loja = :id_loja and name = :name order by id_config desc limit 1";

        $params = array(
            ":id_loja" => Config::ID_LOJA,
            ":name" => $name
        );

        $this->ExecuteSQL($query, $params);

        return $this->listDatas()['value'];
    }

    private function getListIntegradores() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$i] = array(
                'tipo_sicronizacao' => $list['tipo_sicronizacao'],
                'data_sicronizacao' => $list['data_sicronizacao'],
                'slogan' => $list['slogan'],
            );

            $i ++;
        endwhile;
    }

}
