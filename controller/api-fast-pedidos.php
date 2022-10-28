<?php
//ID STATUS DOS PEDIDOS
/*
 *  1 - NOVO
 *  2 - CANCELADO
 *  3 - EM APROVACAO
 *  4 - PENDENTE
 *  5 - APROVADO
 *  6 - LIBERADO
 *  7 - REMETIDO
 * 
 *  */
//Cartão, Local de entrega
$chamadaAPI = new PedidosAPI();
$addForm = array(//ADICIONANDO O METHODO E FILTROS
    "Method" => "ReportView",
    "ObjectID" => "427", //->OBJETO COM OS PEDIDOS APROVADOS
    "Par1" => '5',//-> STATUS 5 SOMENTE PEDIDOS APROVADOS
    "OutputFormat" => "6", //RETORNO JSON MISERAVE
    "Fields" => "Núm, Nome, E-mail, Tipo, Pagamento, CPF/CNPJ, Logradouro Pedido, Endereço número Pedido, Endereço complemento Pedido, Bairro Pedido, Cidade Pedido, Estado Pedido, CEP Pedido, Total sem frete, Frete, Status, "
    . "Local de entrega, IDProduto, Ref. Produto, Qtd, Preço unit, Desconto cupom", //-> FILTROS OLHAR NA CHAMADA AS OPÇÕES
    //"ChangeFlagAPI" => "0", //-> PEDIDOS COM ALTERACOES
    "Page" => "1", //-> PAGINA
    "QtRecords" => "200" //->QTD ITENS POR PAGINA
);


$chamadaAPI->setForm(mb_convert_encoding($addForm, 'ISO-8859-1', 'UTF-8'));
$chamadaAPI->actionPedidosAPI();
$pedidosAPI = $chamadaAPI->getPedidosAPI();


//CRIANDO PEDIDO NA BD DO CRONUS
foreach ($pedidosAPI as $pedidoAPI) {//ENTRANDO NO FOREACH PARA INSERIR O PEDIDO
//    var_dump($pedidoAPI);
//    die;
    $clienteLoja = new Clientes();
    
    //DADOS CLIENTES NA API PARA VALIDACAO DO CADASTRO
    $idCliente = NULL;
    $idEndereco = NULL;
    $nome = $pedidoAPI['nomeCli'];
    $apelido = explode(" ", $pedidoAPI['nomeCli']);
    $email = $pedidoAPI['email'];
    $cpfCnpj = $pedidoAPI['cpfCnpj'];
    
    //DADOS DO ENDEREÇO DE ENTREGA NA API
    $logradouro = $pedidoAPI['logradouro'];
    $numero = $pedidoAPI['numero']; 
    $complemento = $pedidoAPI['complemento'];
    $bairro = $pedidoAPI['bairro'];
    $cep = $pedidoAPI['cep'];
    $uf = $pedidoAPI['uf']; //PRIMEIRO A UF
    $cidade = $pedidoAPI['cidade']; //DEPOIS O MUNICIPIO PARA SETAR O ID -> SE NAO TIVER O MUNICIPIO IRÁ INSERIR UM NOVO NA BD
    $tipoEndereco = 'Principal';
    
    //CRIANDO O OBJETO ENDERECO
    $enderecoLoja = new EnderecoCliente();    

    //INICIO VERIFICACAO DADOS CLIENTE NO BANCO 
    if($clienteLoja->clienteExiste($cpfCnpj)){//SE CLIENTE EXISTE PEGA O ID DO CLIENTE
        
        $idCliente = $clienteLoja->getIdClientePorCpf($cpfCnpj);
        $enderecoLoja->setIdCliente($idCliente); //SETANDO O ID DO CLIENTE
        
        if($enderecoLoja->enderecoExiste($idCliente, $tipoEndereco)){//SE ENDERECO EXISTE
            //VERIFICA ENDERECO E ATUALIZA 
            $idEndereco = $enderecoLoja->getIdEndereco($tipoEndereco, $idCliente);
            $enderecoLoja->prepara($logradouro, $numero, $complemento, $bairro, $cep, $uf, $cidade, $tipoEndereco);
            $enderecoLoja->updateEndereco($idEndereco);
            
        }else{//SE NAO CADASTRA UM ENDERECO
            $enderecoLoja->prepara($logradouro, $numero, $complemento, $bairro, $cep, $uf, $cidade, $tipoEndereco);
            $enderecoLoja->insertEndereco();
            $idEndereco = $enderecoLoja->getIdEndereco($tipoEndereco, $idCliente);
        }
        
    }else{//SE NAO CADASTRA UM NOVO CLIENTE E PEGA O ID CADASTRADO
        $clienteLoja->prepara($nome, $apelido[0], $email, $cpfCnpj);
        $clienteLoja->insertCliente();
        $idCliente = $clienteLoja->getIdClientePorCpf($cpfCnpj);
        
        //CADASTRANDO O ENDERECO
        $enderecoLoja->setIdCliente($idCliente); //SETANDO O ID DO CLIENTE
        $enderecoLoja->prepara($logradouro, $numero, $complemento, $bairro, $cep, $uf, $cidade, $tipoEndereco);
        $enderecoLoja->insertEndereco();
        $idEndereco = $enderecoLoja->getIdEndereco($tipoEndereco, $idCliente);
    }
    //FIM VERIFICACAO DADOS CLIENTE NA BD
    
    //INICIO INSERCAO DO PEDIDO NA BD CRONUS
    $pedidoLoja = new PedidosLoja();
    
    $idPedidoLoja = $pedidoAPI['idPedLoja']; // SETANDO O ID DO PEDIDO NA LOJA 
    
    if($pedidoLoja->existePedidoNaBD($idPedidoLoja)){//POR SEGURANÇA SE EXISTE O PEDIDO APENAS ALERTA NA CRON
        echo 'Já existe um pedido na Base de dados com o numero: <strong style="color: green">'. $idPedidoLoja . '</strong>. Nenhuma ação realizadar para o mesmo.<br>';
    }else{//INSERINDO OS PEDIDOS APROVADOS NA BASE DE DADOS
        $pedidoLoja->setIdPedidoLoja($idPedidoLoja);
        $pedidoLoja->setTotalComFrete($pedidoAPI['total'] + $pedidoAPI['frete']);
        $pedidoLoja->setFreteVlr($pedidoAPI['frete']);
        $pedidoLoja->setPrazo("5");
        $pedidoLoja->setIdCliente($idCliente);
        $pedidoLoja->setFreteTipo($pedidoAPI['tipoFrete']);
        $pedidoLoja->setItensPedido($pedidoAPI['itens']);
        $pedidoLoja->setTipoPagto($pedidoAPI['pagamento']);
        $pedidoLoja->setIdStatusProd($pedidoAPI['status']);
        $pedidoLoja->setVlrCupomDesconto($pedidoAPI['vlrCupom']);
        $pedidoLoja->newPedido();
        $pedidoLoja->updateIdEnderecoPedido($pedidoLoja->getIdPedido($idPedidoLoja), $idEndereco);
        
    }
    
    
    
        
}








