<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$smarty = new Template();

//BREADCRUMBS OBRIGATÓRIO NAS PÁGINAS
$PagesBreadCrumbs = [
    "Home" => Rotas::get_SiteHome()
];
$smarty->assign('BREADCRUMBS', $PagesBreadCrumbs);
$page = [
    'link' => Rotas::pagina_ProdutosGestao(),
    'title' => 'Gestão integrador Contenst Stuff'
];
$smarty->assign('PAGE', $page);
//FIM BREADCRUMBS
//LISTAR ARQUIVOS - DIRETORIO ONDE ESTA OS ARQUIVOS DE PEDIDO
$path = Rotas::get_SiteRaiz() . "/filesTesteCS/RemessaLojaTXT/";
$diretorio = dir($path);


//LISTANDO OS ARQUIVOS DA PASTA
while ($arquivo = $diretorio->read()) {//PECORRENDO OS ARQUIVOS DA PASTA
//    var_dump($arquivo);
    if ($arquivo != '.' && $arquivo != '..') {// ELIMINANDO OS .. E O  .
        $lines = file($path . $arquivo); //RESULTADO DAS LINHAS
        $sumTotalItens = 0;
        $itensOrder = [];

        foreach ($lines as $line_num => $line) {//PECORRENDO AS LINHAS
            //echo "Linha #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br>\n";
            $dataLine = $line;
//
//            if ($line_num == 5) {
//                die;
//            }

            //REGRAS
            //Tipo 1 – Header (Deve ser a primeira linha do arquivo)
            //Tipo 2 – Dados do Pedido
            //Tipo 3 – Dados Detalhes dos Pedidos
            //Tipo 5 – Dados Detalhes dos Pedidos – faturamento
            //Tipo 9 – Trailler

            $tipo = substr($line, 0, 1);
            $pedidoCS = new PedidosCS();

            switch ($tipo) {//AVALIAR SE O ARQUIVO JÁ EXISTE NAO CONTINUAR A LEITURA
                case 1:
                    if (!$pedidoCS->fileExist($arquivo)) {//VERIFICA SE O ARQUIVO JÁ ESTA NO BANCO DE DADOS PARA CONTROLE
                        $pedidoCS->header($dataLine, $arquivo); //ENVIANDO INFORMAÇÕES DA LINHA
                    } else {
                        echo Sistema::msgAlert("Arquivo <strong>{$arquivo}</strong> já existe no banco | Line {$line_num}");
                    }
                    break;
                ///----------------------------TRATAMENTO DOS PEDIDOS-----------------------------------------///////////
                case 2: //DADOS DO PEDIDO E TRATAMENTO
                    $idPedidoLoja = intval(substr($line, 1, 8)); //ID DO PEDIDO CONFORME LAYOUT
                    $cpfCnpj = substr($dataLine, 137, 14);
                    $tipo = trim(substr($dataLine, 179, 1));

                    if ($tipo == 'F') {//SE TIPO DE CLIENTE FOR FISICA PEGA OS 11 DIGITOS FINAIS
                        $cpfCnpj = substr($cpfCnpj, -11);
                    }

                    //DADOS DO CLIENTE
                    $dataCliente = [
                        "nome" => trim(substr($dataLine, 17, 50)),
                        "apelido" => trim(substr($dataLine, 17, 10)),
                        "email" => trim(substr($dataLine, 67, 70)),
                        "cpfCnpj" => $cpfCnpj,
                        "password" => $cpfCnpj,
                        "telefone" => Sistema::formataTelefone(trim(substr($dataLine, 153, 2)) . trim(substr($dataLine, 155, 8))),
                        "celular" => Sistema::formataTelefone(trim(substr($dataLine, 169, 2)) . trim(substr($dataLine, 171, 8)))
                    ];

                    $cliente = new Clientes(); //VALIDACAO DO CLIENTE
                    if (!$cliente->clienteExiste($cpfCnpj)) {//SE O CLIENTE NAO EXISTE NO BANCO DE DADOS INSERE
                        $cliente->prepara($dataCliente);
                        if ($cliente->insertCliente()) {
                            echo Sistema::msgSucess("<b>{$dataCliente['nome']} inserido na tabela de clientes</b> | Line {$line_num}");
                        } else {
                            echo Sistema::msgDanger("Erro ao inserir o cliente {$dataCliente['nome']} no banco | Line {$line_num}");
                        }
                    } else {
                        echo Sistema::msgAlert("<b>{$dataCliente['nome']}</b> já existe na tabela de clientes | Line {$line_num}");
                    }

                    //AQUI PEGA O ID DO CLIENTE NO CRONUS
                    $idCliente = $cliente->getIdClientePorCpf($cpfCnpj);

                    //DADOS ENDERECO ENTREGA
                    $dataEntrega = [
                        "logradouro" => trim(substr($dataLine, 189, 50)),
                        "numero" => trim(substr($dataLine, 239, 10)),
                        "complemento" => trim(substr($dataLine, 249, 50)),
                        "bairro" => trim(substr($dataLine, 299, 30)),
                        "cep" => trim(substr($dataLine, 181, 8)),
                        "uf" => trim(substr($dataLine, 359, 2)),
                        "cidade" => trim(substr($dataLine, 329, 30)),
                        "tipoEndereco" => "Entrega"
                    ];

                    $endereco = new EnderecoCliente(); //VALIDANDO ENDERECO PARA INSERIR NO BANCO 
                    if ($endereco->newEndereco('Entrega', $dataEntrega['cep'], $idCliente)) {//SE É PARA CADASTRAR UM NOVO ENDERECO POR NÃO TER OS DADOS NO BANCO
                        $endereco->setIdCliente($idCliente);
                        $endereco->setTipoEndereco("Entrega");
                        $endereco->prepara($dataEntrega);
                        if ($endereco->insertEndereco()) {
                            echo Sistema::msgSucess("Inserido um novo endereço para o cliente <b>{$dataCliente['nome']}</b> | Line {$line_num}");
                        } else {
                            echo Sistema::msgDanger("Erro ao inserir um edereço para o cliente <b>{$dataCliente['nome']}</b> | Line {$line_num}");
                        }
                    } else {
                        echo Sistema::msgAlert("Mantido o mesmo endereço para o cliente <b>{$dataCliente['nome']}</b> | Line {$line_num}");
                    }

                    $idEndereco = $endereco->getIdEndereco("Entrega", $idCliente, $dataEntrega['cep']);

                    //DADOS DO PEDIDO
                    $dataOrder = [
                        "tipoOrder" => Sistema::tipoEnvio(substr($dataLine, 512, 2)), //TRATAR OS TIPOS NA INTEGRACAO 01 NORMAL | 02 REENVIO | 03 | REENVIO PARCIAL (AVALIAR ENVAIR COMO DOACAO USANDO CFOP 5949)
                        "idOrderLoja" => $idPedidoLoja,
                        "dataPedidoLoja" => substr($dataLine, 367, 10),
                        "idCliente" => $idCliente,
                        "idEndereco" => $idEndereco,
                        "vlrTotal" => Sistema::convertStringEmVlr(substr($dataLine, 377, 10)),
                        "vlrFrete" => Sistema::convertStringEmVlr(substr($dataLine, 402, 10)),
                        "tipoFrete" => trim(substr($dataLine, 387, 15)),
                        "formaPagto" => Sistema::tipoPagtoCS(substr($dataLine, 361, 1)),
                        "bandeira" => Sistema::bandeiraPagto(substr($dataLine, 412, 1)),
                        "qtdParcelas" => intval(substr($dataLine, 362, 5))
                    ];

                    //var_dump($dataOrder);
                    //die;


                    if ($idCliente && $idEndereco) {
                        if (!$pedidoCS->pedidoCSExiste($idPedidoLoja)) {
                            //INSERINDO O PEDIDO NO CRONUS
                            $pedidoCronus = new PedidosCronus();
                            $pedidoCronus->prepara($dataOrder);
                            $pedidoCronus->insertPedido();
                        } else {
                            echo Sistema::msgAlert("Pedido {$idPedidoLoja} já existe no banco | Line {$line_num}");
                        }
                    } else {
                        echo Sistema::msgDanger("Necessário informar o ID do cliente ou ID endereco | Line {$line_num}");
                        var_dump($dataCliente);
                    }

                    break;
                ///----------------------------TRATAMENTO DOS ITENS DO PEDIDO-----------------------------------------///////////
                case 3: //DADOS ITENS DO PEDIDO TRATAMENTO

                    $dataItem = [
                        "idOrderLoja" => intval(substr($line, 1, 8)), //ID DO PEDIDO CONFORME LAYOUT
                        "idItemErp" => intval(substr($dataLine, 17, 15)),
                        "qtd" => intval(substr($dataLine, 82, 5)),
                        "vlrItem" => Sistema::convertStringEmVlr(substr($dataLine, 87, 10))
                    ];

                    $sumTotalItens = $sumTotalItens + ($dataItem['qtd'] * $dataItem['vlrItem']); //GUARDANDO O VALOR TOTAL PARA ACHAR O DESCONTO NO FINAL

                    array_push($itensOrder, $dataItem);

                    //var_dump($dataItem);
//                    $itensPedido = new ItensPedidoCronus();
//                    $itensPedido->insertItemOrder($dataItem);

                    break;
                case 5:

                    $idPedidoLoja = intval(substr($line, 1, 8)); //ID DO PEDIDO CONFORME LAYOUT
                    $vlrTotalOrder = $dataOrder['vlrTotal'] - $dataOrder['vlrFrete']; // VALOR TOTAL DOS PRODUTOS, OU SEJA, DESCONSIDERA O FRETE
                    $desconto = (1 - $vlrTotalOrder / $sumTotalItens) * 100; //DESCONTO PARA ATRELAR AO ITEM NO FINAL

                    //var_dump($desconto);

                    foreach ($itensOrder as $item) {

                        $vlrComDesconto = $item['vlrItem'] - ($item['vlrItem'] * ($desconto / 100)); // achando o valor com desconto
                        $item['vlrItem'] = $vlrComDesconto;
                        
                        $itensPedido = new ItensPedidoCronus();
                        $itensPedido->insertItemOrder($item);
                        
                        //var_dump($item);
                        //die;
                    }
                    
                    unset($itensOrder);
                    $itensOrder = [];
                    $sumTotalItens = 0;
                    break;
            }
        }
        
    }
}
$diretorio->close();


die;

//CONFIGURACOES DO FTP
$ftp = new FTPcs(Config::FTP_HOST, Config::FTP_USER, Config::FTP_PASS);


if ($ftp->conect()) {//CONEXAO COM O FTP
    var_dump($ftp);
}









$smarty->display('cs-integrador-pedidos.tpl');
