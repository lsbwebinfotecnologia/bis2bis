<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SkyHubProdutos
 *
 * @author licivando
 */
class SkyHubProdutos {

    //put your code here
    public $attributes = array(), $images, $qty, $assunto, $categories = array(), $specifications = array(), $sku, $variations = array(), $variation_attributes = array();

    public function insertProduto() {
        $resposta = false;
        if ($this->attributes) {

            $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);

            //SE FOR ADICIONAR UM PRODUTO COM VARIACAO DE ATRIBUTOS
            if ($this->variations || $this->variation_attributes) {
                $resposta = $api->product()->create($this->sku, $this->attributes, $this->images, $this->categories, $this->specifications, $this->variations, $this->variation_attributes)->export();
            } else {//ENVIAR UM PRODUTO SIMPLES
                $resposta = $api->product()->create($this->sku, $this->attributes, $this->images, $this->categories, $this->specifications)->export();
            }
        }
        return $resposta;
    }

    function createVariation($data = array()) {
        $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);
        $resposta = $api->product()->createVariation($data['sku'], $data['variationSku'], $data['variationQty'], $data['variationEan'])->export();

        return $resposta;
    }

    function prepararAtributos($product = array()) {

        if ($product) {
            $attributes = array(
                'sku' => $product['sku'],
                'name' => $product['name'],
                'description' => $product['description'],
                'status' => $product['status'],
                'qty' => $product['qty'],
                'price' => $product['price'],
                'promotional_price' => $product['promotional_price'],
                'cost' => $product['cost'],
                'weight' => $product['weight'],
                'height' => $product['height'],
                'width' => $product['width'],
                'length' => $product['length'],
                'brand' => $product['brand'],
                //'store_stock_cross_docking' => Config::SKYHUB_STORE_PRAZO_CROSDOCKING,
                'ean' => $product['ean'],
                //'Tamanho' => $product['Tamanho'],
                'nbm' => $product['nbm']
            );

            $this->setSku($product['sku']);
            $this->setQty($product['qty']);
            $this->setImages($product['images']);
            $this->setCategories($product['code_category'], $product['name_category']);
            $this->setAssunto($product['assunto']);
            $this->setSpecifications();
            //$this->setVariations();
            //$this->setVariation_attributes();
        } else {
            echo 'É obrigatório informar os dados do Produto!';
            die;
        }

        $this->attributes = $attributes;
    }

    function setImages($images) {
        $dir = Config::SKYHUB_DIR_IMG . '/' . $images;
        $this->images = array($dir);
    }

    function getVariations() {
        return $this->variations;
    }

    function setVariations($variations = array()) {
        $resposta = [];
        $resposta[0]['sku'] = $this->sku;
        $resposta[0]['qty'] = $this->qty;
//        $resposta[1]['sku'] = "9788538071730"; //TRABALHANDO COM MAIS DE UMA VARIACAO NO PRODUTO
//        $resposta[1]['qty'] = "89";
        $c = 0;
        if ($variations) {
            foreach ($variations as $variation) {
                $resposta[0]['specifications'][$c]['key'] = $variation['tipoAtributo'];
                $resposta[0]['specifications'][$c]['value'] = $variation['atributo'];

                $c ++;
            }
//
//            $resposta[1]['specifications'][0]['key'] = "Cor";
//            $resposta[1]['specifications'][0]['value'] = "Verde";
//            $resposta[1]['specifications'][1]['key'] = "price";
//            $resposta[1]['specifications'][1]['value'] = "10.80";
//            $resposta[1]['specifications'][2]['key'] = "promotional_price";
//            $resposta[1]['specifications'][2]['value'] = "29.80";

            $this->variations = $resposta;
        }
    }

    function getVariation_attributes() {
        return $this->variation_attributes;
    }

    function setVariation_attributes() {
        $tipoAtributos = new ProdutosAtributos();
        $resposta = [];
        foreach ($tipoAtributos->getAllAtributosTipo() as $value) {
            array_push($resposta, $value['tipoAtributo']);
        }
        $this->variation_attributes = $resposta;
    }

    function setCategories($code, $name) {
        $this->categories = array(
            array(
                'code' => $code,
                'name' => $name,
            )
        );
    }

    function updateProdutoSkyHub() {
        $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);

        //SE FOR ADICIONAR UM PRODUTO COM VARIACAO DE ATRIBUTOS
        if ($this->variations || $this->variation_attributes) {
            $resposta = $api->product()->update($this->sku, $this->attributes, $this->images, $this->categories, $this->specifications, $this->variations, $this->variation_attributes)->export();
        } else {//ENVIAR UM PRODUTO SIMPLES
            $resposta = $api->product()->update($this->sku, $this->attributes, $this->images, $this->categories, $this->specifications)->export();
        }
        return $resposta;
    }

    function setSpecifications($specifations = array()) {

        $resposta = [];
        $c = 0;
        if ($specifations) {//SE TEM TIPO DE ATRIBUTO ESPECIFICACAO NO BANCO, ENVIA, *OBRIGATÓRIO O ASSUNTO
            foreach ($specifations as $specifation) {
                $resposta[$c]['key'] = $specifation['tipoAtributo'];
                $resposta[$c]['value'] = $specifation['atributo'];
                $c ++;
            }

            $resposta[$c]['key'] = "ASSUNTO";
            $resposta[$c]['value'] = $this->assunto;
            $this->specifications = $resposta;
        } else {
            $this->specifications = array(
                array(
                    'key' => 'ASSUNTO',
                    'value' => $this->assunto,
                )
            );
        }
    }

    function getAssunto() {
        return $this->assunto;
    }

    function setAssunto($assunto) {
        $this->assunto = $assunto;
    }

    function setSku($sku) {
        $this->sku = $sku;
    }

    function getQty() {
        return $this->qty;
    }

    function setQty($qty) {
        $this->qty = $qty;
    }

    function getDadosProdutosSkyHub($sku) {
        $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);

        /** @var \SkyHub\Api\Handler\Request\Catalog\ProductHandler $requestHandler */
        $requestHandler = $api->product();
        /** @var SkyHub\Api\Handler\Response\HandlerInterface $response */
        $response = $requestHandler->product($sku)->export();
        return $response;
    }

    function getListProducts() {
        $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);

        /** @var \SkyHub\Api\Handler\Request\Catalog\ProductHandler $requestHandler */
        $requestHandler = $api->product();
        /** @var SkyHub\Api\Handler\Response\HandlerInterface $response */
        $response = $requestHandler->products(1, 100)->export();
        return $response;
    }

    function deleteProduto($sku) {
        $api = new SkyHub\Api(Config::SKYHUB_EMAIL, Config::SKYHUB_KEY, Config::SKYHUB_ACOUNT_KEY);

        if ($api->product()->delete($sku)->export()) {
            return $api->product()->delete($sku)->export();
        } else {
            return false;
        }
    }
    


}
