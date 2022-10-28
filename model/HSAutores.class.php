<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSAutores
 *
 * @author licivando
 */
class HSAutores extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function getAutoresItem($dataIdsERP = array()) {
        $query = "
            select 
            *,  
            (select p_id from p_produtos pp where pp.id_item_externo = pa.idItemExterno and pp.id_loja = :id_loja) as p_id 
            from p_autores pa
            where id_loja = :id_loja ";
        $params = [
            ":id_loja" => Config::ID_LOJA
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
            $query .= " and idItemExterno in ($ids) "; //ESTA COM INJECTION, VERIFICAR COMO TIRAR
        }

        $this->executeSQL($query, $params);
        $i = 1;
        $autores = [];
        while ($list = $this->listDatas()) :
            array_push($autores, array(
                    'p_id' => $list['p_id'],
                    'nome_autor' => $list['nome_autor'],
                    'tipoAutor' => $list['tipoAutor'],
                    'idItemExterno' => $list['idItemExterno'],
                    'id_autor' => $list['id_autor'],
                    'id_autor_externo' => $list['id_autor_externo'],
                    'id_tipo_autor_externo' => $list['id_tipo_autor_externo']
                
            ));

            $i ++;
        endwhile;

        return $autores;
    }

    function updateAutorItem($idItemExterno, $idAutorEros, $idAutorExterno) {
        $query = "update p_produtos set id_autor = :id_autor, id_autor_externo = :id_autor_externo where id_item_externo = :id_item_externo and id_loja = :id_loja";
        $params = [
            ":id_loja" => Config::ID_LOJA,
            ":id_item_externo" => $idItemExterno,
            ":id_autor_externo" => $idAutorExterno,
            ":id_autor" => $idAutorEros
        ];
        $this->executeSQL($query, $params);
    }

}
