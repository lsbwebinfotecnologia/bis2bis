<?php

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
$idStatusEnviarParaErp = $configuracao->getDadosConfig('nomeStatPedidoSincronizacaoERP'); //id do status dos pedidos que serão enviados para o ERP

$pedidoSincronizar = new PedidosSkyhub();
$pedidoSincronizar->getPedidos($idStatusEnviarParaErp);

$dadosPedidos = $pedidoSincronizar->getDatas();

//$municipio = new Municipios();
//$estado = new Estados();
//echo '<pre>';
//var_dump($dadosPedidos);
//die;

foreach ($dadosPedidos as $pedido) {
    $municipio = new Municipios();
    $estado = new Estados();

    $clienteERP = new ClienteERP();
    $cpfCnpj = $pedido['dadosCliente']['cpf'];
    $statusClient = false;

    $idPedidoBD = $pedido['v_id'];
    $idPedidoOrigem = $pedido['id_ped_skyhub'];

    if ($pedido['dadosCliente']['tipo'] == 'PJ') {//VERIFICA SE O CLIENTE É PESSO FISICA OU JURIDICA
        $cpfCnpj = $pedido['dadosCliente']['cnpj'];
    }

    $codCliBD = $pedido['dadosCliente']['id_cli']; //CODIGO DO CLIENTE NA BASE DE DADOS
    //VARIÁVEIS PARA O CADASTRO DO CLIENTE
    $codCliERP = $pedido['dadosCliente']['id_cliente_erp']; //SE FOR ZERO, ELE IRÁ CADASTRAR E ATUALIZAR O CODIGO DO CLIENTE NO ELSE ABAIXO
    $nomeCli = $pedido['dadosCliente']['nome'];
    $nomeReduzido = $pedido['dadosCliente']['nome'];
    $email = $pedido['dadosCliente']['email'];
    $tipoCliWs = $pedido['dadosCliente']['tipo'];
    $cnpj = $pedido['dadosCliente']['cnpj'];
    $cpf = $pedido['dadosCliente']['cpf'];
    $rg = 'ISENTO';

    //VARIÁVEIS PARA CADASTRADO DO ENDERECO DO CLIENTE    
    $pais = 'BRASIL';
    $dadosEstado = $estado->getEstado($pedido['dadosEndereco']['estado']);
    $dadosMunicipio = $municipio->getCidade($pedido['dadosEndereco']['cidade']);
    $uf = $dadosEstado['uf'];
    $nomeEstado = $dadosEstado['nome'];
    $cidade = $dadosMunicipio['nome'];
    $bairro = $pedido['dadosEndereco']['bairro'];
    $logradouro = $pedido['dadosEndereco']['logradouro'];
    $numero = $pedido['dadosEndereco']['numero'];
    $complemento = $pedido['dadosEndereco']['complemento'];
    $cep = $pedido['dadosEndereco']['cep'];
    $celular = $pedido['dadosEndereco']['telefone'];
    $statusDefault = 'S';

    //PREPARA DADOS PARA CADASTRO DO CLIENTE
    $clienteERP->prepara($codCliERP, $nomeCli, $nomeReduzido, $email, $tipoCliWs, $cnpj, $cpf, $rg);



    //CRAINDO OBJETO ENDERECO DO CLIENTE
    $clienteEnderecoERP = new EnderecoClienteERP();
    //PREPARA DADOS PARA CADASTRO DO ENDERECO DO CLIENTE
    $clienteEnderecoERP->prepara($codigoTipoEndereco, $codCliERP, $pais, $uf, $nomeEstado, $cidade, $nomeReduzido, $bairro, $logradouro, $numero, $complemento, $cep, $celular, $statusDefault);


    //VERIFICA SE O CLIENTE EXISTE
    $verificaCliente = $clienteERP->consultaClientERP($cpfCnpj);
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
        echo 'Cliente: ' . $codCliERP . ' Cadastrado com sucesso no ERP! <br>';
    }

    //INSERINDO O PEDIDO
    //DEFININDO VARIÁVEIS    
    $pedidoERP = new PedidosERP();
    $codTransportadora = $pedido['typeCalculationFreteSkyhub'];
    $obsPedido = "Pedido Marketplace {$pedido['id_ped_skyhub']}";
    $tipoFrete = 1; //1 EMITENTE, 2 DESTINATARIO
    $vlrFrete = str_replace('.', ',', $pedido['frete']); //TROCANDO O CAMPO DO VALOR / PONTO POR VIRGULA

    $pedidoERP->prepara($responsavel, $idPedidoOrigem, $codCliERP, $codTransportadora, $codEmpresa, $codFilial, $obsPedido, $codMetodoVenda, $codTipoEndereco, $tipoFrete, $vlrFrete);



    $retornoPedido = $pedidoERP->insertPedidoERP();
    $idPedidoERP = $retornoPedido['Table']['PEDIDO'];

    //ITENS DO PEDIDO
    //INSERINDO OS ITENS NO PEDIDO DO ERP
    $itensPedido = new PedidosItensSkyhub();
    $itensPedido->getItensPedidoSkyhub($idPedidoBD);
    $dadosItensPedido = $itensPedido->getDatas();
//    var_dump($idPedidoBD, $dadosItensPedido);
//    die;

    $pedidoERP->insertItensPedidoERP($idPedidoERP, $dadosItensPedido);


    //INSERINDO A FORMA DE PAGAMENTO
    $qtdParcelas = 1; //NAO VEM NA API DA FAST A QTD DE PARCELAS REALIZADA NA LOJA
    $pedidoERP->setVlrFrete($pedido['frete']);
    $pedidoERP->setVlrPedido($pedido['total']);
    $pedidoERP->setFormaPagto($pedido['tipoPagto']);
    $pedidoERP->insertPagamentoPedidoERP($idPedidoERP, $qtdParcelas);


    //ATUALIZANDO NO BANCO QUE O PEDIDO JÁ FOI INTEGRADO
    $pedidoSincronizar->updateIdPedidoErp($idPedidoBD, $idPedidoERP, $idStatusEnviadoErp);
    echo 'Pedido: <strong>' . $idPedidoOrigem . '</strong> enviado para o ERP com sucesso! Codigo pedido no ERP ' . $idPedidoERP . ' <br>';
}


