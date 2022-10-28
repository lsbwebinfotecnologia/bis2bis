<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LojaIntegradaProdutos
 *
 * @author licivando
 */
class LojaIntegradaProdutos {

    //put your code here
    public function cadastrarProduto($data = []) {

        $configuracoes = new Configuracoes();
        $dadosLoja = $configuracoes->getDadosLojaIntegrada();

        if ($dadosLoja && $this->validarEstruturaProduto($data)) {//SE TIVER NA ESTRUTURA CORRETA
            $dataProduto = json_encode($data);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://api.awsli.com.br/v1/produto");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataProduto);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Authorization: chave_api " . $dadosLoja['chaveApi'] . " aplicacao " . $dadosLoja['chaveApp']
            ));

            $response = curl_exec($ch);
            curl_close($ch);

            return json_decode($response);
        } else {
            echo Sistema::msgDanger('Estrutura dos campos da array invalido!');
            return false;
        }
    }

    function cadastrarPreco($data = []) {
        $configuracoes = new Configuracoes();
        $dadosLoja = $configuracoes->getDadosLojaIntegrada();

        if ($dadosLoja) {//SE TIVER NA ESTRUTURA CORRETA
            $idProduto = $data['idLojaIntegrada'];
            unset($data['idLojaIntegrada']);
            $dataPreco = json_encode($data);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.awsli.com.br/v1/produto_preco/{$idProduto}");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPreco);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Authorization: chave_api " . $dadosLoja['chaveApi'] . " aplicacao " . $dadosLoja['chaveApp']
            ));
            $response = curl_exec($ch);
            curl_close($ch);
            return json_decode($response);
        } else {
            echo Sistema::msgDanger('Houve um erro ao inserir o preço!');
            return false;
        }
    }

    function atualizarEstoque($data = []) {
        $configuracoes = new Configuracoes();
        $dadosLoja = $configuracoes->getDadosLojaIntegrada();

        if ($dadosLoja) {//SE TIVER NA ESTRUTURA CORRETA
            $idProduto = $data['idLojaIntegrada'];
            unset($data['idLojaIntegrada']);
            $dataEstoque = json_encode($data);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.awsli.com.br/v1/produto_estoque/{$idProduto}");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataEstoque);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Authorization: chave_api " . $dadosLoja['chaveApi'] . " aplicacao " . $dadosLoja['chaveApp']
            ));
            $response = curl_exec($ch);
            curl_close($ch);
            return json_decode($response);
        } else {
            echo Sistema::msgDanger('Houve um erro ao inserir o estoque!');
            return false;
        }
    }

    function enviarImagem($data = []) {
        $configuracoes = new Configuracoes();
        $dadosLoja = $configuracoes->getDadosLojaIntegrada();

        if ($dadosLoja) {//SE TIVER NA ESTRUTURA CORRETA
            $dataImagem = json_encode($data);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.awsli.com.br/v1/produto_imagem/");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataImagem);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Authorization: chave_api " . $dadosLoja['chaveApi'] . " aplicacao " . $dadosLoja['chaveApp']
            ));
            $response = curl_exec($ch);
            curl_close($ch);
            return json_decode($response);
        } else {
            echo Sistema::msgDanger('Houve um erro ao inserir a imagem!');
            return false;
        }
    }

    function validarEstruturaProduto($data = []) {

        if ($data) {

            $campos = [
                'id_externo', 'sku', 'mpn', 'ncm', 'nome', 'descricao_completa', 'ativo', 'destaque', 'peso', 'altura', 'largura', 'profundidade', 'tipo', 'usado', 'categorias', 'marca', 'removido'
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

    function getIdCategoriaLojaIntegrada($nomesCategoria) {

        $idPai = false;
        $idLojaIntegrada = false;

        $explode = explode('/', $nomesCategoria);
        $nomeCategoriaPai = isset($explode[0]) ? trim($explode[0]) : false;
        $nomeCategoriaFilho = isset($explode[1]) ? trim($explode[1]) : false;

        $filtro = [
            'nome' => $nomeCategoriaPai
        ];

        $categoriasPai = new Categorias();
        $dataCategoriaPai = $categoriasPai->getCategoriasPai($filtro);

        if (!empty($dataCategoriaPai)) {
            $idPai = $dataCategoriaPai[$nomeCategoriaPai]['idPai'];
            $idLojaIntegrada = $dataCategoriaPai[$nomeCategoriaPai]['idLojaIntegrada'];
        }

        $filtro['nome'] = $nomeCategoriaFilho;
        $filtro['idPai'] = $idPai;
        $categoriasFilho = new Categorias();
        $dataCategoriaFilho = $categoriasFilho->getCategoriasFilho($filtro);

        if (!empty($dataCategoriaFilho)) {
            foreach ($dataCategoriaFilho as $catFilho) {
                $idLojaIntegrada = $catFilho['idLojaIntegrada'];
                $idPaiLojaIntegrada = $catFilho['idPaiLojaIntegrada'];
            }
        }

        return $idLojaIntegrada;
    }

    function formatarLista($data = []) {

        $format = [];
        if ($data) {
            $format["id_externo"] = isset($data['COD_ITEM']) ? $data['COD_ITEM'] : null;
            $format["sku"] = $data['COD_ITEM']; //'prod-simples'
//            $format["gtin"] = isset($data['COD_BARRA_ITEM']) ? $data['COD_BARRA_ITEM'] : null;;
            $format["mpn"] = null;
            $format["ncm"] = '49019900';
            $format["nome"] = isset($data['NOM_ITEM']) ? $data['NOM_ITEM'] : null;
            $format["descricao_completa"] = isset($data['DESC_SINOPSE']) ? $data['DESC_SINOPSE'] : null;
            $format["ativo"] = true;
            $format["destaque"] = false;
            $format["peso"] = isset($data['PESO_ITEM']) ? $data['PESO_ITEM'] / 1000 : null;
            $format["altura"] = isset($data['COMPRIMENTO_ITEM']) && $data['COMPRIMENTO_ITEM'] > 1 ? (int) $data['COMPRIMENTO_ITEM'] : Config::COMPRIMENTO_DEFAULT;
            $format["largura"] = isset($data['LARGURA_ITEM']) && $data['LARGURA_ITEM'] > 1 ? (int) $data['LARGURA_ITEM'] : Config::LARGURA_DEFAULT;
            $format["profundidade"] = isset($data['ALTURA_ITEM']) && $data['ALTURA_ITEM'] > 1 ? (int) $data['ALTURA_ITEM'] : Config::ALTURA_DEFAULT;
            $format["tipo"] = 'normal';
            $format["usado"] = false;
            $format["categorias"] = ["/api/v1/categoria/" . $this->getIdCategoriaLojaIntegrada($data['CATEGORIAS'])]; //$this->getIdCategoriaLojaIntegrada($data['CATEGORIAS']); //["/api/v1/categoria/"];
            $format["marca"] = isset($data['EDITORA']) ? $data['EDITORA'] : null;
            $format["removido"] = false;
            return $format;
        } else {
            return false;
        }
    }

}
