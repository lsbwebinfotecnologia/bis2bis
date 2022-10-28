<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$user = isset($_SESSION['USUARIO']) ? true : false;
$keyCron = isset($_GET['key']) && $_GET['key'] == 'Cr0nuz20' ? true : false;

if ($keyCron) {
    require '../lib/autoload.php';
    $idLoja = Config::ID_LOJA;
}

$class = class_exists('Config');

if (!$class) {
    echo 'acesso negado';
    die;
}





$dadosAdmin = new DadosAdmin();
$dadosDePara = $dadosAdmin->getDadosDeParaGerais();

$configuracao = new Configuracoes(); //OBJETO CONFIGURAÇÕES  
$dadosConfig = $configuracao->getDadosConfigGeral();
//var_dump($dadosConfig);
//DIE;

$estados = new Estados();
$estadosLista = $estados->getEstado();


$idStatusPedidosAprovados = isset($dadosConfig['idStatusPedidoAprovado']) ? $dadosConfig['idStatusPedidoAprovado'] : false;

if (!$idStatusPedidosAprovados) {
    echo Sistema::msgAlert("Necessário informar o ID que irá buscar pedidos aprovados");
    die;
}


$pedidosAdmin = new PedidosCronuz();
$filter = [
    "pedido_exportado_erp" => '0',
//    "status_pag" => $idStatusPedidosAprovados,
    "id_status_prod" => $idStatusPedidosAprovados
];

if (isset($_GET['idCronuz'])) {
    $filter = [
        "v_id" => $_GET['idCronuz']
    ];
}

$listaDePedidos = $pedidosAdmin->getPedidos($filter);
//var_dump($listaDePedidos);
//die;
$clienteDados = new ClientesDadosEnderecosAdmin(); //OBJETO BUSCA TANDO DADOS DO CLIENTE QUANTO DADOS DE ENDERECO

