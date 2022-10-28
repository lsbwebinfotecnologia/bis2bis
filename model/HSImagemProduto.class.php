<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSImagemProduto
 *
 * @author licivando
 */
class HSImagemProduto extends Conexao {

    public function __construct() {
        parent::__construct();
    }

    //put your code here
    static function copiaImagem($urlOrigem, $urlDestino) {
        $minha_curl = curl_init($urlOrigem);
        $fs_arquivo = fopen($urlDestino, "w");
        curl_setopt($minha_curl, CURLOPT_FILE, $fs_arquivo);
        curl_setopt($minha_curl, CURLOPT_HEADER, 0);
        curl_exec($minha_curl);
        curl_close($minha_curl);
        fclose($fs_arquivo);
    }

    static function url_exists($url) {

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($code == 200); // verifica se recebe "status OK"
    }

    function getImages($dataIdsERP = array()) {
        $query = "
            select 
                pm.id_img, 
                (select pp.id_item_externo from p_produtos pp where pp.p_id = pm.id_produto and pp.id_loja = :id_loja) as id_item_externo, 
                pm.id_produto, 
                pm.data_modificacao, 
                pm.dir_name 
            from p_images pm WHERE id_loja = :id_loja ";
        $params = [
            ":id_loja" => Config::ID_LOJA,
        ];

        if ($dataIdsERP) {
            $qtdIds = count($dataIdsERP);
            $ids = "";
            $c = 1;
            foreach ($dataIdsERP as $id) {
                if ($c == $qtdIds) {//SE FOR IGUAL AO TOTAL DE IDS DO RETORNO COLOCA SEM A VIRGULA
                    $ids .= $id;
                } else {
                    $ids .= $id . ", ";
                }
                $c ++;
            }
            //$params[":ids"] = ' (' . filter_var($ids, FILTER_SANITIZE_STRIPPED) . ')';

            $query .= " and pm.id_produto in (select pp.p_id from p_produtos pp where pp.id_loja = :id_loja and pp.id_item_externo in ($ids)) "; //ESTA COM INJECTION, VERIFICAR COMO TIRAR
        }

        $this->executeSQL($query, $params);
        $this->getListImagens();

        return $this->getDatas();
    }
    
    private function getListImagens() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$list['id_item_externo']] = array(
                'id_img' => $list['id_img'],
                'id_produto' => $list['id_produto'],
                'dir_name' => $list['dir_name'],
                'data_modificacao' => $list['data_modificacao'],
            );

            $i ++;
        endwhile;
    }

}
