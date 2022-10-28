<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WCProdutoCategorias
 *
 * @author licivando
 */
class WCProdutoCategorias {
    //put your code here
    function formatarLista($data = []) {
        
        $format = [];
        if ($data) {
            $nome= isset($data['slogan']) ? $data['slogan'] : null;
            $idPai = $data['idPaiLojaIntegrada'] != false ? '/api/v1/categoria/'.$data['idPaiLojaIntegrada'] : null;
            $idExterno = $data['idFilho'] == false ? $data['idPai'] : $data['idFilho']+100000;
            $format["id_externo"] = $idExterno;
            $format["nome"] = $nome;
            $format["descricao"] = $nome;
            $format["categoria_pai"] = $idPai;
            return $format;
        } else {
            return false;
        }
    }
}
