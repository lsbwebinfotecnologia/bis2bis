<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SkyhubEtiquetas
 *
 * @author licivando
 */
class SkyhubEtiquetas {

    //put your code here

    function getEtiquetasDisponiveis() {

        $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);

        $requestHandler = $api->plp();

        /** @var SkyHub\Api\Handler\Response\HandlerInterface $response */
        $response = $requestHandler->ordersReadyToGroup()->export();

        return json_decode($response['body']);
    }

    function agroupOrderInPLP($orders = array()) {
        $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);

        $requestHandler = $api->plp();
        $response = $requestHandler->group($orders)->export();
        var_dump($response);
        return ($response);
    }

    function ungroupOrderPLP($PLPID) {
        $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);

        $requestHandler = $api->plp();
        $response = $requestHandler->ungroup($PLPID);
        var_dump($response);
        return ($response);
    }

    function recoveryPLP($PLPID) {
        /** @var SkyHub\Api\ $service */
        //$service = new SkyHub\Api\Service\ServicePdf(null);

        /** @var \SkyHub\Api $api */
        $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);

        /** @var \SkyHub\Api\Handler\Request\Shipment\PlpHandler $requestHandler */
        $requestHandler = $api->plp();

        /** @var SkyHub\Api\Handler\Response\HandlerInterface $response */
        $response = $requestHandler->viewFile($PLPID);

        //var_dump($service);

        var_dump($response);
        return ($response);
    }

    function listOrderColeta() {
        $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);
        
        /** @var \SkyHub\Api\Handler\Request\Shipment\PlpHandler $requestHandler */
        $requestHandler = $api->plp();

        $requested = true; //Entregas que já tiveram sua coleta solicitada (obrigatório)
        $offset = 1; //Paginação, inicia em 1 e hoje por padrão retorna de 20 em 20 registros. (opcional)

        /** @var SkyHub\Api\Handler\Response\HandlerInterface $response */
        $response = $requestHandler->collectables($requested, $offset)->export();
        
        var_dump($response);
        
        return $response;
    }

    function confirmColeta($order = array()) {
        $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);
        $requestHandler = $api->plp();
        /**
         * @var SkyHub\Api\Handler\Response\HandlerInterface $response
         */
        $response = $requestHandler->confirmCollection($order)->export();

        var_dump($response);

        return $response;
    }

    function getListB2WEntrega() {

        $url = "https://api.skyhub.com.br/shipments/b2w/to_group?offset=1";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
//            CURLOPT_POSTFIELDS => $params,
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json",
                "x-accountmanager-key: " . Config::SKYHUB_ACOUNT_KEY,
                "x-api-key: " . Config::SKYHUB_KEY,
                "x-user-email: " . Config::SKYHUB_EMAIL
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            return false;
        } else {
            echo $response;
            return true;
        }
    }

    function agruparPLP() {

        $url = "https://api.skyhub.com.br/shipments/b2w/";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{"order_remote_codes":["158265526","158265528"]}',
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json",
                "x-accountmanager-key: " . Config::SKYHUB_ACOUNT_KEY,
                "x-api-key: " . Config::SKYHUB_KEY,
                "x-user-email: " . Config::SKYHUB_EMAIL
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            return false;
        } else {
            echo $response;
            return true;
        }
    }

    function recuperarPLP($IDPLP) {

        $url = "https://api.skyhub.com.br/shipments/b2w/view?plp_id={$IDPLP}";


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
//            CURLOPT_POSTFIELDS => '{"order_remote_codes":["158265526","158265528"]}',
            CURLOPT_HTTPHEADER => array(
                //"accept: application/json",
                "accept: application/pdf",
                "content-type: application/json",
                "x-accountmanager-key: " . Config::SKYHUB_ACOUNT_KEY,
                "x-api-key: " . Config::SKYHUB_KEY,
                "x-user-email: " . Config::SKYHUB_EMAIL
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            return false;
        } else {
            echo $response;
            return true;
        }
    }

}
