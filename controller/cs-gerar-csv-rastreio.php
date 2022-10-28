<?php

use League\Csv\Writer;
use League\Csv\CannotInsertRecord;

$orderRastreio = new RastreioPedidos();
$orderRastreio->getPedidosEnvioRastreio();


$dataOrders = $orderRastreio->getDatas();

$header = ['EMPRESA', 'ENVIO_ID', 'ID_PEDIDO', 'ETIQUETA', 'DATA'];
$records = [];

$c = 1;
foreach ($dataOrders as $order) {//LISTA DE PEDIDOS QUE TEM RASTREIO PARA CONSULTAR NOS CORREIOS E AVALIAR POSTAGEM
    $empresa = 126;
    $rastreio = $order['codigo_rastreio']; // CODIGO DE RASTREIO GERARO PELO HORUS
    $envioID = $order['id_pedido_loja'];
    $idPedido = 0;

    $consulta = new \Cagartner\CorreiosConsulta\CorreiosConsulta(); // CRIANDO O OBJETO PARA CONSULTA
    $dataConsulta = $consulta->rastrear($rastreio); //DADOS DA CONSULTA

    if ($dataConsulta) {//SE TIVER RESULTADO NA CONSULTA
        foreach ($dataConsulta as $data) {//TRATANDO DADOS DA CONSULTA NOS CORREIOS
            if ($data['status'] == 'Objeto postado') {//SE O OBJETO FOI POSTADO
                $datePostagem = substr($data['data'], 0, 10);
                array_push($records, [$empresa, $envioID, $idPedido, $rastreio, $datePostagem]);
                break;
            }
        }
    }

    $c ++;
}


if(!$records){
    echo Sistema::msgAlert('Nenhum rastreio para ser enviado!');
    die;
}


try {//GERANDO O ARQUIVO E ENVIANDO VIA FTP, REALIZANDO TBM A ATULIZAÇÃO NO BANCO QUE OS PEDIDOS COM RASTREIOS IDENTIFICADOS FORAM 

    $caracter = [":", " ", "-", ".", "(", ")"];
    $nameFile = "RetornoObjeto-".str_replace($caracter, "", date('Y-m-d h:i:s')) . '.csv'; //GUARDANDO NOME DO ARQUIVO

    $writer = Writer::createFromPath(Rotas::get_SiteRaiz() . '/'.$nameFile, 'w+');
    $writer->setDelimiter(';');
    $writer->insertOne($header);
    $writer->insertAll($records); //using an array
    $writer->insertAll(new ArrayIterator($records)); //using a Traversable object

    foreach ($records as $value) {
        $evento = new EventosCronus();
        $dataSet = [
            "notificadoRastreio" => '1'
        ];
        $dataWhere = [
            "id_loja" => Config::ID_LOJA,
            "id_pedido_loja" => $value[1]
        ];
        $evento->updateTable('l_vendas', $dataSet, $dataWhere);
    }

    //CONECTANDO NO FTP E ENVIANDO O ARQUIVO
    $ftp = new FTPcs(Config::FTP_HOST, Config::FTP_USER, Config::FTP_PASS);

    $fileOrigem = Rotas::get_SiteRaiz() . '/' . $nameFile;
    $fileDestino = Rotas::get_DirFilePostagem() . '/' . $nameFile;

    if (!copy($fileOrigem, $fileDestino)) {//SE NAO COPIOU O ARQUIVO NA PASTA FILE
        echo Sistema::msgDanger('Erro ao copiar o arquivo!');
        //unlink($fileOrigem);
    } else {
        //DIRETORIO ONDE SERA SALVO OS ARQUIVOS NO FTP
        $fileDestinoFTP = "/Postagem/" . $nameFile;
        if ($ftp->conect()) {

            if ($ftp->uploadFile($fileOrigem, $fileDestinoFTP)) {//se copiou com sucesso
                echo Sistema::msgSucess('Arquivo copiado e enviado para o FTP com sucesso!');
                unlink($fileOrigem);
            } else {
                echo Sistema::msgDanger('Erro ao copiar o arquivo para o FTP');
            }
        } else {
            echo Sistema::msgDanger('Erro ao conectar no FTP!');
        }
    }
} catch (CannotInsertRecord $e) {
    $e->getRecords(); //returns [1, 2, 3]
}

