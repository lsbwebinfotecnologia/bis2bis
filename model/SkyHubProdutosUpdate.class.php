<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SkyHubProdutoEstoque
 *
 * @author licivando
 */
class SkyHubProdutoUpdate {

    //put your code here
    function call($url, $data = array()) {

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
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_POSTFIELDS => $params,
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "content-type: application/json",
                    "x-accountmanager-key: ".Config::SKYHUB_ACOUNT_KEY,
                    "x-api-key: " . Config::SKYHUB_KEY,
                    "x-user-email: ".Config::SKYHUB_EMAIL
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
        }else{
            var_dump('Informe os dados para serem enviados em uma array!');
            return false;
        }
    }
    
    function updateEstoque($sku, $qty) {
        $url = "https://api.skyhub.com.br/products/{$sku}";
        
        $data = array(
            "product" => array(
                "qty"=> $qty
            )
        );
                
        return $this->call($url, $data);
        
    }
    
    function updateStatusProduto($sku, $status) {
        $url = "https://api.skyhub.com.br/products/{$sku}";
        
        $data = array(
            "product" => array(
                "status"=> $status
            )
        );
                
        return $this->call($url, $data);
        
    }
    
    
    function updateImagem($sku, $image) {
        $url = "https://api.skyhub.com.br/products/{$sku}";
        
        $data = array(
            "product" => array(
                "images"=> [
                    Config::SKYHUB_DIR_IMG . '/' . $image
                ]
            )
        );
                
        var_dump(json_encode($data));
        DIE;
        return $this->call($url, $data);
        
    }
    
    function updateVariation($sku, $data=array()) {
        
        $url = "https://api.skyhub.com.br/products/{$sku}";
         $body = array(
            "product" => array(
                "variations"=>[
                    $data
                ]
            )
        );
        echo '<pre>';
        print_r($body);
        //die;
                
        return $this->call($url, $body);
        
    }
    
    function updatePrice($sku, $price, $promotionalPrice = null) {
        
        $pricePromotional = null;
        if($promotionalPrice){
            $pricePromotional = $promotionalPrice;
        }
        $url = "https://api.skyhub.com.br/products/{$sku}";
        
        $data = array(
            "product" => array(
                "price"=> $price,
                "promotional_price"=>$pricePromotional
            )
        );
        
        
                
        return $this->call($url, $data);
    }

}
