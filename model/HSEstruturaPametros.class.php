<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HSEstruturaPametros
 *
 * @author licivando
 */
class HSEstruturaPametros extends Conexao {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function getEstruturaCadastroCliente($params = []) {

        $configuracao = new Configuracoes(); //OBJETO CONFIGURAÇÕES  
        $dadosConfig = $configuracao->getDadosConfigGeral();

        $horus = [//MONTANDO O DE PARA - CAMPOS DO EROS X CAMPOS DO HORUS
            "id_cliente_erp" => "COD_CLI",
            "cliente" => "NOM_CLI",
            "codRespCli" => "COD_RESPONSAVEL",
            "nomeRespCli" => "NOM_RESP",
            "email" => "EMAIL",
            "tipo" => "TPO_PESSOA",
            "cnpj" => "CNPJ",
            "cpf" => "CPF",
        ];

        $retorno = [];
        foreach ($params as $key => $dado) {
            if (isset($horus[$key])) {
                $retorno[$horus[$key]] = $dado;
            }
        }

        foreach ($dadosConfig as $key => $config) {
            if (isset($horus[$key])) {
                $retorno[$horus[$key]] = $config;
            }
        }

        return $retorno;
    }

    function getEstruturaEnderecoCliente($params = []) {

        $configuracao = new Configuracoes(); //OBJETO CONFIGURAÇÕES  
        $dadosConfig = $configuracao->getDadosConfigGeral();

//        var_dump($dadosConfig);

        $horus = [//MONTANDO O DE PARA - CAMPOS DO EROS X CAMPOS DO HORUS
            "id_cliente_erp" => "COD_CLI",
            "codTipoEndCli" => "COD_TPO_END",
            "pais" => "NOM_PAIS",
            "uf" => "SIGLA_UF",
            "descricaoUF" => "NOME_UF",
            "cidade" => "NOM_LOCAL",
            "bairro" => "NOM_BAIRRO",
            "logradouro" => "DESC_ENDERECO",
            "numero" => "NUM_END",
            "complemento" => "COM_ENDERECO",
            "cep" => "CEP",
            "celular" => "CEL_ENDERECO",
            "statusDefault" => "STA_DEFAULT",
        ];

        $retorno = [];
        foreach ($params as $key => $dado) {
            if (isset($horus[$key])) {
                $retorno[$horus[$key]] = $dado;
            }
        }

        foreach ($dadosConfig as $key => $config) {
            if (isset($horus[$key])) {
                $retorno[$horus[$key]] = $config;
            }
        }

        return $retorno;
    }

    function getEstruturaPedido($params = []) {

        $configuracao = new Configuracoes(); //OBJETO CONFIGURAÇÕES  
        $dadosConfig = $configuracao->getDadosConfigGeral();

        $horus = [//MONTANDO O DE PARA - CAMPOS DO EROS X CAMPOS DO HORUS
            "codEmpresa" => "COD_EMPRESA",
            "codFilial" => "COD_FILIAL",
            "id_cliente_erp" => "COD_CLI",
            "tipoPedido" => "TIPO_PEDIDO_V_T_D",
//            "entregaFutura" => "ENTREGA_FUTURA",
            "obsPedido" => "OBS_PEDIDO",
            "codTransportadoraERP" => "COD_TRANSP",
            "codMetodoVenda" => "COD_METODO",
            "codTipoEndCli" => "COD_TPO_END",
            "freteEmitenteDestinatario" => "FRETE_EMIT_DEST",
            "codFormaPagtoERP" => "COD_FORMA",
            "qtdParcelas" => "QTD_PARCELAS",
            "frete" => "VLR_FRETE",
//            "" => "DADOS_ADICIONAIS_NF",
            "v_id" => "COD_PEDIDO_ORIGEM",
//            "" => "COD_BANDEIRA_CARTAO",
//            "nsu" => "COD_AUTORIZACAO_CARTAO",
//            "" => "COD_DOCUMENTO_CARTAO",
        ];

        $retorno = [];
        foreach ($params as $key => $dado) {
            if (isset($horus[$key])) {
                $retorno[$horus[$key]] = $dado;
            }
        }

        foreach ($dadosConfig as $key => $config) {
            if (isset($horus[$key])) {
                $retorno[$horus[$key]] = $config;
            }
        }

        return $retorno;
    }
    
     function getEstruturaModificaStatusPedido($params = []) {

        $configuracao = new Configuracoes(); //OBJETO CONFIGURAÇÕES  
        $dadosConfig = $configuracao->getDadosConfigGeral();

        $horus = [//MONTANDO O DE PARA - CAMPOS DO EROS X CAMPOS DO HORUS
            "codEmpresa" => "COD_EMPRESA",
            "codFilial" => "COD_FILIAL",
            "id_cliente_erp" => "COD_CLI",
            "cod_pedido_erp" => "COD_PED_VENDA",
            "statuPedidoEnviadoERP" => "STA_PEDIDO",
        ];

        $retorno = [];
        foreach ($params as $key => $dado) {
            if (isset($horus[$key])) {
                $retorno[$horus[$key]] = $dado;
            }
        }

        foreach ($dadosConfig as $key => $config) {
            if (isset($horus[$key])) {
                $retorno[$horus[$key]] = $config;
            }
        }

        return $retorno;
    }
    
    function getEstruturaItensDoPedido($params = []) {

        $configuracao = new Configuracoes(); //OBJETO CONFIGURAÇÕES  
        $dadosConfig = $configuracao->getDadosConfigGeral();

        $horus = [//MONTANDO O DE PARA - CAMPOS DO EROS X CAMPOS DO HORUS
            "codEmpresa" => "COD_EMPRESA",
            "codFilial" => "COD_FILIAL",
            "id_cliente_erp" => "COD_CLI",
            "idPedidoERP" => "COD_PED_VENDA",
            "id_item_externo" => "COD_ITEM",
            "quantidade" => "QTD_PEDIDA",
            "precoLiquidoBD" => "VLR_LIQUIDO",
        ];

        $retorno = [];
        foreach ($params as $key => $dado) {
            if (isset($horus[$key])) {
                $retorno[$horus[$key]] = $dado;
            }
        }

        foreach ($dadosConfig as $key => $config) {
            if (isset($horus[$key])) {
                $retorno[$horus[$key]] = $config;
            }
        }

        return $retorno;
    }

}
