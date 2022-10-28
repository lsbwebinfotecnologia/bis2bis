<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FTPcs
 *
 * @author licivando
 */
class FTPcs {
    //put your code here
    //put your code here
    private $host, $user, $pass;
    
    public function __construct($host, $user, $pass) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
    }
    
    public function conect(){
        
        $conect = ftp_connect($this->host);
        $login = ftp_login($conect, $this->user, $this->pass);
        
        if($conect){
            return $conect;
        }else{
            return false;
        }
    }
    
    public function uploadFile($fileOrigem, $fileDestino) {
        if($this->conect()){
            if(ftp_put($this->conect(), $fileDestino, $fileOrigem, FTP_ASCII)){
                return true;
            }else{
                return false;
            }
            ftp_close($this->conect());
        }else{
            return false;
        }
        
    }

            
    function getHost() {
        return $this->host;
    }

    function getUser() {
        return $this->user;
    }

    function getPass() {
        return $this->pass;
    }

    function setHost($host) {
        $this->host = $host;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

}
