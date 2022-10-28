<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiFastCommerce
 *
 * @author licivando
 */
class ApiFastCommerce{
    //put your code here
    
    
    public function chamadaApi($link, $params) {
        $ch = curl_init ( $link );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS,  http_build_query ( $params ) );
	 curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
            'Content-Type: application/x-www-form-urlencoded'
            ));
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec ( $ch );
        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $result);
        
        curl_close ( $ch );
        
        return $response;
    }
    




}
