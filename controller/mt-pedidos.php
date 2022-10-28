<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

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

ini_set("soap.wsdl_cache_enabled", 0);  //desabilita cache do wsdl do php - recomendavel qdo houver alteracao no wsdl

$path = 'https://www.livrariafavorita.com.br'; //api/v2_soap/?wsdl=1
$apiUser = 'erpcronuz';
$apiKey = '667424b020cb117';

$pedidosMagento = new PedidosMagento($apiKey, $apiUser, $path);



$adapter = new \Smalot\Magento\RemoteAdapter($path, $apiUser, $apiKey);

$dadosAdmin = new DadosAdmin();
$dadosDePara = $dadosAdmin->getDadosDeParaGerais();

$configuracao = new Configuracoes();
$tipoSincronizacao = "mt-pedidos";

$infoIntegrador = $configuracao->getInfoIntegrador($tipoSincronizacao);
if (isset($infoIntegrador['data_sicronizacao'])) {
    $dataIni = date('d/m/Y', strtotime($infoIntegrador['data_sicronizacao']));
} else {
    $configuracao->updateDateIntegrador($tipoSincronizacao, 'Sincronização de produtos - Magento');
}



$orderManager = new \Smalot\Magento\Order\Order($adapter);



$filtro = [
//    "increment_id" => "100000054", //CODIGO DO PEDIDO
    "state" => 'processing'
];
$orders = $orderManager->getList($filtro)->execute();
//var_dump($orders);
//die;
$clienteLojasCronuz = new Clientes();
$p = 0;
foreach ($orders as $order) {//LISTA DE PEDIDOS COM STATUS PROCESSANDO
//    echo '<pre>';

    $idPedidoLoja = $order['increment_id'];
    $orderID = $order['increment_id'];
    $orderInfo = $orderManager->getInfo(["increment_id" => $idPedidoLoja])->execute();
//    print_r($orderInfo);
//    die;
    $cpf = "";
    $cnpj = "";
    $tipoCliente = "";

    $valorTotal = isset($orderInfo['grand_total']) ? $orderInfo['grand_total'] : 0;
    $valorFrete = isset($orderInfo['shipping_amount']) ? $orderInfo['shipping_amount'] : 0;
    $valorDesconto = 0;
    if ($valorTotal <= 0) {//NÃO CONTINUA SE O VALOR FOR MENOR OU IGUAL A ZERO
        echo Sistema::msgDanger("Não pode ter o valor total zerado no pedido {$idPedidoLoja}, pedido não será integrado!");
        break;
    }


    $cpfCnpj = !empty($orderInfo['customer_taxvat']) ? Sistema::somenteNumeros($orderInfo['customer_taxvat']) : false;
    if (strlen($cpfCnpj) == 11) {
        $cpf = $cpfCnpj;
        $tipoCliente = 'PF';
    }

    if (strlen($cpfCnpj) == 14) {
        $cnpj = $cpfCnpj;
        $tipoCliente = 'PJ';
    }

    //TRATANDO DADOS DO CLIENTE
    $idClienteCronuz = $clienteLojasCronuz->clienteExiste($cpfCnpj);
    if (!$idClienteCronuz) {//SE O CLIENTE EXISTE
        $dadosCliente = [
            "nome" => mb_convert_case($orderInfo['customer_firstname'], MB_CASE_TITLE, 'UTF-8') . ' ' . mb_convert_case($orderInfo['customer_lastname'], MB_CASE_TITLE, 'UTF-8'),
            "email" => $orderInfo['customer_email'],
            "telefone" => isset($orderInfo['billing_address']['telephone']) ? Sistema::somenteNumeros($orderInfo['billing_address']['telephone']) : null,
            "celular" => isset($orderInfo['billing_address']['telephone']) ? Sistema::somenteNumeros($orderInfo['billing_address']['telephone']) : null,
            "cpf" => $cpf,
            "cnpj" => $cnpj,
            "tipo" => $tipoCliente,
            "id_loja" => Config::ID_LOJA
        ];

        $idClienteCronuz = $clienteLojasCronuz->insertTable('c_clientes', $dadosCliente);
    }

    $formaEnvio = isset($orderInfo['shipping_method']) ? $orderInfo['shipping_method'] : 'ND';
    $prazo = 1;

    //TRATANDO DADOS DO ENDERECO
    $enderecoCronuz = new EnderecoCliente();
    $enderecoEntrega = $orderInfo['shipping_address'];
    $cep = Sistema::somenteNumeros($enderecoEntrega['postcode']);
    $filterEndereco = [
        "cep" => $cep,
        "id_cli" => $idClienteCronuz
    ];

    $correio = new FlyingLuscas\Correios\Client();
    $consulta = $correio->zipcode()->find($cep);
//    var_dump($consulta);
//    die;
    $bairro = empty($enderecoEntrega['bairro']) || $enderecoEntrega['bairro'] == '' ? "Não informado" : $enderecoEntrega['bairro'];
    $dadosEndereco = [
        "id_cli" => $idClienteCronuz,
        "logradouro" => $enderecoEntrega['rua'] . ',' . $enderecoEntrega['numero'],
        "bairro" => $bairro,
        "numero" => $enderecoEntrega['numero'],
        "complemento" => substr($enderecoEntrega['complemento'], 0, 100),
        "cidade" => $enderecoEntrega['city'],
        "estado" => $consulta['uf'],
        "cep" => $cep,
        "id_loja" => Config::ID_LOJA
    ];
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
//die;
//    var_dump($orderInfo['payment']['installments']);

    $tipoPagto = isset($orderInfo['payment']['method']) ? $orderInfo['payment']['method'] : "ND";
    $parcelas = empty($orderInfo['payment']['installments']) || $orderInfo['payment']['installments'] == '' ? 1 : $orderInfo['payment']['installments'];


    $dataLvendas = [
        "id_pedido_loja" => $idPedidoLoja,
        "orderID" => $orderID,
        "total" => $valorTotal,
        "total_desc" => $valorDesconto,
        "frete" => $valorFrete,
        "prazo" => $prazo,
        "id_cli" => $idClienteCronuz,
        "id_endereco" => $idEndereco,
        "status_pag" => "ND",
        "freteMode" => $formaEnvio,
        "tipoPagto" => $tipoPagto,
        "id_status_prod" => 'recebido', // 1 SIGINIFICA APROVADO PARA ENVIAR PAR AO HORUS
        "parcelas" => $parcelas,
        "id_loja" => Config::ID_LOJA
    ];

//    var_dump($dataLvendas);
//    print_r($orderInfo);
//    die;

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

//    var_dump($idPedidoCronuz);
//    die;

    $pedidosCronuzItens = new PedidosCronuzItens();

    $dataItens = isset($orderInfo['items']) ? $orderInfo['items'] : false;

    if ($dataItens) {
        foreach ($dataItens as $item) {


            $sku = $item['sku'];
            $idProduto = $pedidosCronuzItens->getIdProduto(["sku" => $sku]);

//            var_dump($idProduto);
//            die;
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

                echo Sistema::msgDanger("Nao encontrou SKU - {$item['id']} | {$item['name']} , pedido loja {$idPedidoLoja} | {$idPedidoCronuz} Cronuz será removido!");
                $enviarEmail = new EnviarEmail();
                $msg = "Nao encontrou SKU - {$item['id']} | {$item['name']} , pedido loja {$idPedidoLoja} | {$idPedidoCronuz} Cronuz será removido!";
                $assunto = "Nao encontrou SKU loja - " . Config::ID_LOJA;
//                    $enviarEmail->Enviar($assunto, $msg, Config::EMAIL_COPY, $destinatariosOculto = []);
                break;
            } else {//SE NAO INSERE
                $qtd = (int) $item['qty_invoiced'];

                $discount = isset($item['discount_amount']) && $item['discount_amount'] > 0 ? $item['discount_amount'] : 0;
//                var_dump($discount, $item);
//                die;

                $dataItem = [
                    "id_venda" => $idPedidoCronuz,
                    "prod_id" => $idProduto,
                    "quantidade" => $qtd,
                    "val_unit" => (float) ($item['price']) / $qtd,
                    "preco_bruto" => (float) ($item['price']) * $qtd,
                    "desconto" => $discount,
                    "desconto_cupom" => 0,
                    "preco_liq" => (float) ($item['price'] - $discount) / $qtd,
                    "id_loja" => Config::ID_LOJA
                ];

                $filterItem = [
                    "prod_id" => $idProduto,
                    "id_venda" => $idPedidoCronuz
                ];

//                var_dump($dataItem);
//                die;

                $existeItem = $pedidosCronuzItens->getItensDoPedido($filterItem);



                if (!$existeItem && $idPedidoCronuz) {
                    $pedidosCronuzItens->insertTable('l_itens_vendas', $dataItem);
                }

//                die;
            }
        }
    } else {
        echo Sistema::msgDanger("Sem itens para o pedido");
    }
    
}

echo Sistema::msgSucess("{$p} pedido(s) integrados!");


include (Rotas::get_DirControllerAdmin() . '/hs-pedidos.php');
