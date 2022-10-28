<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SkyhubCall
 *
 * @author licivando
 */
class SkyhubCall {

    //put your code here
    private $link, $email, $key, $acountKey;

    public function __construct() {
        $this->link = 'https://api.skyhub.com.br';
        $this->key = Config::SKYHUB_KEY;
        $this->acountKey = Config::SKYHUB_ACOUNT_KEY;
        $this->email = Config::SKYHUB_EMAIL;
                
    }

    public function callVipp($params) {

        $data = json_encode($params);


        $ch = curl_init($this->link);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-User-Email: '. $this->email .'
                x-Api-Key: '. $this->key .'
                x-accountmanager-key: '. $this->acountKey .' 
                Accept: application/json;charset=UTF-8
                Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);

        print_r($result);
        die;

        //$array = json_decode(json_encode((array)$body), TRUE);
        curl_close($ch);

        //return $array;
    }
    
    function getLink() {
        return $this->link;
    }

    function getEmail() {
        return $this->email;
    }

    function getKey() {
        return $this->key;
    }

    function getAcountKey() {
        return $this->acountKey;
    }

    function setLink($link) {
        $this->link = $link;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setKey($key) {
        $this->key = $key;
    }

    function setAcountKey($acountKey) {
        $this->acountKey = $acountKey;
    }



}
