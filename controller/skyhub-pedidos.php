<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//die;
echo '<pre>';

$statusWork = [//STATUS DOS PEDIDOS QUE IREMOS TRATAR
    "payment_received",
    "book_product",
    "order_canceled",
    "complete"
];

$orderSkyhub = new SkyHubPedido();
$pedidos = $orderSkyhub->getFilaPedidos(100);

//var_dump($pedidos);

//TRABALHANDO A ARRAY COM OS DADOS DO PEDIDOS

if (empty($pedidos) || $pedidos == "") {
    die('Nenhum Pedido para sincronizar');
} else {
    foreach ($pedidos as $pedido) {//INSERINDO OS PEDIDOS NO CRONUS-EROSCOMMERCE
        //var_dump($pedido);
        $cliente = new ClientesSkyHub();
        $enderecoEntrega = new EnderecoClienteSkyHub();
        $enderecoPrincipal = new EnderecoClienteSkyHub();
        $dadosDePara = new DadosDePara();

        //DADOS DO PEDIDO
        $dataOrderSkyhub = [
            "idPedSkyhub" => $pedido['id_ped_skyhub'],
            "statusSkyhub" => $pedido['status_skyhub'],
            "statusTypeSkyhub" => $pedido['statusTypeSkyhub'],
            "statusLabelSkyhub" => $pedido['statusLabelSkyhub'],
            "tipoFreteSkyhub" => $pedido['tipoFrete'],
            "canalSkyhub" => $pedido['canal_skyhub'],
            "remoteCodeSkyhub" => $pedido['remote_code'],
            "typeCalculationFreteSkyhub" => $pedido['typeCalculation'],
            "total" => $pedido["total"],
//        "idCliente" => $idCliente,
//        "idEndereco" => $idEndercoEntrega,
            "frete" => $pedido["shipping_cost"],
            "statusProd" => $dadosDePara->getDePara("status_order_skyhub", $pedido['status_skyhub']),
            "statusPag" => $dadosDePara->getDePara("status_pag_order_skyhub", $pedido['status_skyhub']), //avaliar como trabalhar
            "totalDesconto" => $pedido["discount"],
            "tipoPagto" => "skyhub",
            "freteMode" => $pedido["tipoFrete"],
            "dataClient" => [
                "nomeCliente" => $pedido['client']['nome'],
                "apelidoCliente" => $pedido['client']['nome'],
                "email" => $pedido['client']['email'],
                "cpfCnpj" => $pedido['client']['cpfCnpj']
            ],
            "enderecoEntrega" => [
                "logradouro" => $pedido['endEntrega']['logradouro'],
                "numero" => $pedido['endEntrega']['numero'],
                "complemento" => $pedido['endEntrega']['complemento'],
                "telefone" => $pedido['endEntrega']['telefone'],
                "bairro" => $pedido['endEntrega']['bairro'],
                "cep" => $pedido['endEntrega']['cep'],
                "uf" => $pedido['endEntrega']['uf'],
                "cidade" => $pedido['endEntrega']['cidade'],
                "tipo" => "Entrega"
            ],
            "enderecoPrincipal" => [
                "logradouro" => $pedido['endFaturamento']['logradouro'],
                "numero" => $pedido['endFaturamento']['numero'],
                "complemento" => $pedido['endFaturamento']['complemento'],
                "telefone" => $pedido['endFaturamento']['telefone'],
                "bairro" => $pedido['endFaturamento']['bairro'],
                "cep" => $pedido['endFaturamento']['cep'],
                "uf" => $pedido['endFaturamento']['uf'],
                "cidade" => $pedido['endFaturamento']['cidade'],
                "tipo" => "Principal"
            ],
            "itens" => $pedido["itens"]
        ];

        //PREPARANDO OS DADOS DE CLIENTE E ENDERECO PARA INSERIR
        $cliente->prepara($dataOrderSkyhub["dataClient"]);
        $enderecoEntrega->prepara($dataOrderSkyhub["enderecoEntrega"]);
        $enderecoPrincipal->prepara($dataOrderSkyhub["enderecoPrincipal"]);

        $cpfCnpj = $dataOrderSkyhub["dataClient"]["cpfCnpj"];

        if ($cliente->clienteExiste($cpfCnpj)) {//SE O CLIENTE EXISTE NO BANCO BUSCA O ID DO CLIENTE E DAR UM INSERT IGNORE NO ENDERECO PARA DESPOIS RESGATAR O ID
            $idCliente = $cliente->getIdClientePorCpf($cpfCnpj);

            if ($idCliente) {
                //INFORMO NA CLASSE O ID DO CLIENTE E REALIZO O INSERT IGNORE
                $enderecoEntrega->setIdCliente($idCliente);
                $enderecoPrincipal->setIdCliente($idCliente);
                $enderecoEntrega->insertEndereco();
                $enderecoPrincipal->insertEndereco();

                //RESGATA O ULTIMO ID INSERIDO PARA O TIPO DE ENDERECO
                $idEnderecoEntrega = $enderecoEntrega->getIdEndereco($dataOrderSkyhub["enderecoEntrega"]["tipo"], $idCliente);
                $idEnderecoPrincipal = $enderecoEntrega->getIdEndereco($dataOrderSkyhub["enderecoPrincipal"]["tipo"], $idCliente);
            } else {
                var_dump("Não encontrou o id do cliente para o CPF/CNPJ: {$cpfCnpj}");
            }

            //var_dump($idCliente, "JÁ existe", $enderecoEntrega, $enderecoPrincipal);
        } else {//SE O CLIENTE NAO EXISTE NO BANCO DE DADOS INSERE E GUARDA O ID
            $cliente->insertCliente();
            $idCliente = $cliente->getIdClientePorCpf($cpfCnpj);

            if ($idCliente) {
                //INFORMO NA CLASSE O ID DO CLIENTE E REALIZO O INSERT IGNORE
                $enderecoEntrega->setIdCliente($idCliente);
                $enderecoPrincipal->setIdCliente($idCliente);
                $enderecoEntrega->insertEndereco();
                $enderecoPrincipal->insertEndereco();

                //RESGATA O ULTIMO ID INSERIDO PARA O TIPO DE ENDERECO
                $idEnderecoEntrega = $enderecoEntrega->getIdEndereco($dataOrderSkyhub["enderecoEntrega"]["tipo"], $idCliente);
                $idEnderecoPrincipal = $enderecoEntrega->getIdEndereco($dataOrderSkyhub["enderecoPrincipal"]["tipo"], $idCliente);
            } else {
                var_dump("Não encontrou o id do cliente para o CPF/CNPJ: {$cpfCnpj}");
            }

            //var_dump($idCliente, "não existe", $enderecoEntrega, $enderecoPrincipal);
        }

        //INSERINDO O PEDIDO JÁ COM OS IDS DE CLIENTES E IDS DE ENDERECOS
        $order = new Pedidos();
        $orderItens = new PedidosItens();

        $idPedSkyhub = $dataOrderSkyhub["idPedSkyhub"];
        $statusSkyhub = $dataOrderSkyhub["statusSkyhub"];

        $dataItens = $dataOrderSkyhub['itens']; //ARRAY COM OS ITENS DO PEDIDO

        if (in_array($statusSkyhub, $statusWork)) {//PEDIDO COM O STATUS DE PAGAMENTO APROVADO OU PEDIDO PENDENTE
            if ($order->existOrder($idPedSkyhub)) {//SE EXISTE O PEDIDO NO BD
                $dataOrderInBD = $order->getDataOrder($idPedSkyhub);
                $idPedido = $dataOrderInBD['v_id'];
                $idStatusProd = $dataOrderSkyhub["statusProd"];

                $statusOrderInBD = $dataOrderInBD['status_skyhub'];

                if ($statusOrderInBD != $statusSkyhub) {//CAMPOS QUE SERÃO ATUALIZADOS
                    $dataSet = [
                        "status_skyhub" => $statusSkyhub,
                        "statusTypeSkyhub" => $dataOrderSkyhub["statusTypeSkyhub"],
                        "statusLabelSkyhub" => $dataOrderSkyhub["statusLabelSkyhub"],
                        "id_status_prod" => $idStatusProd,
                        "status_pag" => $dataOrderSkyhub["statusPag"],
                    ];

                    $dataWhere = [
                        "id_ped_skyhub" => $idPedSkyhub,
                        "id_loja" => Config::ID_LOJA
                    ];

                    //INSERINDO NO HISTORICO
                    $evento = new EventosCronus();
                    $evento->updateTable("l_vendas", $dataSet, $dataWhere);
                    $order->insertHistorico($idPedido, $idStatusProd);
                    $order->insertHistoricoSkyhub($idPedido, $statusSkyhub);
                    $orderSkyhub->deleteOrderOfFila($idPedSkyhub); //TIRA DA FILA

                    var_dump("Pedido MKT: {$idPedSkyhub} alterado no banco. Status-Skyhub: {$statusSkyhub} | Status BD: {$statusOrderInBD}");
                } else {
                    var_dump("Não Houve nenhuma alteração para o pedido $idPedSkyhub! <br>");
                }

                $orderSkyhub->deleteOrderOfFila($idPedSkyhub); //DELETANDO O PEDIDO DA FILA
            } else {//SE O PEDIDO NAO EXISTE NO BD IRÁ INSERIR
                $order->setIdCliente($idCliente);
                $order->setIdEndereco($idEnderecoEntrega);
                $order->prepare($dataOrderSkyhub);
                if ($order->verify()) {//VERIFICA SE ESTA COM TODO OS CAMPOS
                    $order->insertOrder(); //INSERINDO O PEDIDO

                    $idPedido = $order->getIdOrder($idPedSkyhub); //PEGANDO O ID DO PEDIDO PELO NUMERO DO PEDIDO DA SKYHUB

                    $order->insertHistorico($idPedido, $dataOrderSkyhub['statusProd']); //INSERINDO O HISTORICO DO PEDIDO
                    $order->insertHistoricoSkyhub($idPedido, $statusSkyhub); //INSERINDO O HISTORICO DO PEDIDO

                    echo ("Pedido MKT: {$idPedSkyhub} Inserido no banco com o número {$idPedido} <br>");

                    //INSERINDO OS ITENS DO PEDIDO
                    $orderItens->setIdPedido($idPedido); //SETANDO O NUMERO DO PEDIDO
                    $orderItens->insertItensPedido($dataItens);
                    $orderSkyhub->deleteOrderOfFila($idPedSkyhub); //TIRA DA FILA
                }
            }
        }
    }
}







