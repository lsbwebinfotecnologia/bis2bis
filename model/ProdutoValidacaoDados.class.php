<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutoValidacaoDados
 *
 * @author licivando
 */
class ProdutoValidacaoDados {
    //put your code here
    public $peso, $precoCheio, $precoPromo, $altura, $largura, $comprimento, $sinopse;
    
    public function __construct($peso, $precoCheio, $precoPromo, $altura, $largura, $comprimento, $sinopse) {
        $this->peso = $peso;
        $this->precoCheio = $precoCheio;
        $this->precoPromo = $precoPromo;
        $this->altura = $altura;
        $this->largura = $largura;
        $this->comprimento = $comprimento;
        $this->sinopse = $sinopse;
    }
    
    function validaDados() {
        
    }
    
    function getPeso() {
        return $this->peso;
    }

    function getPrecoCheio() {
        return $this->precoCheio;
    }

    function getPrecoPromo() {
        return $this->precoPromo;
    }

    function getAltura() {
        return $this->altura;
    }

    function getLargura() {
        return $this->largura;
    }

    function getComprimento() {
        return $this->comprimento;
    }

    function getSinopse() {
        return $this->sinopse;
    }

    function setPeso($peso) {
        $this->peso = $peso;
    }

    function setPrecoCheio($precoCheio) {
        $this->precoCheio = $precoCheio;
    }

    function setPrecoPromo($precoPromo) {
        $this->precoPromo = $precoPromo;
    }

    function setAltura($altura) {
        $this->altura = $altura;
    }

    function setLargura($largura) {
        $this->largura = $largura;
    }

    function setComprimento($comprimento) {
        $this->comprimento = $comprimento;
    }

    function setSinopse($sinopse) {
        $this->sinopse = $sinopse;
    }


}
