<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosERP
 *
 * @author licivando
 */
class PedidosERP {

    //put your code here
    public $responsavel, $pedidoLoja, $pedidoBD, $codCliERP, $codTransportadora, $codEmpresa, $codFilial, $obsPedido, $codMetodoVenda, $codTipoEndereco, $tipoFrete, $vlrFrete;
    public $formaPagto, $vlrPedido;

    function insertPedidoERP($tipoPedido = 'Normal') {
        
        $tipoOrderHS = 'V';
        
        if($tipoPedido == 'Reenvio'){
            $tipoOrderHS = 'D';
            $this->setCodMetodoVenda(5);
        }

        $params = array(
            "COD_EMPRESA" => $this->codEmpresa,
            "COD_FILIAL" => $this->codFilial,
            "COD_CLI" => $this->codCliERP,
            "OBS_PEDIDO" => $this->obsPedido,
            "COD_TRANSP" => $this->codTransportadora,
            "COD_METODO" => $this->codMetodoVenda,
            "COD_TPO_END" => $this->codTipoEndereco,
            "FRETE_EMIT_DEST" => $this->tipoFrete,
            "VLR_FRETE" => $this->vlrFrete,
            "NOM_RESP" => $this->responsavel,
            "COD_PEDIDO_ORIGEM" => $this->pedidoLoja,
            "DATA_EST_ENTREGA" => '',
            "TIPO_PEDIDO_V_T_D" => $tipoOrderHS,
            "COD_CENTRO_CUSTO" => '',
            "COD_BANDEIRA_CARTAO" => '',
            "COD_AUTORIZACAO_CARTAO" => '',
            "COD_DOCUMENTO_CARTAO" => '',
            "VLR_OUTRAS_DESP" => 0,
            "DADOS_ADICIONAIS_NF" => ""
        );

        $wsHorus = new WSHorus();
        $linkInsertPedido = $wsHorus->getLinkWSPedido() . '/F_InserePedidoVenda';
        $insertERP = $wsHorus->connectWebService($linkInsertPedido, $params);
        return $insertERP;
    }

    function insertItensPedidoERP($idPedidoERP, $itens = array()) {

        $wsHorus = new WSHorus();
        $linkInsertItemPedido = $wsHorus->getLinkWSPedido() . '/G_InsereItensPedidoVenda';
        foreach ($itens as $value) {
            $params = array(
                "COD_EMPRESA" => $this->codEmpresa,
                "COD_FILIAL" => $this->codFilial,
                "COD_CLI" => $this->codCliERP,
                "COD_PED_VENDA" => $idPedidoERP,
                "COD_ITEM" => $value['id_item_ws'],
                "QTD_PEDIDA" => $value['quantidade'],
                "VLR_LIQUIDO" => str_replace('.', ',', ($value['preco_liq'] / $value['quantidade']))
            );
            $wsHorus->connectWebService($linkInsertItemPedido, $params);
        }
    }

    function insertPagamentoPedidoERP($idPedidoERP, $qtdParcelas) {

        $valorPedido = str_replace(',', '.', $this->vlrPedido);
        $valorFrete = str_replace(',', '.', $this->vlrFrete);

        $params = array(
            "COD_EMPRESA" => $this->codEmpresa,
            "COD_FILIAL" => $this->codFilial,
            "COD_CLI" => $this->codCliERP,
            "COD_FORMA" => $this->formaPagto,
            "COD_PED_VENDA" => $idPedidoERP,
            "VLR_PEDIDO" => str_replace('.', ',', ($valorPedido - $valorFrete)),
            "QTD_PARCELAS" => $qtdParcelas
        );

        $wsHorus = new WSHorus();
        $linkInsertPagtoPedido = $wsHorus->getLinkWSPedido() . '/H_InserePagamentoGeral';
        $insertERP = $wsHorus->connectWebService($linkInsertPagtoPedido, $params);
        return $insertERP;
    }

    function atualizaStatusPedido($idPedidoERP, $status) {

        $params = array(
            "COD_EMPRESA" => $this->codEmpresa,
            "COD_FILIAL" => $this->codFilial,
            "COD_PED_VENDA" => $this->formaPagto,
            "COD_CLI" => $this->codCliERP,
            "COD_PED_VENDA" => $idPedidoERP,
            "NOVO_STATUS" => $status
        );

        $wsHorus = new WSHorus();
        $linkIUpdateStatus = $wsHorus->getLinkWSPedido() . '/O_AlteraStatusPedidoVenda';
        $updateERP = $wsHorus->connectWebService($linkIUpdateStatus, $params);
        return $updateERP;
    }

    function prepara($responsavel, $pedidoLoja, $codCliERP, $codTransportadora, $codEmpresa, $codFilial, $obsPedido, $codMetodoVenda, $codTipoEndereco, $tipoFrete, $vlrFrete) {
        $this->setResponsavel($responsavel);
        $this->setPedidoLoja($pedidoLoja);
        $this->setCodCliERP($codCliERP);
        $this->setCodTransportadora($codTransportadora);
        $this->setCodEmpresa($codEmpresa);
        $this->setCodFilial($codFilial);
        $this->setObsPedido($obsPedido);
        $this->setCodMetodoVenda($codMetodoVenda);
        $this->setCodTipoEndereco($codTipoEndereco);
        $this->setTipoFrete($tipoFrete);
        $this->setVlrFrete($vlrFrete);
    }

