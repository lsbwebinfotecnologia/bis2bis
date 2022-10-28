<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutoBis2Bis
 *
 * @author licivando
 */
class ProdutoBis2Bis {

    public $apiKey, $apiUser, $path, $session;

    public function __construct($apiKey, $apiUser, $path) {
        $this->setApiKey($apiKey);
        $this->setApiUser($apiUser);
        $this->setPath($path);
        $this->setSession();
    }

    function enviarEstoque($paramEstoque = []) {
        if (isset($paramEstoque['idMagento']) && isset($paramEstoque['qty'])) {
            $idMagento = $paramEstoque['idMagento'];
            $qty = $paramEstoque['qty'];
            $result = $this->SoapClient()->catalogInventoryStockItemUpdate(
                    (object) array(
                        'sessionId' => $this->session->result,
                        'productId' => $idMagento,
                        'data' => array(
                            'qty' => $qty,
                            'manage_stock' => 1,
                            'is_in_stock' => 1)
                    )
            );
            return $result;
        } else {
            echo Sistema::msgAlert("Necessário informar o idMagento");
            var_dump($paramEstoque);
            return false;
        }
//        var_dump($result->result);
    }

    function updateDadosProduto($dadosUpdate = []) {
        if (isset($dadosUpdate['productId']) && isset($dadosUpdate['dados'])) {
           
            try {
                $result = $this->SoapClient()->catalogProductUpdate(
                        (object) [
                            'sessionId' => $this->session->result,
                            'productId' => $dadosUpdate['productId'],
                            'productData' => [
                                (object) $dadosUpdate['dados']
                            ]
                        ]
                );
            } catch (Exception $ex) {
                var_dump($ex);
                $result = false;
            }

            return $result;
        } else {
            echo Sistema::msgAlert("Necessário informar o produtoID para atualizar o produto!");
            return false;
        }
    }

    function insertOptionAttr($paramsAttr = []) {

        if (isset($paramsAttr['nome']) && isset($paramsAttr['attributeId'])) {

            try {
                $result = $this->SoapClient()->catalogProductAttributeOptionsEdit(
                        array(
                            'sessionId' => $this->session->result,
                            'attributeId' => $paramsAttr['attributeId'],
                            'optionId' => null,
                            'optionData' => array(
                                'sort_order' => '0',
                                'values' => array('admin' => $paramsAttr['nome'], 'frontend' => $paramsAttr['nome'])
                            )
                        )
                );
            } catch (Exception $ex) {
                $result = false;
            }

            return $result;
        } else {
            echo Sistema::msgAlert("Necessário informar o nomeMarca, attributeId e idMagento para inserir a imagem");
            return false;
        }
    }

    //put your code here
    function insertImage($paramsImg = []) {

        if (isset($paramsImg['name']) && isset($paramsImg['idMagento']) && isset($paramsImg['sku'])) {
            $result = false;

            $file = Rotas::get_DirImagesCapas() . '/' . $paramsImg['sku'] . '.jpg';
            $img = file_exists($file) ? file_get_contents($file) : false;
            if ($img) {
                $content = base64_encode($img);
                try {
                    $result = $this->SoapClient()->catalogProductAttributeMediaCreate(
                            (object) [
                                'sessionId' => $this->session->result,
                                'productId' => $paramsImg['idMagento'],
                                'data' => ((object) [
                                    'label' => $paramsImg['name'],
                                    'position' => '1',
                                    'types' => array('image', 'small_image', 'thumbnail'),
                                    'exclude' => '0',
                                    'file' => ((object) [
                                        'content' => $content,
                                        'mime' => 'image/jpeg',
                                        'name' => 'image'
                                    ])
                                ])
                            ]
                    );
                } catch (Exception $ex) {
                    $result = false;
                }
            } else {
                echo Sistema::msgAlert("Não tem imagem na pasta de capas do Cronuz para o produto {$paramsImg['sku']}");
            }
//            var_dump($result);
            return $result;
        } else {
            echo Sistema::msgAlert("Necessário informar o nome, sku e idMagento para inserir a imagem");
            var_dump($paramsImg);
            return false;
        }
    }

    function removeImage($paramsImg = []) {

        if (isset($paramsImg['name']) && isset($paramsImg['idMagento']) && isset($paramsImg['sku'])) {

            try {
                $dataImage = $this->SoapClient()->catalogProductAttributeMediaList((object) array('sessionId' => $this->session->result, 'productId' => $paramsImg['idMagento']));
                $file = isset($dataImage->result->complexObjectArray->file) ? $dataImage->result->complexObjectArray->file : false;
            } catch (Exception $ex) {
                $file = false;
            }

            if ($file) {
                $result = $this->SoapClient()->catalogProductAttributeMediaRemove(
                        (object) array(
                            'sessionId' => $this->session->result,
                            'productId' => $paramsImg['idMagento'],
                            'file' => $file
                        )
                );
            } else {
                $result = false;
            }
            return $result;
        } else {
            echo Sistema::msgAlert("Necessário informar o nome, sku e idMagento para inserir a imagem");
            var_dump($paramsImg);
            return false;
        }
    }

    function getApiKey() {
        return $this->apiKey;
    }

    function getApiUser() {
        return $this->apiUser;
    }

    function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    function setApiUser($apiUser) {
        $this->apiUser = $apiUser;
    }

    function getPath() {
        return $this->path;
    }

    function getSession() {
        return $this->session;
    }

    function setPath($path) {
        $this->path = $path;
    }

    function SoapClient() {
        $proxy = new SoapClient($this->path . '/api/v2_soap/?wsdl');
        return $proxy;
    }

    function setSession() {
        $sessionId = $this->SoapClient()->login((object) array('username' => $this->apiUser, 'apiKey' => $this->apiKey));
        $this->session = $sessionId;
    }

}
