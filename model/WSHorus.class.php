<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WSHorus
 *
 * @author licivando
 */
class WSHorus {
    public function connectWebService($link, $params) {
//        var_dump($link);
        $ch = curl_init ( $link );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS,  http_build_query ( $params ) );
	 curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
            'Content-Type: application/x-www-form-urlencoded'
            ));
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec ( $ch );
        
        
        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $result); 
//        echo '<pre>';
//        var_dump($response);
//        die;
        $xml = new SimpleXMLElement($response, TRUE);
        if(isset($xml->xpath('//NewDataSet')[0])){
            $body = $xml->xpath('//NewDataSet')[0];
        }else{
            $body = $xml->xpath('//NewDataSet');
        }

        $array = json_decode(json_encode((array)$body), TRUE);
        curl_close ( $ch );
        
        return $array;
    }
    
    static function getLinkWSProduto() {
        $config = new Configuracoes();
        return $config->getLink("nomeWSProdutos");
    }
    
    static function getLinkWSCliente() {
        $config = new Configuracoes();
        return $config->getLink("nomeWSClientes");
    }
    
    static function getLinkWSPedido() {
        $config = new Configuracoes();
        return $config->getLink("nomeWSPedidos");
    }
    
    static function getLinkWSCapas() {
        $config = new Configuracoes();
        return $config->getLink("nomeWSCapas");
    }
}
