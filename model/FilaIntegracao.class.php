<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FilaIntegracao
 *
 * @author licivando
 */
class FilaIntegracao extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function getFilaIntegracao($filter = []) {
        $query = "select * from f_fila_integracao where id_loja = :id_loja";
        $params = [
            ":id_loja" => Config::ID_LOJA
        ];
        if (count($filter) > 0) {
            foreach ($filter as $k => $valor) {
                $query .= " and {$k} = :{$k} ";
                $params[":$k"] = $valor;
            }
        }
        $query .= " order by ordem asc ";
        $this->executeSQL($query, $params);
//        $this->getListaFila();
        return $this->listDatas();
    }

    private function getListaFila() {
        $i = 1;

        while ($list = $this->listDatas()) :

            $this->datas[$list["tipoIntegracao"]][$list["ordem"]] = $list["valor"];

            $i ++;
        endwhile;
    }

}
