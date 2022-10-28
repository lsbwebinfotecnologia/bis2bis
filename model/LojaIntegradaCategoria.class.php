<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoriaLojaIntegrada
 *
 * @author licivando
 */
class LojaIntegradaCategoria {

    //put your code here

    public function cadastrarCategoria($data = []) {
        
        $configuracoes = new Configuracoes();
        $dadosLoja = $configuracoes->getDadosLojaIntegrada();

        if ($this->validarEstruturaCategoria($data)) {//SE TIVER NA ESTRUTURA CORRETA
            $dataCategoria = json_encode($data);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://api.awsli.com.br/v1/categoria");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            curl_setopt($ch, CURLOPT_POST, TRUE);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataCategoria);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Authorization: chave_api " . $dadosLoja['chaveApi'] . " aplicacao " . $dadosLoja['chaveApp']
            ));

            $response = curl_exec($ch);
            curl_close($ch);

            return json_decode($response);
        } else {
            echo Sistema::msgDanger('Estrura dos campos da array invalido!');
            return false;
        }
    }

    function validarEstruturaCategoria($data = []) {

        if ($data) {

            $campos = [
                'id_externo', 'nome', 'descricao', 'categoria_pai'
            ];
            foreach ($campos as $valor) {
                $verifica = (array_key_exists($valor, $data));
                if (!$verifica) {//SE FOR FALSO, OU SEJA, NÃO BATE A ESTRURA DA ARRAY
                    break;
                }
            }
            if ($verifica) {
                return true;
            } else {
                return false;
            }
        }
    }

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
