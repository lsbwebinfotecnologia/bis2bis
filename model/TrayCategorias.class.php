<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TrayCategorias
 *
 * @author licivando
 */
class TrayCategorias extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function getCategoriasCronuz() {
        $query = "select id, name, parent_id from p_tray_categorias where id_loja = :id_loja";
        $params = [
            ":id_loja"=> Config::ID_LOJA
        ];
        
        $this->executeSQL($query, $params);
        $this->getListCategorias();
        return $this->getDatas();
    }
    
    function getCategoriasTray($access_token) {
        $params["access_token"] = $access_token;
//        $params["sort"] = "id_desc";

        $url = Config::URL_API_ADDRESS ."/categories/tree/?" . http_build_query($params);

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
            return $resposta;
        }
    }
    
    
     private function getListCategorias() {

        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$list['id']] = array(
                'id' => $list['id'],
                'name' => $list['name'],
                'parent_id' => $list['parent_id']
            );

            $i ++;
        endwhile;
    }


}
