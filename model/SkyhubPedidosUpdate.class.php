<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SkyhubPedidosUpdate
 *
 * @author licivando
 */
class SkyhubPedidosUpdate {

    //put your code here
    function call($url, $data = array()) {//PARA ATUALIZAR O PEDIDO DEVE SER ENVIADO UM POST
        if ($data) {
            $params = json_encode($data);
            //var_dump($params);
            //die;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $params,
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
        } else {
            var_dump('Informe os dados para serem enviados em uma array!');
            return false;
        }
    }

    function updateOrderStatus($order, $dataOrder = array()) {
        if ($dataOrder) {
            if (isset($dataOrder['status'])) {
                $status = $dataOrder['status'];
                $body = array(
                    "invoice" => $dataOrder['invoice']
                );
                $url = "https://api.skyhub.com.br/orders/{$order}/{$status}";

                if ($this->call($url, $body)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                var_dump("Necessario informar o Status que o pedido irá assumir!");
            }
        } else {
            var_dump("obrigatório informar a array com os dados do Pedido");
        }
    }

    function updateOderInvoiced($dataOrder = array()) {

        if (isset($dataOrder["order"]) && $dataOrder["key"] && $dataOrder["volume_qty"]) {
            $order = $dataOrder["order"];

            $data = [
                "status" => "order_invoiced",
                "invoice" => [
                    "key" => $dataOrder["key"],
                    "volume_qty" => $dataOrder["volume_qty"]
                ]
            ];

            $url = "https://api.skyhub.com.br/orders/{$order}/invoice";

            if ($this->call($url, $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            var_dump("Necessário informar ou Key NF-e, ou a Order ou o Volume");
        }
    }

    function updateOderCanceled($dataOrder = array()) {

        if (isset($dataOrder["order"])) {
            $order = $dataOrder["order"];

            $data = [
                "status" => "order_canceled"
            ];

            $url = "https://api.skyhub.com.br/orders/{$order}/cancel";

            if ($this->call($url, $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            var_dump("Necessário informar ou Key NF-e, ou a Order ou o Volume");
        }
    }

}
