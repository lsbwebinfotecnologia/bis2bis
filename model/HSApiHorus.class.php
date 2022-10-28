<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSApiHorus
 *
 * @author licivando
 */
class HSApiHorus extends Conexao {

    //put your code here
    public $usuario, $senha, $filtro, $url, $dadosAutenticacao;
    
    public function __construct() {
        parent::__construct();
        $this->getAutenticacao();
        if($this->dadosAutenticacao){
            $url = $this->dadosAutenticacao['url'] . ':' . $this->dadosAutenticacao['porta'];
            $this->setUrl($url);
        }else{
            echo Sistema::msgDanger('Necessário informar os dados de autenticação da API do Horus');
        }
    }

    public function getProdutosHorus($filtros=[]) {
        
        $this->url .= "/Horus/api/TServerB2B/Busca_Acervo?";
        $baseCode = base64_encode($this->dadosAutenticacao['usuario'].':'.$this->dadosAutenticacao['senha']);

        if(count($filtros) > 0){
            $this->url .= http_build_query($filtros);
        }else{
            echo Sistema::msgAlert('Necessário informar no mínimo um Filtro com o código do produto');
            die;
        }
        
//        var_dump($this->url);
        
        if ($this->dadosAutenticacao) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => $this->dadosAutenticacao['porta'],
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "authorization: Basic {$baseCode}",
                    "senha: {$this->dadosAutenticacao['senha']}",
                    "usuario: {$this->dadosAutenticacao['usuario']}"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return $response;
            }
        }else{
            echo Sistema::msgAlert('Sem informações de usuário e senha para autenticação');
        }
    }
    
    public function getEstoqueHorus($filtros=[]) {
        
        $this->url .= "/Horus/api/TServerB2B/Estoque?";
        $baseCode = base64_encode($this->dadosAutenticacao['usuario'].':'.$this->dadosAutenticacao['senha']);

        if(count($filtros) > 0){
            $this->url .= http_build_query($filtros);
        }else{
            echo Sistema::msgAlert('Necessário informar no mínimo um Filtro com o código do produto');
            die;
        }
        
//        var_dump($this->url, $this->dadosAutenticacao);
//             die;   
        if ($this->dadosAutenticacao) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => $this->dadosAutenticacao['porta'],
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "authorization: Basic {$baseCode}",
                    "senha: {$this->dadosAutenticacao['senha']}",
                    "usuario: {$this->dadosAutenticacao['usuario']}"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                
                return $response;
            }
        }else{
            echo Sistema::msgAlert('Sem informações de usuário e senha para autenticação');
        }
    }
    
    public function getClienteERP($filtros = []) {
        $this->url = $this->dadosAutenticacao['url'];
        $this->url .= "/Horus/api/TServerB2B/Busca_Cliente?";
        $baseCode = base64_encode($this->dadosAutenticacao['usuario'] . ':' . $this->dadosAutenticacao['senha']);

        if (count($filtros) > 0) {
            $this->url .= http_build_query($filtros);
        } else {
            echo Sistema::msgAlert('Necessário informar no mínimo um Filtro com o código do produto');
            die;
        }

        if ($this->dadosAutenticacao) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => $this->dadosAutenticacao['porta'],
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "authorization: Basic {$baseCode}",
                    "senha: {$this->dadosAutenticacao['senha']}",
                    "usuario: {$this->dadosAutenticacao['usuario']}"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return json_decode($response);
            }
        } else {
            echo Sistema::msgAlert('Sem informações de usuário e senha para autenticação');
        }
    }
    
    public function insertTipoDeClienteERP($params = [], $method = 'get') {
        $this->url = $this->dadosAutenticacao['url'] . "/Horus/api/TServerB2B/InsAltTipoCliente?";
        $baseCode = base64_encode($this->dadosAutenticacao['usuario'] . ':' . $this->dadosAutenticacao['senha']);
        if (count($params) > 0) {
            $this->url .= http_build_query($params);
        } else {
            echo Sistema::msgAlert('Necessário informar no mínimo um parametro');
            die;
        }
        if ($this->dadosAutenticacao) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => $this->dadosAutenticacao['porta'],
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_HTTPHEADER => array(
                    "authorization: Basic {$baseCode}"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return json_decode($response);
            }
        } else {
            echo Sistema::msgAlert('Sem informações de usuário e senha para autenticação');
        }
    }
    
    public function getPedidosHorus($filtros=[]) {
        
        $this->url .= "/Horus/api/TServerB2B/Busca_PedidosVenda?";
        $baseCode = base64_encode($this->dadosAutenticacao['usuario'].':'.$this->dadosAutenticacao['senha']);

        if(count($filtros) > 0){
            $this->url .= http_build_query($filtros);
        }else{
            echo Sistema::msgAlert('Necessário informar no mínimo um Filtro com o código do produto');
            die;
        }
        
        if ($this->dadosAutenticacao) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => $this->dadosAutenticacao['porta'],
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "authorization: Basic {$baseCode}",
                    "senha: {$this->dadosAutenticacao['senha']}",
                    "usuario: {$this->dadosAutenticacao['usuario']}"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return $response;
            }
        }else{
            echo Sistema::msgAlert('Sem informações de usuário e senha para autenticação');
        }
    }
    
    public function getRastreiosPedidos($filtros=[]) {
        
        $this->url .= "/Horus/api/TServerB2B/Busca_RastreioPedido?";
        $baseCode = base64_encode($this->dadosAutenticacao['usuario'].':'.$this->dadosAutenticacao['senha']);

        if(count($filtros) > 0){
            $this->url .= http_build_query($filtros);
        }else{
            echo Sistema::msgAlert('Necessário informar no mínimo um Filtro com o código do produto');
            die;
        }
        
        if ($this->dadosAutenticacao) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => $this->dadosAutenticacao['porta'],
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "authorization: Basic {$baseCode}",
                    "senha: {$this->dadosAutenticacao['senha']}",
                    "usuario: {$this->dadosAutenticacao['usuario']}"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return $response;
            }
        }else{
            echo Sistema::msgAlert('Sem informações de usuário e senha para autenticação');
        }
    }
    
    function setNewFiltro($nome, $valor) {
        $this->url .= "{$nome}={$valor}";
    }
    
    function getUrl() {
        return $this->url;
    }

    function setUrl($url) {
        $this->url = $url;
    }

        
    function getFiltro() {
        return $this->filtro;
    }

    function setFiltro($filtro) {
        if(count($filtro) > 0){
            $this->filtro = $filtro;
        }else{
            $this->filtro = [];
        }
    }
    
    function getDadosAutenticacao() {
        return $this->dadosAutenticacao;
    }

    function setDadosAutenticacao($dadosAutenticacao) {
        $this->dadosAutenticacao = $dadosAutenticacao;
    }

    public function insertClienteERP($params = [], $method = 'get') {
        $this->url = $this->dadosAutenticacao['url'] . "/Horus/api/TServerB2B/InsAltCliente?";
        $baseCode = base64_encode($this->dadosAutenticacao['usuario'] . ':' . $this->dadosAutenticacao['senha']);
        if (count($params) > 0) {
            $this->url .= http_build_query($params);
        } else {
            echo Sistema::msgAlert('Necessário informar no mínimo um parametro');
            die;
        }
        if ($this->dadosAutenticacao) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => $this->dadosAutenticacao['porta'],
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_HTTPHEADER => array(
                    "authorization: Basic {$baseCode}"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return json_decode($response);
            }
        } else {
            echo Sistema::msgAlert('Sem informações de usuário e senha para autenticação');
        }
    }

    public function insertItensDoPedidoERP($params = [], $method = 'get') {
        $this->url = $this->dadosAutenticacao['url'] . "/Horus/api/TServerB2B/InsItensPedidoVenda?";
        $baseCode = base64_encode($this->dadosAutenticacao['usuario'] . ':' . $this->dadosAutenticacao['senha']);
        if (count($params) > 0) {
            $this->url .= http_build_query($params);
        } else {
            echo Sistema::msgAlert('Necessário informar no mínimo um parametro');
            die;
        }
        if ($this->dadosAutenticacao) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => $this->dadosAutenticacao['porta'],
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_HTTPHEADER => array(
                    "authorization: Basic {$baseCode}"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return json_decode($response);
            }
        } else {
            echo Sistema::msgAlert('Sem informações de usuário e senha para autenticação');
        }
    }
    
    public function updateStatusPedido($params = [], $method = 'get') {
        $this->url = $this->dadosAutenticacao['url'] . "/Horus/api/TServerB2B/AltStatus_Pedido?";
        $baseCode = base64_encode($this->dadosAutenticacao['usuario'] . ':' . $this->dadosAutenticacao['senha']);
        if (count($params) > 0) {
            $this->url .= http_build_query($params);
        } else {
            echo Sistema::msgAlert('Necessário informar no mínimo um parametro');
            die;
        }
        if ($this->dadosAutenticacao) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => $this->dadosAutenticacao['porta'],
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_HTTPHEADER => array(
                    "authorization: Basic {$baseCode}"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return json_decode($response);
            }
        } else {
            echo Sistema::msgAlert('Sem informações de usuário e senha para autenticação');
        }
    }

    public function insertEnderecoClienteERP($params = [], $method = 'get') {
        $this->url = $this->dadosAutenticacao['url'] . "/Horus/api/TServerB2B/InsAltEndCliente ?";
        $baseCode = base64_encode($this->dadosAutenticacao['usuario'] . ':' . $this->dadosAutenticacao['senha']);
        if (count($params) > 0) {
            $this->url .= http_build_query($params);
        } else {
            echo Sistema::msgAlert('Necessário informar no mínimo um parametro');
            die;
        }
        if ($this->dadosAutenticacao) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => $this->dadosAutenticacao['porta'],
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_HTTPHEADER => array(
                    "authorization: Basic {$baseCode}"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return json_decode($response);
            }
        } else {
            echo Sistema::msgAlert('Sem informações de usuário e senha para autenticação');
        }
    }

    public function insertPedidoERP($params = [], $method = 'get') {
        $this->url = $this->dadosAutenticacao['url'] . "/Horus/api/TServerB2B/InsPedidoVenda?";
        $baseCode = base64_encode($this->dadosAutenticacao['usuario'] . ':' . $this->dadosAutenticacao['senha']);
        if (count($params) > 0) {
            $this->url .= http_build_query($params);
        } else {
            echo Sistema::msgAlert('Necessário informar no mínimo um parametro');
            die;
        }
        if ($this->dadosAutenticacao) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => $this->dadosAutenticacao['porta'],
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_HTTPHEADER => array(
                    "authorization: Basic {$baseCode}"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return json_decode($response);
            }
        } else {
            echo Sistema::msgAlert('Sem informações de usuário e senha para autenticação');
        }
    }
    
    function getAutenticacao() {

        $query = "select * from a_dados_horus_api where id_loja = :id_loja";
        $params = [
            ":id_loja" => Config::ID_LOJA
        ];

        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {
            $this->setDadosAutenticacao($this->listDatas());
            return $this->dadosAutenticacao;
        } else {
            return false;
        }
    }

}
