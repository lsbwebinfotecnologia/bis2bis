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


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//echo '<pre>';
//CONFIGURAÇÕES VALORES FIXOS
$configuracao = new Configuracoes(); //OBJETO CONFIGURAÇÕES      
$codigoTipoEndereco = $configuracao->getDadosConfig('codTipoEndCli');
$codEmpresa = $configuracao->getDadosConfig('codEmpresa');
$codFilial = $configuracao->getDadosConfig('codFilial');
$codMetodoVenda = $configuracao->getDadosConfig('codMetodoVenda');
$codTipoEndereco = $configuracao->getDadosConfig('codTipoEndCli');
$responsavel = $configuracao->getDadosConfig('nomeRespCli');
$idStatusEnviadoErp = $configuracao->getDadosConfig('codStatusAoEnviarParaErp');
$idStatusIntegrar = $configuracao->getDadosConfig('nomeStatPedidoEnvErp');


$params = [
    "COD_EMPRESA" => $codEmpresa,
    "COD_FILIAL" => $codFilial,
    "COD_CLI" => 0,
    "Data_Ini" => date('d/m/Y', strtotime('-30 days')),
    "Data_Fim" => date("d/m/Y")
];
//PEDIDOS QUE JÁ EXISTEM NO HORUS PERIODO DE 15 DIAS
$wsHorus = new WSHorus();
$linkConsultarPedidosHorus = $wsHorus->getLinkWSPedido() . '/D_ListaPedidoVenda_Completo';
$consultaPedidosDoHorus = $wsHorus->connectWebService($linkConsultarPedidosHorus, $params);
$dataPedidosDoHorus = isset($consultaPedidosDoHorus['Table'][0]) ? $consultaPedidosDoHorus['Table'] : $consultaPedidosDoHorus;
$pedidosDoHorus = [];
foreach ($dataPedidosDoHorus as $pedidoHS) {

    $metodoPedido = isset($pedidoHS['COD_METODO']) ? $pedidoHS['COD_METODO'] : null;

    if (isset($pedidoHS['COD_PEDIDO_ORIGEM']) && !empty($pedidoHS['COD_PEDIDO_ORIGEM']) && $metodoPedido == $codMetodoVenda) {
        $codigoPedidoOrigem = $pedidoHS['COD_PEDIDO_ORIGEM'];
        $pedidosDoHorus[$codigoPedidoOrigem]['COD_PED_VENDA'] = $pedidoHS['COD_PED_VENDA'];
        $pedidosDoHorus[$codigoPedidoOrigem]['COD_PEDIDO_ORIGEM'] = $pedidoHS['COD_PEDIDO_ORIGEM'];
        $pedidosDoHorus[$codigoPedidoOrigem]['QTD_ITENS'] = $pedidoHS['QTD_ITENS'];
        $pedidosDoHorus[$codigoPedidoOrigem]['STATUS_PEDIDO_VENDA'] = $pedidoHS['STATUS_PEDIDO_VENDA'];
        $pedidosDoHorus[$codigoPedidoOrigem]['VLR_TOTAL_PEDIDO'] = isset($pedidoHS['VLR_TOTAL_PEDIDO']) ? $pedidoHS['VLR_TOTAL_PEDIDO'] : 0;
        $pedidosDoHorus[$codigoPedidoOrigem]['VLR_TOTAL_DESCONTO'] = isset($pedidoHS['VLR_TOTAL_DESCONTO']) ? $pedidoHS['VLR_TOTAL_DESCONTO'] : 0;
        $pedidosDoHorus[$codigoPedidoOrigem]['VLR_TOTAL_LIQUIDO'] = isset($pedidoHS['VLR_TOTAL_LIQUIDO']) ? $pedidoHS['VLR_TOTAL_LIQUIDO'] : 0;
        $pedidosDoHorus[$codigoPedidoOrigem]['VLR_FRETE'] = isset($pedidoHS['VLR_FRETE']) ? $pedidoHS['VLR_FRETE'] : 0;
    }
}


$tipoSincronizacao = "integrador-pedidos";
$infoIntegrador = $configuracao->getInfoIntegrador($tipoSincronizacao);
$configuracao->updateDateIntegrador($tipoSincronizacao, 'Enviar pedidos pedidos para o Horus - WS');
$dataIni = date('d/m/Y', strtotime('-30 days', strtotime($infoIntegrador['data_sicronizacao'])));

$filter = [
    'status_pag' => 'processing',
    "pedido_exportado_erp" => "0"
];

$pedidosCronuz = new PedidosCronuz();
$dataPedidos = $pedidosCronuz->getPedidos($filter);

