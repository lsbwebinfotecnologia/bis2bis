<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosMagento
 *
 * @author licivando
 */
class PedidosMagento {

    //put your code here
    public $apiKey, $apiUser, $path, $session;

    public function __construct($apiKey, $apiUser, $path) {
        $this->setApiKey($apiKey);
        $this->setApiUser($apiUser);
        $this->setPath($path);
        $this->setSession();
    }

    function getItensPedido($idPedidoMagento) {
        try {
            $result = $this->SoapClient()->salesOrderInfo($this->session->result, $idPedidoMagento);
        } catch (Exception $ex) {
            $result = false;
        }

        return $result;
    }

    function getApiKey() {
        return $this->apiKey;
    }

    function getApiUser() {
        return $this->apiUser;
    }

    function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    function setApiUser($apiUser) {
        $this->apiUser = $apiUser;
    }

    function getPath() {
        return $this->path;
    }

    function getSession() {
        return $this->session;
    }

    function setPath($path) {
        $this->path = $path;
    }

    function SoapClient() {
        $proxy = new SoapClient($this->path . '/api/v2_soap/?wsdl');
        return $proxy;
    }

    function setSession() {
        $sessionId = $this->SoapClient()->login((object) array('username' => $this->apiUser, 'apiKey' => $this->apiKey));
        $this->session = $sessionId;
    }

}