$hsApiHorus = new HSApiHorus();
$hsEstruturaParametros = new HSEstruturaPametros(); //USADO PARA MONTAR A ESTRUTRUA DO HORUS - TIPO UM DE/PARA
$params = [];
$queryUpdate = "";
$paramsUpdate = [];
$c = 0;
if (!empty($listaDePedidos)) {
    foreach ($listaDePedidos as $order) {
//        var_dump($order);
//        die;
        if ($c == 5) {
            break;
        }
        $order['codEmpresa'] = $dadosConfig['codEmpresa'];
        $order['codFilial'] = $dadosConfig['codFilial'];

        $hsEstruturaParametros->getEstruturaPedido($order);

        $idPedidoCronuz = $order['v_id'];
        $idCliCronuz = $order['id_cli'];
        $idEndereco = $order['id_endereco'];
        $tipoCliente = $order['tipo'];

        if ($tipoCliente == 'PF') {// SE O TIPO DE CLIENTE É PESSOA FISICA OU JURIDICA
            $cpf = Sistema::somenteNumeros($order['cpf']);
            $params['CPF'] = $cpf;
            $order['tipo'] = 'F';
            $order['cpf'] = $cpf;
        } elseif ($tipoCliente == 'PJ') {
            $cnpj = Sistema::somenteNumeros($order['cnpj']); //UTILIZADO NA CONSULTA
            $params['CNPJ'] = $cnpj;
            $order['tipo'] = 'J';
            $order['cnpj'] = $cnpj;
        }

        //CONSULTANDO SE O CLIENTE JA EXISTE NO HORUS
        $dadosClienteERP = $hsApiHorus->getClienteERP($params);

        var_dump($dadosClienteERP);
        die;

        //DADOS CADASTRAIS DO CLIENTE
        if (empty($dadosClienteERP)) {//SE A CONSULTA RETORNAR VAZIO CADASTRA UM NOVO CLIENTE E OBTEM O CÓDIGO DO CLIENTE
            $order["id_cliente_erp"] = empty($order['id_cliente_erp']) ? "NOVO" : $order['id_cliente_erp']; // SE O ID DO CLIENTE VIER EM BRANCO SUBSTITUI POR NOVO -> PARAMETRO USADO NA API DO HORUS PARA ISNERIR UM NOVO CLIENTE
            $order["codRespCli"] = $dadosConfig['codResponsavelClienteERP'];
            $order["cliente"] = mb_convert_case($order['nome'], MB_CASE_TITLE, 'UTF-8');
            $order["nomeRespCli"] = $dadosConfig['nomeResponsavelClienteERP'];
            $paramsCliente = $hsEstruturaParametros->getEstruturaCadastroCliente($order);
       
            $clienteERP = $hsApiHorus->insertClienteERP($paramsCliente);
            $idClienteERP = isset($clienteERP[0]->COD_CLI) ? $clienteERP[0]->COD_CLI : false; //AO INSERIR GUADANDO O CÓDIGO DO CLIENTE
            $order["id_cliente_erp"] = $idClienteERP;
        } else {//se não só guarda o código do cliente
            
            if (count($dadosClienteERP) == 1) {
                $idClienteERP = isset($dadosClienteERP[0]->COD_CLI) ? $dadosClienteERP[0]->COD_CLI : false;
            } else {
                $idClienteERP = isset($dadosClienteERP[1]->COD_CLI) ? $dadosClienteERP[1]->COD_CLI : false;
            }
        }
        $order["id_cliente_erp"] = $idClienteERP;
        $paramsTipoCliente = [
            "COD_CLI" => $idClienteERP,
            "COD_TIPO_CLIENTE" => $dadosConfig['codTipoCli'],
            "STA_DEFAULT" => "S"
        ];

        $hsApiHorus->insertTipoDeClienteERP($paramsTipoCliente);

        if ($idClienteERP) {
            $dataSet = [
                "id_cliente_erp" => $idClienteERP
            ];
            $dataWhere = [
                "id_loja" => Config::ID_LOJA,
                "id_cli" => $idCliCronuz
            ];
            $clienteDados->updateTable('c_clientes', $dataSet, $dataWhere);
//        echo Sistema::msgSucess("Atualizado o id_cliente_erp no Eros para <b>{$idClienteERP}</b>");
        } else {
            echo Sistema::msgAlert("Não registrou código do cliente no insert da API");
        }

        $clienteDados->getEnderecosCliente($idCliCronuz, $idEndereco);
        $dadosEnderecoEntrega = isset($clienteDados->getDatas()[1]) ? $clienteDados->getDatas()[1] : false;
//        var_dump($dadosEnderecoEntrega);

        if ($dadosEnderecoEntrega) {//ATUALIZANDO O ENDERECO DE ENTREGA
            $dadosEnderecoEntrega['id_cliente_erp'] = $idClienteERP;
            $dadosEnderecoEntrega['pais'] = "Brasil"; //SOMENTE BRASIL
            $dadosEnderecoEntrega['celular'] = $order['celular'];
            $dadosEnderecoEntrega['cidade'] = $order['cidade'];
            $dadosEnderecoEntrega['uf'] = $order['uf'];
            $dadosEnderecoEntrega['descricaoUF'] = isset($estadosLista[$order['uf']]) ? $estadosLista[$order['uf']] : false;
            $dadosEnderecoEntrega['statusDefault'] = "S";
            $dadosEnderecoEntrega['nomeRespCli'] = mb_convert_case(strtok($order['nome'], " "), MB_CASE_TITLE, 'UTF-8');
            $dadosEnderecoEntrega['codTipoEndCli'] = isset($dadosConfig['codTipoEndCli']) ? $dadosConfig['codTipoEndCli'] : 1;
            $order['codTipoEndCli'] = $dadosConfig['codTipoEndCli'];
            $dadosEnderecoEntrega['statusValido'] = "S";
            $dadosEnderecoEntrega['cep'] = Sistema::somenteNumeros($dadosEnderecoEntrega['cep']);
            $dadosEnderecoERP = $hsEstruturaParametros->getEstruturaEnderecoCliente($dadosEnderecoEntrega);
            $enderecoClienteERP = $hsApiHorus->insertEnderecoClienteERP($dadosEnderecoERP);
            
//            var_dump($enderecoClienteERP);
            if ($enderecoClienteERP) {
                $retornoEndereco = isset($enderecoClienteERP->result[0][0]->Mensagem) ? $enderecoClienteERP->result[0][0]->Mensagem : false;
            }
        }

        //DADOS DO PEDIDO
        $order['tipoPedido'] = "V";
        $order['entregaFutura'] = "N";
        $order['freteEmitenteDestinatario'] = "1"; //1 PARA EMITENTE E 2 PARA DESTINATARIO
        $order['codTransportadoraERP'] = isset($dadosDePara['transportadoraErosXErp'][$order['freteMode']]) ? $dadosDePara['transportadoraErosXErp'][$order['freteMode']] : false; //INSERIDO NAS CONFIGURAÇÕES de/para DO BANCO COM O NOME transportadoraErosXErp
        $order['codFormaPagtoERP'] = isset($dadosDePara['formaPagtoErosXErp'][$order['tipoPagto']]) ? $dadosDePara['formaPagtoErosXErp'][$order['tipoPagto']] : false;
        $order['obsPedido'] = "Pedido lojavirtual Nº #{$order['id_pedido_loja']}";

        if (!$order['codTransportadoraERP']) {
            echo Sistema::msgDanger("Necessário configurar os códigos DE/PARA da transportadora <b>{$order['freteMode']}</b> com a chave - <b>transportadoraErosXErp</b>");
            break;
        }
//    var_dump($order);
        if (!$order['codFormaPagtoERP']) {
            echo Sistema::msgDanger("Necessário configurar os códigos DE/PARA para forma de pagto <b>{$order['tipoPagto']}</b> com a chave - <b>formaPagtoErosXErp</b>");
            break;
        }
        $descontoAdicional = 0;
        if ($order['total_desc'] > 0.01) {
            $descontoAdicional = round(100 * ($order['total_desc'] / ($order['total'] - $order['frete'])));
        }
//        var_dump($descontoAdicional);
//        die;

        unset($order['total_desc']);
        $dadosPedidoERP = $hsEstruturaParametros->getEstruturaPedido($order);
        $pedidoERP = $hsApiHorus->insertPedidoERP($dadosPedidoERP);
//        var_dump($pedidoERP);

        $idPedidoERP = isset($pedidoERP[0]->COD_PED_VENDA) ? $pedidoERP[0]->COD_PED_VENDA : false;
        $pedidoConcluido = true;
        if ($idPedidoERP) {
            $pedidoItensAdmin = new PedidosItensAdmin();
            $pedidoItensAdmin->getItensPedido($idPedidoCronuz);
            $itensDoPedido = $pedidoItensAdmin->getDatas();
//            var_dump($itensDoPedido);

            foreach ($itensDoPedido as $item) {//ITENS sDO PEDIDO
                if ($descontoAdicional > 0) {
                    $item['precoLiquidoBD'] = $item['precoLiquidoBD'] - ($item['precoLiquidoBD'] * ($descontoAdicional / 100));
                }
                $item['presente'] = "N";
                $item['idPedidoERP'] = $idPedidoERP;
                $item['id_cliente_erp'] = $idClienteERP;
                $dadosItensPedidoERP = $hsEstruturaParametros->getEstruturaItensDoPedido($item);
                $itemERP = $hsApiHorus->insertItensDoPedidoERP($dadosItensPedidoERP);
                $msgRetornoItem = isset($itemERP[0]->Mensagem) ? $itemERP[0]->Mensagem : false;
                if ($msgRetornoItem != 'REGISTRO ENVIADO COM SUCESSO!') {
                    echo Sistema::msgAlert("Erro ao inserir o item {$item['titulo']} do pedido ERP <b>{$idPedidoERP}</b>");
                    $dadosPedidoExclusao = [
                        "COD_EMPRESA" => $dadosConfig['codEmpresa'],
                        "COD_FILIAL" => $dadosConfig['codFilial'],
                        "COD_CLI" => $idClienteERP,
                        "COD_PED_VENDA" => $idPedidoERP
                    ];
                    $pedidoConcluido = false;
//                    $hsApiHorus->excluirItensDoPedido($dadosPedidoExclusao);
                    break;
                }
            }

            if ($pedidoConcluido) {

                $paramsUpdateStatusOrder = [
                    "codEmpresa" => $dadosConfig['codEmpresa'],
                    "codFilial" => $dadosConfig['codFilial'],
                    "id_cliente_erp" => $idClienteERP,
                    "cod_pedido_erp" => $idPedidoERP,
                    "statuPedidoEnviadoERP" => $dadosConfig['statuPedidoEnviadoERP']
                ];

                $paramsStatusUpdateOrder = $hsEstruturaParametros->getEstruturaModificaStatusPedido($paramsUpdateStatusOrder);
                $statusPedidoAtualizado = $hsApiHorus->updateStatusPedido($paramsStatusUpdateOrder);

                $dataSet = [
                    "cod_pedido_erp" => $idPedidoERP,
                    "pedido_exportado_erp" => '1',
                    "id_status_prod" => $dadosConfig['codStatusAoEnviarParaErp']
                ];
                $dataWhere = [
                    "v_id" => $idPedidoCronuz,
                    "id_loja" => Config::ID_LOJA
                ];



                $configuracao->updateTable("l_vendas", $dataSet, $dataWhere);

                $columnsInserts = [
                    "id_loja" => Config::ID_LOJA,
                    "id_venda" => $idPedidoCronuz,
                    "id_status" => $dadosConfig['codStatusAoEnviarParaErp'],
                    "id_user" => -1
                ];

                $configuracao->insertTable("l_vendas_historico", $columnsInserts);


                $c ++;
            }
        } else {
            echo Sistema::msgDanger("Não foi possivel inserir o pedido <b>#{$idPedidoCronuz}</b> no ERP | {$pedidoERP[0]->Mensagem}");
        }
    }
}


