<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstruturaTabela
 *
 * @author licivando
 */
class EstruturaTabela {

    //put your code here

    function getEstruturaProduto($data = array()) {
        if ($data) {
            //TRATAR DIMENSÕES NO EROS
            $altura = $data->ALTURA_ITEM ? $data->ALTURA_ITEM : Config::ALTU_DEFAULT;
            $largura = $data->LARGURA_ITEM ? $data->LARGURA_ITEM : Config::LARG_DEFAULT;
            $comprimento = $data->COMPRIMENTO_ITEM ? $data->COMPRIMENTO_ITEM : Config::COMP_DEFAULT;

            $produto = [
                "titulo" => $data->NOM_ITEM,
                "sub_titulo" => $data->SUBTITULO,
                'full_desc' => $data->DESC_SINOPSE,
                'unidades' => $data->SALDO_DISPONIVEL, //AVALIAR COM O FABIANO
                'dat_ult_atl_saldo' => $data->DAT_ULT_ATL,
                'id_cat' => null,
                'ativo' => 1, //CRIAR UMA FUNCAO
                'isbn' => $data->COD_BARRA_ITEM,
                //$produto['id_autor'] = $data->NOM_ITEM; 
                'id_editora' => null,
                'lanc_data' => $data->DAT_EXP_LANCTO,
                'edicao' => isset($data->EDICAO) ? $data->EDICAO : null,
                'paginas' => $data->QTD_PAGINAS,
                'dimensoes' => $altura . 'x' . $largura . 'x' . $comprimento,
                'peso' => $data->PESO_ITEM,
                'id_tipo_produto' => null, //Criar uma validação para inserir no banco
                'id_item_externo' => $data->COD_ITEM,
                'situacao_item' => $data->SITUACAO_ITEM,
                'data_atualizacao' => $data->DAT_ULT_ATL,
                'id_categoria_externo' => $data->COD_GENERO,
                'id_editora_externo' => $data->COD_EDITORA,
                'id_tipo_produto_externo' => null,
                'id_selo_externo' => null,
                'id_grupo_externo' => null,
                'preco_cheio' => 0,
                'status_item_erp' => $data->STATUS_ITEM,
                'id_loja' => Config::ID_LOJA
            ];

            return $produto;
        } else {
            die(var_dump("Necessário informar a array para inserir de produto"));
            return false;
        }
    }

    function getEstruturaAutor($data = array()) {
        if ($data) {

            $autor = [
                "id_tipo_autor"=>$data->COD_TIPO,
                "id_tipo_autor_externo"=>$data->COD_TIPO,
                "id_loja"=> Config::ID_LOJA,
                "nome_autor"=>$data->NOM_AUTOR,
                "tipoAutor"=>$data->NOM_TIPO,
                "ativo"=>'1',
                "id_autor_externo"=>$data->COD_AUTOR,
                "idItemExterno"=>$data->COD_ITEM,
            ];
            
            return $autor;
        } else {
            die(var_dump("Necessário informar a array para inserir Autore"));
            return false;
        }
    }

}
