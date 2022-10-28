<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$dadosAdmin = new DadosAdmin();
$dadosDePara = $dadosAdmin->getDadosDeParaGerais();
$dadosAdm = $dadosAdmin->getDadosAdmin();

$idStatusPedidosAprovados = $dadosAdm['idStatusPedidoAprovado'];
//var_dump($dadosAdm, $idStatusPedidosAprovados);
//die;

$configuracao = new Configuracoes(); //OBJETO CONFIGURAÇÕES  
$dadosConfig = $configuracao->getDadosConfigGeral();

$pedidosAdmin = new PedidosAdmin();
$filter = [
    "exportadoERP" => '0',
    "status" => $idStatusPedidosAprovados,
//    "idPedido" => 26
];
$pedidosAdmin->getListaDePedidos($filter);
$listaDePedidos = $pedidosAdmin->getDatas();

$clienteDados = new ClientesDadosEnderecosAdmin(); //OBJETO BUSCA TANDO DADOS DO CLIENTE QUANTO DADOS DE ENDERECO

$hsApiHorus = new HSApiHorus();
$hsEstruturaParametros = new HSEstruturaPametros(); //USADO PARA MONTAR A ESTRUTRUA DO HORUS - TIPO UM DE/PARA
$params = [];
$queryUpdate = "";
$paramsUpdate = [];
$c = 0;
foreach ($listaDePedidos as $order) {
    
    if($c == 5){
        break;
    }
    
//    var_dump($order);
    $hsEstruturaParametros->getEstruturaPedido($order);
    $idPedidoEros = $order['v_id'];
    $idCliEros = $order['id_cli'];
    $idEndereco = $order['id_endereco'];
    $tipoCliente = $order['tipo'];

    if ($tipoCliente == 'PF') {// SE O TIPO DE CLIENTE É PESSOA FISICA OU JURIDICA
        $cpf = Sistema::somenteNumeros($order['cpf']);
        $params['CPF'] = $cpf;
        $order['tipo'] = 'F';
        $order['cpf'] = $cpf;
    } elseif ($tipoCliente == 'PJ') {
        $cnpj = Sistema::somenteNumeros($order['CNPJ']); //UTILIZADO NA CONSULTA
        $params['CNPJ'] = $cnpj;
        $order['tipo'] = 'J';
        $order['cnpj'] = $cnpj;
    }

    //CONSULTANDO SE O CLIENTE JA EXISTE NO HORUS
    $dadosClienteERP = $hsApiHorus->getClienteERP($params);

    //DADOS CADASTRAIS DO CLIENTE
    if (empty($dadosClienteERP)) {//SE A CONSULTA RETORNAR VAZIO CADASTRA UM NOVO CLIENTE E OBTEM O CÓDIGO DO CLIENTE
        $order["id_cliente_erp"] = empty($order['id_cliente_erp']) ? "NOVO" : $order['id_cliente_erp']; // SE O ID DO CLIENTE VIER EM BRANCO SUBSTITUI POR NOVO -> PARAMETRO USADO NA API DO HORUS PARA ISNERIR UM NOVO CLIENTE
        $paramsCliente = $hsEstruturaParametros->getEstruturaCadastroCliente($order);
        $clienteERP = $hsApiHorus->insertClienteERP($paramsCliente);

        $idClienteERP = isset($clienteERP[0]->COD_CLI) ? $clienteERP[0]->COD_CLI : false; //AO INSERIR GUADANDO O CÓDIGO DO CLIENTE
    } else {//se não só guarda o código do cliente
        $idClienteERP = isset($dadosClienteERP[0]->COD_CLI) ? $dadosClienteERP[0]->COD_CLI : false;
    }

    if ($idClienteERP) {
        $dataSet = [
            "id_cliente_erp" => $idClienteERP
        ];
        $dataWhere = [
            "id_loja" => Config::ID_LOJA,
            "id_cli" => $idCliEros
        ];
        $clienteDados->updateTable('c_clientes', $dataSet, $dataWhere);
//        echo Sistema::msgSucess("Atualizado o id_cliente_erp no Eros para <b>{$idClienteERP}</b>");
    } else {
        echo Sistema::msgAlert("Não registrou código do cliente no insert da API");
    }

    $clienteDados->getEnderecosCliente($idCliEros, $idEndereco);
    $dadosEnderecoEntrega = isset($clienteDados->getDatas()[1]) ? $clienteDados->getDatas()[1] : false;

    if ($dadosEnderecoEntrega) {//ATUALIZANDO O ENDERECO DE ENTREGA
        $dadosEnderecoEntrega['id_cliente_erp'] = $idClienteERP;
        $dadosEnderecoEntrega['pais'] = "Brasil"; //SOMENTE BRASIL
        $dadosEnderecoEntrega['celular'] = $order['celular'];
        $dadosEnderecoEntrega['statusDefault'] = "S";
        $dadosEnderecoEntrega['cep'] = Sistema::somenteNumeros($dadosEnderecoEntrega['cep']);
        $dadosEnderecoERP = $hsEstruturaParametros->getEstruturaEnderecoCliente($dadosEnderecoEntrega);

        $enderecoClienteERP = $hsApiHorus->insertEnderecoClienteERP($dadosEnderecoERP);

        if ($enderecoClienteERP) {
            $retornoEndereco = isset($enderecoClienteERP->result[0][0]->Mensagem) ? $enderecoClienteERP->result[0][0]->Mensagem : false;
//            echo Sistema::msgSucess("Retorno endereço: " . $retornoEndereco);
        }
    }

    //DADOS DO PEDIDO
    $order['tipoPedido'] = "V";
    $order['entregaFutura'] = "N";
    $order['freteEmitenteDestinatario'] = "1"; //1 PARA EMITENTE E 2 PARA DESTINATARIO
    $order['codTransportadoraERP'] = isset($dadosDePara['transportadoraErosXErp'][$order['freteMode']]) ? $dadosDePara['transportadoraErosXErp'][$order['freteMode']] : false; //INSERIDO NAS CONFIGURAÇÕES de/para DO BANCO COM O NOME transportadoraErosXErp
    $order['codFormaPagtoERP'] = isset($dadosDePara['formaPagtoErosXErp'][$order['formaPagto']]) ? $dadosDePara['formaPagtoErosXErp'][$order['formaPagto']] : false;
    $order['obsPedido'] = "Pedido lojavirtual " . Config::SITE_NOME . " Nº #{$idPedidoEros} | Forma de pagto: {$order['tipoPagto']} | Bandeira: {$order['bandeira']} | Transação: {$order['nsu']}";

    if (!$order['codTransportadoraERP']) {
        echo Sistema::msgErroDanger("Necessário configurar os códigos DE/PARA da transportadora <b>{$order['freteMode']}</b> com a chave - <b>transportadoraErosXErp</b>");
        break;
    }

    if (!$order['codFormaPagtoERP']) {
        echo Sistema::msgErroDanger("Necessário configurar os códigos DE/PARA para forma de pagto <b>{$order['formaPagto']}</b> com a chave - <b>formaPagtoErosXErp</b>");
        break;
    }

    $dadosPedidoERP = $hsEstruturaParametros->getEstruturaPedido($order);
    $pedidoERP = $hsApiHorus->insertPedidoERP($dadosPedidoERP);

    $idPedidoERP = isset($pedidoERP[0]->COD_PED_VENDA) ? $pedidoERP[0]->COD_PED_VENDA : false;
    $pedidoConcluido = true;

    if ($idPedidoERP) {
        $pedidoItensAdmin = new PedidosItensAdmin();
        $pedidoItensAdmin->getItensPedido($idPedidoEros);
        $itensDoPedido = $pedidoItensAdmin->getDatas();


        foreach ($itensDoPedido as $item) {//ITENS DO PEDIDO
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
                $hsApiHorus->excluirItensDoPedido($dadosPedidoExclusao);
                break;
            }
        }

        if ($pedidoConcluido) {
            $dataSet = [
                "cod_pedido_erp" => $idPedidoERP,
                "pedido_exportado_erp" => '1',
                "id_status_prod" => $dadosConfig['codStatusAoEnviarParaErp']
            ];
            $dataWhere = [
                "v_id" => $idPedidoEros,
                "id_loja" => Config::ID_LOJA
            ];
            $configuracao->updateTable("l_vendas", $dataSet, $dataWhere);
            
            $columnsInserts = [
                "id_loja"=> Config::ID_LOJA,
                "id_venda"=>$idPedidoEros,
                "id_status"=>$dadosConfig['codStatusAoEnviarParaErp'],
                "id_user"=>-1
            ];
            
            $configuracao->insertTable("l_vendas_historico", $columnsInserts);
            
            $c ++;
        }
        
    } else {
        echo Sistema::msgErroDanger("Não foi possivel inserir o pedido <b>#{$idPedidoEros}</b> no ERP | {$pedidoERP[0]->Mensagem}");
    }
    
    break;
}

echo Sistema::msgSucess("{$c} pedido inseridos no Horus");