//var_dump($dataPedidos);
//die;
$woocommerce = new Automattic\WooCommerce\Client(Config::WS_URL_LOJA, Config::WS_KEY_CONSUMER, Config::WS_SECRET_CONSUMER);
$c = 0;
if (!empty($dataPedidos)) {
    foreach ($dataPedidos as $pedidoLoja) {
//        var_dump($pedidoLoja);
//        die;

        if ($c == 5) {
            break;
        }

        $tipoPedido = 'V'; //TIPO DE PEDIDO

        $clienteERP = new ClienteERP();
        $cpfCnpj = $pedidoLoja['cpf'];
        $statusClient = false;

        $idPedidoBD = $pedidoLoja['v_id'];
        $idPedidoLoja = $pedidoLoja['id_pedido_loja'];

        if (isset($pedidosDoHorus[$idPedidoLoja])) {
            echo Sistema::msgDanger("Já existe um pedido com número $idPedidoLoja no Horus");
            $enviarEmail = new EnviarEmail();
            $msg = "Já existe um pedido com número $idPedidoLoja no Horus";
            $assunto = "Já existe pedido no Horus loja - " . Config::ID_LOJA;
            $enviarEmail->Enviar($assunto, $msg, Config::EMAIL_COPY, $destinatariosOculto = []);
        } else {
            if ($pedidoLoja['tipo'] == 'PJ') {//VERIFICA SE O CLIENTE É PESSO FISICA OU JURIDICA
                $cpfCnpj = $pedidoLoja['cnpj'];
            }

            $codCliBD = $pedidoLoja['id_cli']; //CODIGO DO CLIENTE NA BASE DE DADOS
            //VARIÁVEIS PARA O CADASTRO DO CLIENTE
            $codCliERP = $pedidoLoja['id_cliente_erp']; //SE FOR ZERO, ELE IRÁ CADASTRAR E ATUALIZAR O CODIGO DO CLIENTE NO ELSE ABAIXO
            $nomeCli = $pedidoLoja['nome'];
            $nomeReduzido = $pedidoLoja['nome'];
            $email = $pedidoLoja['email'];
            $tipoCliWs = $pedidoLoja['tipo'];
            $cnpj = $pedidoLoja['cnpj'];
            $cpf = $pedidoLoja['cpf'];
            $rg = 'ISENTO';

            //VARIÁVEIS PARA CADASTRADO DO ENDERECO DO CLIENTE    
            $pais = 'BRASIL';
            $uf = $pedidoLoja['uf'];
            $estado = $pedidoLoja['uf'];
            $cidade = $pedidoLoja['cidade'];
            $bairro = $pedidoLoja['bairro'];
            $logradouro = $pedidoLoja['logradouro'] . ',' . $pedidoLoja['numero'];
            $numero = preg_replace("/[^0-9]/", "", $pedidoLoja['numero']);
            $complemento = $pedidoLoja['complemento'];
            $cep = $pedidoLoja['cep'];
            $celular = $pedidoLoja['celular'];
            $statusDefault = 'S';

            //PREPARA DADOS PARA CADASTRO DO CLIENTE
            $clienteERP->prepara($codCliERP, $nomeCli, $nomeReduzido, $email, $tipoCliWs, $cnpj, $cpf, $rg);

            //CRAINDO OBJETO ENDERECO DO CLIENTE
            $clienteEnderecoERP = new EnderecoClienteERP();
            //PREPARA DADOS PARA CADASTRO DO ENDERECO DO CLIENTE
            $clienteEnderecoERP->prepara($codigoTipoEndereco, $codCliERP, $pais, $uf, $estado, $cidade, $nomeReduzido, $bairro, $logradouro, $numero, $complemento, $cep, $celular, $statusDefault);

            //VERIFICA SE O CLIENTE EXISTE
            $verificaCliente = $clienteERP->consultaClientERP($cpfCnpj);
//            var_dump($verificaCliente);
            if ($verificaCliente) {//SE EXISTE O CLIENTE ATUALIZA OS DADOS
                $codCliERP = $verificaCliente['Table']['COD_CLI']; //PEGA O CODIGO DO CLIENTE NO BANCO
                $clienteERP->updateIdClientErpInDB($codCliERP, $codCliBD); //ATUALIZA NO BANCO COM O CODIGO RESGATADO

                $clienteERP->setCodCliERP($codCliERP);
                $clienteERP->insertOrUpdateClienteERP();

                $clienteEnderecoERP->setCodClientERP($codCliERP);
                $clienteEnderecoERP->insertEnderecoWS();

                $statusClient = true;
                echo 'Cliente: ' . $codCliERP . ' Atualizado com sucesso no ERP! <br>';
            } else {

                $insertClient = $clienteERP->insertOrUpdateClienteERP();
                $codCliERP = $insertClient['Table1']['Cliente'];
                $clienteERP->updateIdClientErpInDB($codCliERP, $codCliBD);

                $clienteERP->setCodCliERP($codCliERP); //ATUALIZANDO O CODIGO DO CLIENTE NA CLASS DE CLIENTE ERP
                $clienteEnderecoERP->setCodClientERP($codCliERP); //ATUALIZANDO O CODIGO DO CLIENTE NA CLASS DE ENDERECO

                $clienteERP->insertTipoClientWS(); //INSERINDO O TIPO DE CLIENTE
                $clienteEnderecoERP->insertEnderecoWS();
                $statusClient = true;
//                echo 'Cliente: ' . $codCliERP . ' Cadastrado com sucesso no ERP! <br>';
            }

            //INSERINDO O PEDIDO
            //DEFININDO VARIÁVEIS    
            $pedidoERP = new PedidosERP();
            $codTransportadora = $pedidoLoja['freteMode'];
            $obsPedido = 'Pedido loja virtual ' . $idPedidoLoja;
            $tipoFrete = 1; //1 EMITENTE, 2 DESTINATARIO
            $vlrFrete = str_replace('.', ',', $pedidoLoja['frete']); //TROCANDO O CAMPO DO VALOR / PONTO POR VIRGULA

            $pedidoERP->prepara($responsavel, $idPedidoLoja, $codCliERP, $codTransportadora, $codEmpresa, $codFilial, $obsPedido, $codMetodoVenda, $codTipoEndereco, $tipoFrete, $vlrFrete);

            //TROCANDO A TRANSPORTADORA PARA MODICO SE O FRETE FOR GRATIS ATE 2KG OU PAC SE PASSAR DE 2KG
            if($pedidoERP->getCodTransportadora() == "FREE" && $pedidoLoja['peso'] <= 2000){
                $pedidoERP->setCodTransportadora('MODICO');
            }else{
                $pedidoERP->setCodTransportadora('PAC');
            }
            
            $retornoPedido = $pedidoERP->insertPedidoERP($tipoPedido);
            $idPedidoERP = $retornoPedido['Table']['PEDIDO'];
            
            //ITENS DO PEDIDO
            //INSERINDO OS ITENS NO PEDIDO DO ERP
            $itensPedido = new PedidoBD();
            $itensPedido->getItensPedido($idPedidoBD);
            if ($idPedidoERP) {
                $pedidoERP->insertItensPedidoERP($idPedidoERP, $itensPedido->getDatas());
            }

            if ($tipoPedido == 'V') {
                //INSERINDO A FORMA DE PAGAMENTO
                $qtdParcelas = isset($pedidoLoja['parcelas']) && $pedidoLoja['parcelas'] > 0 ? $pedidoLoja['parcelas'] : 1; //NAO VEM NA API DA FAST A QTD DE PARCELAS REALIZADA NA LOJA
                $pedidoERP->setVlrFrete($pedidoLoja['frete']);
                $pedidoERP->setVlrPedido($pedidoLoja['total']);
                $pedidoERP->setFormaPagto($pedidoLoja['tipoPagto']);
                $pedidoERP->insertPagamentoPedidoERP($idPedidoERP, $qtdParcelas);
            }
            $statusPedidoHorus = !empty($configuracao->getDadosConfig('statusERPaposEnviar')) ? $configuracao->getDadosConfig('statusERPaposEnviar') : 'NOV';
            $pedidoERP->atualizaStatusPedido($idPedidoERP, $statusPedidoHorus);

            //ATUALIZANDO NO BANCO QUE O PEDIDO JÁ FOI INTEGRADO
            $dataUpdate = [
                "cod_pedido_erp" => $idPedidoERP,
                "id_status_prod" => "pedido-enviado-erp",
                "pedido_exportado_erp" => "1"
            ];
            $dataWhere = [
                "id_loja" => Config::ID_LOJA,
                "v_id" => $idPedidoBD
            ];
            $pedidosCronuz->updateTable('l_vendas', $dataUpdate, $dataWhere);

            $dataWC = ['status' => 'enviado-para-erp']; //ATUALIZANDO NO WOOCOMMERCE O STATUS DO PEDIDO PARA ENVIADO PARA O ERP
            $woocommerce->put("orders/{$idPedidoLoja}", $dataWC);
//            var_dump($retorno);
//            die;
//    echo 'Pedido: <strong>' . $idPedidoLoja . '</strong> enviado para o ERP com sucesso! Codigo pedido no ERP ' . $idPedidoERP . ' <br>';

            $c ++;
        }
    }
}


echo Sistema::msgSucess("{$c} pedido(s) inserido(s) no Horus");


$configuracao->updateDateIntegrador('integrador-pedidos', 'Sincronização de pedidos - WebService');

