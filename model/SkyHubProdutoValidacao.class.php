<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SkyHubProdutoValidacao
 *
 * @author licivando
 */
class SkyHubProdutoValidacao {

    //put your code here
    public function validaProduto($data = array()) {
        $resposta = array();
        $resposta['error'] = false;
        $resposta['msg'] = false;
        if ($data) {
            if ($data['price'] == 0.00) {
//                var_dump("Obrigatório Informar o Preco para o produto: {$data['id_produto']} - ISBN:{$data['ean']}");
                $resposta['error'] = true;
                $resposta['msg'] = "Obrigatório Informar o Preco para o produto: {$data['id_produto']} - ISBN:{$data['ean']}";
            }

            if (!$data['sku']) {
//                var_dump("Obrigatório Informar o SKU para o produto: {$data['id_produto']} - ISBN:{$data['ean']}");
                $resposta['error'] = true;
                $resposta['msg'] = "Obrigatório Informar o SKU para o produto: {$data['id_produto']} - ISBN:{$data['ean']}";
            }

            if (!$data['name']) {
//                var_dump("Obrigatório Informar o titulo para o produto: {$data['id_produto']} - ISBN:{$data['ean']}");
                $resposta['error'] = true;
                $resposta['msg'] = "Obrigatório Informar o titulo para o produto: {$data['id_produto']} - ISBN:{$data['ean']}";
            }
            
            if ($data['images'] == 'semimagem.png') {
//                var_dump("Obrigatório Informar o titulo para o produto: {$data['id_produto']} - ISBN:{$data['ean']}");
                $resposta['error'] = true;
                $resposta['msg'] = "Obrigatório Informar a imagem para o produto: {$data['id_produto']} - ISBN:{$data['ean']}";
            }

            if (!$data['description']) {
//                var_dump("Obrigatório Informar a descricao para o produto: {$data['id_produto']} - ISBN:{$data['ean']}");
                $resposta['error'] = true;
                $resposta['msg'] = "Obrigatório Informar a descricao para o produto: {$data['id_produto']} - ISBN:{$data['ean']}";
            }

            if ($data['weight'] == 0.00) {
//                var_dump("Obrigatório Informar o peso para o produto: {$data['id_produto']} - ISBN:{$data['ean']}");
                $resposta['error'] = true;
                $resposta['msg'] = "Obrigatório Informar o peso para o produto: {$data['id_produto']} - ISBN:{$data['ean']}";
            }

            if ($data['height'] == 0.00) {
//                var_dump("Obrigatório Informar a altura para o produto: {$data['id_produto']} - ISBN:{$data['ean']}");
                $resposta['error'] = true;
                $resposta['msg'] = "Obrigatório Informar a altura para o produto: {$data['id_produto']} - ISBN:{$data['ean']}";
            }

            if ($data['width'] == 0.00) {
//                var_dump("Obrigatório Informar a largura para o produto: {$data['id_produto']} - ISBN:{$data['ean']}");
                $resposta['error'] = true;
                $resposta['msg'] = "Obrigatório Informar a largura para o produto: {$data['id_produto']} - ISBN:{$data['ean']}";
            }

            if ($data['length'] == 0.00) {
//                var_dump("Obrigatório Informar o comprimento para o produto: {$data['id_produto']} - ISBN:{$data['ean']}");
                $resposta['error'] = true;
                $resposta['msg'] = "Obrigatório Informar o comprimento para o produto: {$data['id_produto']} - ISBN:{$data['ean']}";
            }

            if (!$data['brand']) {
//                var_dump("Obrigatório Informar a (Marca/Editora) para o produto: {$data['id_produto']} - ISBN:{$data['ean']}");
                $resposta['error'] = true;
                $resposta['msg'] = "Obrigatório Informar a (Marca/Editora) para o produto: {$data['id_produto']} - ISBN:{$data['ean']}";
            }

            if (!$data['name_category']) {
//                var_dump("Obrigatório Informar a categoria para o produto: {$data['id_produto']} - ISBN:{$data['ean']}");
                $resposta['error'] = true;
                $resposta['msg'] = "Obrigatório Informar a categoria para o produto: {$data['id_produto']} - ISBN:{$data['ean']}";
            }

            if (!$data['code_category']) {
//                var_dump("Obrigatório Informar o codigo da categoria para o produto: {$data['id_produto']} - ISBN:{$data['ean']}");
                $resposta['error'] = true;
                $resposta['msg'] = "Obrigatório Informar o codigo da categoria para o produto: {$data['id_produto']} - ISBN:{$data['ean']}";
            }

            if (!$data['assunto']) {
//                var_dump("Obrigatório Informar o Assunto para o produto: {$data['id_produto']} - ISBN:{$data['ean']}");
                $resposta['error'] = true;
                $resposta['msg'] = "Obrigatório Informar o Assunto para o produto: {$data['id_produto']} - ISBN:{$data['ean']}";
            }
        }else{
//            var_dump('Obrigatório inforamar a array com os dados!');
            $resposta['error'] = true;
            $resposta['msg'] = 'Obrigatório inforamar a array com os dados!';
        }


        return $resposta;
    }

}
