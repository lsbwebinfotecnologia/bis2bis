<?php

$user = isset($_SESSION['USUARIO']) ? true : false;
$key = isset($_GET['key']) && $_GET['key'] == 'Cr0nuz20' ? true : false;

if ($key) {
    require '../lib/autoload.php';
    $idLoja = Config::ID_LOJA;
}

$class = class_exists('Config');

if (!$class) {
    echo 'acesso negado';
    die;
}

$woocommerce = new Automattic\WooCommerce\Client(Config::WS_URL_LOJA, Config::WS_KEY_CONSUMER, Config::WS_SECRET_CONSUMER);

$configuracao = new Configuracoes();

//Opções: any, pending, processing, on-hold, completed, cancelled, refunded, failede trash. O padrão é any
$filter = [
    "status" => "processing",
//    "page"=>2,
//    "order"=> '148329',
    "per_page" => 50
];

$dataOrders = $woocommerce->get("orders", $filter);



//var_dump($dataOrders);
//die;

$clienteLojasCronuz = new Clientes();
//var_dump($dataOrders[0]);
$p = 0;
if (!empty($dataOrders)) {

    foreach ($dataOrders as $pedido) {
//        var_dump($pedido);

        if ($p == 5) {
            break;
        }

        $idPedidoLoja = isset($pedido->id) ? $pedido->id : false;


        $valorTotal = isset($pedido->total) ? $pedido->total : 0;
        $valorFrete = isset($pedido->shipping_total) ? $pedido->shipping_total : 0;
        $valorDesconto = isset($pedido->discount_total) ? $pedido->discount_total : 0;
        $cpfCnpj = !empty($pedido->billing->cpf) ? Sistema::somenteNumeros($pedido->billing->cpf) : Sistema::somenteNumeros($pedido->billing->cnpj);

        //TRATANDO DADOS DO CLIENTE
        $idClienteCronuz = $clienteLojasCronuz->clienteExiste($cpfCnpj);
        if (!$idClienteCronuz) {//SE O CLIENTE EXISTE
            $dadosCliente = [
                "nome" => $pedido->billing->first_name . ' ' . $pedido->billing->last_name,
                "email" => $pedido->billing->email,
                "telefone" => Sistema::somenteNumeros($pedido->billing->phone),
                "celular" => $pedido->billing->phone,
                "cpf" => Sistema::somenteNumeros($pedido->billing->cpf),
                "cnpj" => Sistema::somenteNumeros($pedido->billing->cnpj),
                "tipo" => !empty($pedido->billing->cpf) ? 'PF' : 'PJ',
                "id_loja" => Config::ID_LOJA
            ];
            $idClienteCronuz = $clienteLojasCronuz->insertTable('c_clientes', $dadosCliente);
        }

        $formaEnvio = isset($pedido->shipping_lines[0]->method_id) ? $pedido->shipping_lines[0]->method_id : 'ND';
        $prazo = 1;

        //TRATANDO DADOS DO ENDERECO
        $enderecoCronuz = new EnderecoCliente();
        $enderecoEntrega = $pedido->shipping;


        $cep = Sistema::somenteNumeros($enderecoEntrega->postcode);
        $filterEndereco = [
            "cep" => $cep,
            "id_cli" => $idClienteCronuz
        ];

        $bairro = $enderecoEntrega->neighborhood;
        if (empty($bairro) || $bairro == '') {
            $correio = new FlyingLuscas\Correios\Client();
            $consulta = $correio->zipcode()->find($cep);
            $bairro = empty($consulta['district']) ? "Não informado" : $consulta['district'];
        }

        $dadosEndereco = [
            "id_cli" => $idClienteCronuz,
            "logradouro" => $enderecoEntrega->address_1,
            "bairro" => $bairro,
            "numero" => $enderecoEntrega->number,
            "complemento" => substr($enderecoEntrega->address_2, 0, 100),
            "cidade" => $enderecoEntrega->city,
            "estado" => $enderecoEntrega->state,
            "cep" => $cep,
            "id_loja" => Config::ID_LOJA
        ];
//        var_dump($dadosEndereco);
        $endereco = $enderecoCronuz->getEnderecos($filterEndereco);
        if (!$endereco) {//SE NAO EXISTE O ENDERECEO CADASTRA UM NOVO
            $idEndereco = $enderecoCronuz->insertTable('c_enderecos', $dadosEndereco);
        } else {//SE EXISTE ATUALIZA MESMO ASSIM! VAI QUE O CLIENTE MUDOU O NUMERO OU O BAIRRO SEI LÁ TUDO ACONTECE
            $idEndereco = $endereco['id_e'];
            $dataWhere = [
                "id_e" => $idEndereco
            ];
            $enderecoCronuz->updateTable('c_enderecos', $dadosEndereco, $dataWhere);
        }

        $dadosGerais = [];
        foreach ($pedido->meta_data as $dado) {
            $key = $dado->key;
            $valor = $dado->value;
            $dadosGerais[$key] = $valor;
        }

        $tipoPagto = isset($dadosGerais['Tipo de pagamento']) ? $dadosGerais['Tipo de pagamento'] : "ND";
        $parcelas = isset($dadosGerais['Parcelas']) ? $dadosGerais['Parcelas'] : 1;

        $dataLvendas = [
            "id_pedido_loja" => $idPedidoLoja,
            "total" => $valorTotal,
            "total_desc" => $valorDesconto,
            "frete" => $valorFrete,
            "prazo" => $prazo,
            "id_cli" => $idClienteCronuz,
            "id_endereco" => $idEndereco,
            "status_pag" => isset($pedido->status) ? $pedido->status : "ND",
            "freteMode" => $formaEnvio,
            "tipoPagto" => $tipoPagto,
            "id_status_prod" => 'recebido', // 1 SIGINIFICA APROVADO PARA ENVIAR PAR AO HORUS
            "parcelas" => $parcelas,
            "id_loja" => Config::ID_LOJA
        ];

        $filterPedido = [
            "id_pedido_loja" => $idPedidoLoja
        ];

        $pedidosCronuz = new PedidosCronuz();
        $dataPedidoCronuz = $pedidosCronuz->getPedidos($filterPedido);
        if (!$dataPedidoCronuz) {//SE NÃO TEM O PEDIDO
            $idPedidoCronuz = $pedidosCronuz->insertTable('l_vendas', $dataLvendas);
            $p ++;
        } else {// SE JA EXISTE O PEDIDO
            $idPedidoCronuz = $dataPedidoCronuz[1]['v_id'];
        }

        $pedidosCronuzItens = new PedidosCronuzItens();

        $dataItens = isset($pedido->line_items) ? $pedido->line_items : false;

        if ($dataItens) {
            foreach ($dataItens as $item) {

                $sku = $item->sku;
                $idProduto = $pedidosCronuzItens->getIdProduto(["sku" => $sku]);


                if (!$idProduto) {//SE NAO TEM O ITEM DO PEDIDO EXCLUI O PEDIDO
                    $dataWhereItens = [
                        "id_venda" => $idPedidoCronuz
                    ];
                    $dataWherePedido = [
                        "v_id" => $idPedidoCronuz
                    ];
                    $pedidosCronuzItens->deleteTable('l_itens_vendas', $dataWhereItens);
                    $pedidosCronuzItens->deleteTable('l_vendas', $dataWherePedido);

                    $idPedidoCronuz = false;

                    echo Sistema::msgDanger("Nao encontrou SKU - {$item->id} | {$item->name} , pedido loja {$idPedidoLoja} | {$idPedidoCronuz} Cronuz será removido!");
                    $enviarEmail = new EnviarEmail();
                    $msg = "Nao encontrou SKU - {$item->id} | {$item->name} , pedido loja {$idPedidoLoja} | {$idPedidoCronuz} Cronuz será removido!";
                    $assunto = "Nao encontrou SKU loja - " . Config::ID_LOJA;
//                    $enviarEmail->Enviar($assunto, $msg, Config::EMAIL_COPY, $destinatariosOculto = []);
                    break;
                } else {//SE NAO INSERE
                    $qtd = (int) $item->quantity;

                    $dataItem = [
                        "id_venda" => $idPedidoCronuz,
                        "prod_id" => $idProduto,
                        "quantidade" => $qtd,
                        "val_unit" => $item->total,
                        "preco_bruto" => $qtd * (float) $item->total,
                        "desconto" => 0,
                        "desconto_cupom" => 0,
                        "preco_liq" => $item->total,
                        "id_loja" => Config::ID_LOJA
                    ];

                    $filterItem = [
                        "prod_id" => $idProduto,
                        "id_venda" => $idPedidoCronuz
                    ];

                    $existeItem = $pedidosCronuzItens->getItensDoPedido($filterItem);

                    if (!$existeItem && $idPedidoCronuz) {
                        $pedidosCronuzItens->insertTable('l_itens_vendas', $dataItem);
                    }
                }
            }
        } else {
            echo Sistema::msgDanger("Sem itens para o pedido");
        }
//        die;
    }
}

echo Sistema::msgSucess("{$p} pedido(s) inserido(s)");


$configuracao->updateDateIntegrador('wc-pedidos', 'Sincronização de pedidos - WC');


include (Rotas::get_DirControllerAdmin() . '/hs-pedidos.php');