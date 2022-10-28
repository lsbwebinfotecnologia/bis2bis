<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TrayProdutos
 *
 * @author licivando
 */
class TrayProdutos extends Conexao {

    //put your code here
    public function cadastrarProduto($access_token, $dataProduto = array()) {
        $params["access_token"] = $access_token;

        $url = Config::URL_API_ADDRESS . "/products/?" . http_build_query($params);

        ob_start();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataProduto));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($dataProduto)))
        );
        curl_exec($ch);

        // JSON de retorno  
        $resposta = json_decode(ob_get_contents());
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        ob_end_clean();
        curl_close($ch);

        if ($code == "201") {
            //Tratamento dos dados de resposta da consulta.
            return $resposta;
        } else {
            //Tratamento das mensagens de erro
            echo '<pre>';
            print_r($resposta);
        }
    }

    public function getProdutosTray($access_token, $idTray) {
        $params["access_token"] = $access_token;
        $params["id"] = $idTray;

        $url = Config::URL_API_ADDRESS . "/products/?" . http_build_query($params);

        ob_start();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_exec($ch);

        // JSON de retorno  
        $resposta = json_decode(ob_get_contents());
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        ob_end_clean();
        curl_close($ch);

        if ($code == "200") {
            //Tratamento dos dados de resposta da consulta.
            return $resposta;
        } else {
            //Tratamento das mensagens de erro
            var_dump($resposta);
        }
    }

}
