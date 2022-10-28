<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TrayToken
 *
 * @author licivando
 */
class TrayToken {

    //put your code here
    public $ambiente;

    public function __construct($ambiente) {
        $this->setAmbiente($ambiente);
    }

    public function gerarToken() {
        $config = new TrayConfig();
        $dataConfig = $config->getConfigs($this->getAmbiente());

        if ($dataConfig) {
            $params["consumer_key"] = $dataConfig['consumer_key'];
            $params["consumer_secret"] = $dataConfig['consumer_secret'];
            $params["code"] = $dataConfig['code'];

            $url = Config::URL_API_ADDRESS . "/auth/";

            ob_start();

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_exec($ch);

            // JSON de retorno  
            $resposta = json_decode(ob_get_contents());
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            ob_end_clean();
            curl_close($ch);

            if ($code == "201" || "200") {
                //Tratamento dos dados de resposta da consulta.
                $dataSet = [
                    "access_token" => $resposta->access_token,
                    "refresh_token" => $resposta->refresh_token,
                    "date_expiration_access_token" => $resposta->date_expiration_access_token,
                    "date_expiration_refresh_token" => $resposta->date_expiration_refresh_token,
                    "date_activated" => $resposta->date_activated,
                    "store_id" => $resposta->store_id,
                    "api_host" => $resposta->api_host
                ];

                $dataWhere = [
                    "code" => $params["code"],
                    "id_loja" => Config::ID_LOJA
                ];

                $config->updateTable('a_tray_dados', $dataSet, $dataWhere);
                
                return $code;
                
            } else {
                //Tratamento das mensagens de erro
                var_dump($resposta);
            }
        } else {
            var_dump("Nenhuma chave configurada na tabela a_tray_dados");
        }
    }

    public function atualizarToken() {

        $config = new TrayConfig();
        $dataConfig = $config->getConfigs($this->getAmbiente());

        $params["refresh_token"] = $dataConfig['refresh_token'];

        $url = Config::URL_API_ADDRESS . "/auth/?" . http_build_query($params);

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
            $dataSet = [
                "access_token" => $resposta->access_token,
                "refresh_token" => $resposta->refresh_token,
                "date_expiration_access_token" => $resposta->date_expiration_access_token,
                "date_expiration_refresh_token" => $resposta->date_expiration_refresh_token,
                "date_activated" => $resposta->date_activated,
                "store_id" => $resposta->store_id,
                "api_host" => $resposta->api_host
            ];

            $dataWhere = [
                "code" => $params["code"],
                "id_loja" => Config::ID_LOJA
            ];

            $config->updateTable('a_tray_dados', $dataSet, $dataWhere);
            return $code;
            
        } else {
            //Tratamento das mensagens de erro
            var_dump($resposta);
            return false;
        }
    }

    function getAmbiente() {
        return $this->ambiente;
    }

    function setAmbiente($ambiente) {
        $this->ambiente = $ambiente;
    }

}