echo Sistema::msgSucess("{$c} pedido inseridos no Horus");

///PEDIDOS QUE SERAO ATUALIZADOS
$pedidosAdmin2 = new PedidosCronuz();
$filter2 = [
    "pedido_exportado_erp" => '1',
    "status_pag" => 'attended',
    "id_status_prod" => "enviado-para-erp"
];
if (isset($_GET['idCronuz'])) {
    $filter2 = [
        "v_id" => $_GET['idCronuz']
    ];
}
$listaDePedidos2 = $pedidosAdmin2->getPedidos($filter2);
$c2 = 0;
$qtdPedidosPendente = 0;
if (!empty($listaDePedidos2)) {
    $qtdPedidosPendente = count($listaDePedidos2);
    foreach ($listaDePedidos2 as $order2) {

        if ($c2 == 5) {
            break;
        }
        $paramsNF = [
            "COD_EMPRESA" => $dadosConfig['codEmpresa'],
            "COD_FILIAL" => $dadosConfig['codFilial'],
            "COD_CLI" => $order2["id_cliente_erp"],
            "COD_PED_VENDA" => $order2["cod_pedido_erp"]
        ];

        $dadosNF = $hsApiHorus->getNotasFiscais($paramsNF);

        if (isset($dadosNF[0]->CHAVE_ACESSO_NFE)) {
            $detalhesNF = $dadosNF[0];

            $dataSet2 = [
                "chave_nfe" => $detalhesNF->CHAVE_ACESSO_NFE,
                "nro_nota_fiscal" => $detalhesNF->NRO_NOTA_FISCAL,
                "id_status_prod" => "faturado"
            ];

            $dataWhere2 = [
                "id_loja" => Config::ID_LOJA,
                "cod_pedido_erp" => $order2["cod_pedido_erp"]
            ];

            $pedidosAdmin2->updateTable("l_vendas", $dataSet2, $dataWhere2);
            $c2 ++;
        } else {
            echo Sistema::msgAlert("Nenhuma informação de NF para o pedido ERP <b>{$order2["cod_pedido_erp"]}</b>");
//            var_dump($dadosNF);
        }
    }
}
echo Sistema::msgSucess("{$c2} / {$qtdPedidosPendente} pedido(s) atualizado(s) no Cronuz para faturado");

///PEDIDOS QUE SERAO ATUALIZADOS
$pedidosAdmin3 = new PedidosCronuz();
$filter3 = [
    "pedido_exportado_erp" => '1',
    "status_pag" => 'attended',
    "id_status_prod" => "faturado"
];
if (isset($_GET['idCronuz'])) {
    $filter3 = [
        "v_id" => $_GET['idCronuz']
    ];
}
$listaDePedidos3 = $pedidosAdmin3->getPedidos($filter3);
$c3 = 0;
$qtdPedidosPendente3 = 0;
if (!empty($listaDePedidos3)) {
    foreach ($listaDePedidos3 as $order3) {
        $qtdPedidosPendente3 = count($listaDePedidos3);
        if ($c3 == 5) {
            break;
        }
        $dataOrder = [
            "orderID" => $order3['orderID'],
            "nfe_number" => $order3["nro_nota_fiscal"],
            "nfe_token" => $order3["chave_nfe"],
            "nfe_series" => 1
        ];


    }
}

echo Sistema::msgSucess("{$c3} / {$qtdPedidosPendente3} pedido(s) atualizado(s) na Bis2Bis para faturado");
