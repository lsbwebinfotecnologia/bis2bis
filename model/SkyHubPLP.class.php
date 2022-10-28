<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SkyHubPLP
 *
 * @author licivando
 */
class SkyHubPLP {

    //put your code here

    function listPLPs() {//PARA ATUALIZAR O PEDIDO DEVE SER ENVIADO UM POST
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.skyhub.com.br/shipments/b2w/to_group",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/pdf",
                "x-accountmanager-key: " . Config::SKYHUB_ACOUNT_KEY,
                "x-api-key: " . Config::SKYHUB_KEY,
                "x-user-email: " . Config::SKYHUB_EMAIL
            ),
        ));

        $response = curl_exec($curl);
        //var_dump($response);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            return false;
        } else {
            //echo $response;
            return $response;
        }
    }
    
    function agroupPLPs($order_remote_codes) {
        $url = "https://api.skyhub.com.br/shipments/b2w/";
    }

}
