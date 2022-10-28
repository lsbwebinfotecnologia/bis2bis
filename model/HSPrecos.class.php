<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSPrecos
 *
 * @author licivando
 */
class HSPrecos extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
//    function insertPreco($data = array()) {//INSERT EDITORA
//        $columnsInserts = [
//            "id_loja" => Config::ID_LOJA,
//            "id_produto" => $data->NOM_EDITORA,
//            "valor" => "1",
//            "deleted" => '0',
//            "id_item_externo" => $data->NOM_EDITORA,
//            "data_atualizacao" => $data->COD_EDITORA,
//        ];
//        $id = $this->insertTable('p_precos', $columnsInserts);
//        if($id){
//            return true;
//        }else{
//            echo Sistema::msgErroDanger("Erro ao inserir Precos {$data->COD_EDITORA} no Eros");
//            return false;
//        }
//        
//    }

    function getPrecoItens($dataIdsERP = array()) {
        $query = "select id_produto, valor, id_item_externo, data_atualizacao from p_precos WHERE id_loja = :id_loja";
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

            $query .= " and id_item_externo in ($ids) "; //ESTA COM INJECTION, VERIFICAR COMO TIRAR
//            var_dump($params);
        }

        $this->executeSQL($query, $params);
        $this->getListItens();

        return $this->getDatas();
    }
    
     private function getListItens() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$list['id_item_externo']] = array(
                'id_produto' => $list['id_produto'],
                'data_atualizacao' => $list['data_atualizacao'],
                'id_item_externo' => $list['id_item_externo'],
                'valor'=>$list['valor']
            );

            $i ++;
        endwhile;
    }

}
