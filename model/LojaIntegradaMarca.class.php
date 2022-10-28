<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MarcaLojaIntegrada
 *
 * @author licivando
 */
class LojaIntegradaMarca {

    //put your code here
    public function cadastrarMarca($data = []) {
        
        $configuracoes = new Configuracoes();
        $dadosLoja = $configuracoes->getDadosLojaIntegrada();

        if ($dadosLoja && $dadosLoja && $this->validarEstruturaMarca($data)) {//SE TIVER NA ESTRUTURA CORRETA E COM CHAVE
            $dataMarca = json_encode($data);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.awsli.com.br/v1/marca");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataMarca);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Authorization: chave_api " . $dadosLoja['chaveApi'] . " aplicacao " . $dadosLoja['chaveApp']
            ));

            $response = curl_exec($ch);
            curl_close($ch);

            return json_decode($response);
        } else {
            echo Sistema::msgDanger('Estrura dos campos da array invalido ou  KEY de integração não encontrada!');
            return false;
        }
    }

    function validarEstruturaMarca($data = []) {

        if ($data) {
            $campos = [
                'id_externo', 'nome', 'apelido', 'descricao'
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
            $nome = isset($data['nome']) ? $data['nome'] : null;
            $idEditora = isset($data['id_editora_externo']) ? $data['id_editora_externo'] : null;
            $format["id_externo"] = $idEditora;
            $format["nome"] = $nome;
            $format["apelido"] = Sistema::GetSlug($nome);
            $format["descricao"] = "Editora ".$nome;
            return $format;
        } else {
            return false;
        }
    }

}