    function getDadosNotasPedidoErp($idPedidoERP) {
        $params = array(
            "COD_EMPRESA" => $this->getCodEmpresa(),
            "COD_FILIAL" => $this->getCodFilial(),
            "COD_CLI" => $this->codCliERP,
            "COD_PED_VENDA" => $idPedidoERP
        );


        $wsHorus = new WSHorus();
        $linkListPagtoPedido = $wsHorus->getLinkWSPedido() . '/L_ConsultaNotaFiscalPedido';
        $listPedidoERP = $wsHorus->connectWebService($linkListPagtoPedido, $params);
        return $listPedidoERP;
    }

    function getDadosRastreioPedidoErp($idPedidoERP) {
        $params = array(
            "COD_EMPRESA" => $this->getCodEmpresa(),
            "COD_FILIAL" => $this->getCodFilial(),
            "COD_CLI" => $this->codCliERP,
            "COD_PED_VENDA" => $idPedidoERP
        );


        $wsHorus = new WSHorus();
        $linkListPagtoPedido = $wsHorus->getLinkWSPedido() . '/M_ConsultaVolumesPedido';
        $listPedidoERP = $wsHorus->connectWebService($linkListPagtoPedido, $params);
        return $listPedidoERP;
    }

    function getDadosPedidoErp($idPedidoERP) {
        $params = array(
            "COD_EMPRESA" => $this->getCodEmpresa(),
            "COD_FILIAL" => $this->getCodFilial(),
            "COD_CLI" => $this->codCliERP,
            "COD_PED_VENDA" => $idPedidoERP
        );


        $wsHorus = new WSHorus();
        $linkListPagtoPedido = $wsHorus->getLinkWSPedido() . '/D_ListaPedidoVenda';
        $listPedidoERP = $wsHorus->connectWebService($linkListPagtoPedido, $params);
        return $listPedidoERP;
    }

    function getResponsavel() {
        return $this->responsavel;
    }

    function getCodCliERP() {
        return $this->codCliERP;
    }

    function setCodCliERP($codCliERP) {
        $this->codCliERP = $codCliERP;
    }

    function getPedidoBD() {
        return $this->pedidoBD;
    }

    function getCodEmpresa() {
        return $this->codEmpresa;
    }

    function getCodFilial() {
        return $this->codFilial;
    }

    function getObsPedido() {
        return $this->obsPedido;
    }

    function getCodMetodoVenda() {
        return $this->codMetodoVenda;
    }

    function getCodTipoEndereco() {
        return $this->codTipoEndereco;
    }

    function getTipoFrete() {
        return $this->tipoFrete;
    }

    function getVlrFrete() {
        return $this->vlrFrete;
    }

    function setResponsavel($responsavel) {
        $this->responsavel = $responsavel;
    }

    function getCodTransportadora() {
        return $this->codTransportadora;
    }

    function setCodTransportadora($codTransportadora) {
        $configuracao = new Configuracoes();

        if ($codTransportadora == 'correios-pac') {
            $this->codTransportadora = $configuracao->getDadosConfig('codPac');
        } elseif ($codTransportadora == 'correios-sedex') {
            $this->codTransportadora = $configuracao->getDadosConfig('codSedex');
        }elseif ($codTransportadora == 'free_shipping') {
            $this->codTransportadora = 'FREE';
        } elseif($codTransportadora == 'correios-impresso-normal'){
            $this->codTransportadora = $configuracao->getDadosConfig('codImpressoModico');
        }elseif($codTransportadora == 'MODICO'){
            $this->codTransportadora = $configuracao->getDadosConfig('codImpressoModico');
        }elseif($codTransportadora == 'PAC'){
            $this->codTransportadora = $configuracao->getDadosConfig('codPac');
        }elseif($codTransportadora == 'SEDEX'){
            $this->codTransportadora = $configuracao->getDadosConfig('codSedex');
        }else {
            $this->codTransportadora = $configuracao->getDadosConfig('codOutra');
        }
    }

    function getFormaPagto() {
        return $this->formaPagto;
    }

    function getVlrPedido() {
        return $this->vlrPedido;
    }

    function setFormaPagto($formaPagto) {
        $configuracao = new Configuracoes();

        if ($formaPagto == 'creditCard') {
            $this->formaPagto = $configuracao->getDadosConfig('codFormaPagtoCCredVenda');
        } elseif($formaPagto == 'Cartão de Crédito'){
            $this->formaPagto = $configuracao->getDadosConfig('codFormaPagtoCCredVenda');
        }else {
            $this->formaPagto = $configuracao->getDadosConfig('codFormaPagtoBoletoVenda');
        }
    }

    function setVlrPedido($vlrPedido) {
        $this->vlrPedido = $vlrPedido;
    }

    function setPedidoBD($pedidoBD) {
        $this->pedidoBD = $pedidoBD;
    }

    function setCodEmpresa($codEmpresa) {
        $this->codEmpresa = $codEmpresa;
    }

    function setCodFilial($codFilial) {
        $this->codFilial = $codFilial;
    }

    function getPedidoLoja() {
        return $this->pedidoLoja;
    }

    function setPedidoLoja($pedidoLoja) {
        $this->pedidoLoja = $pedidoLoja;
    }

    function setObsPedido($obsPedido) {
        $this->obsPedido = $obsPedido;
    }

    function setCodMetodoVenda($codMetodoVenda) {
        $this->codMetodoVenda = $codMetodoVenda;
    }

    function setCodTipoEndereco($codTipoEndereco) {
        $this->codTipoEndereco = $codTipoEndereco;
    }

    function setTipoFrete($tipoFrete) {
        $this->tipoFrete = $tipoFrete;
    }

    function setVlrFrete($vlrFrete) {
        $this->vlrFrete = $vlrFrete;
    }

}
