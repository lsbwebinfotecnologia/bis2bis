<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//CONECTANDO NO FTP E ENVIANDO O ARQUIVO
$ftp = new FTPcs(Config::FTP_HOST, Config::FTP_USER, Config::FTP_PASS);

//ESSE ARQUIVO PEGA DIRETO DO HORUS AS INFORMAÇÕES DE ESTOQUE E GERA UM TXT PARA A CS QUE É ENVIADO VIA FTP
$configuracao = new Configuracoes();

//DADOS EMPRESA E FILIAL
$codEmpresa = $configuracao->getDadosConfig('codEmpresa');
$codFilial = $configuracao->getDadosConfig('codFilial');

$estoqueHorus = new EstoqueHorus($codEmpresa, $codFilial); //OBJETO DO ESTOQUE DO HORUS
$estoque = new Estoque(); //OBJETO DOS ITENS DO BANCO
$estoquesBD = $estoque->getSaldoItens(); // RELACAO DOS ITENS DA LOJA
//Saldo local de estoque do Horus
$estoquesWS = $estoqueHorus->getSaldoPorLocal(3);
$dataEstoqueWS = isset($estoquesWS['Table'][0]) ? $estoquesWS['Table'] : $estoquesWS;


$itensSaldoHorus = []; // ARRAY PARA GUARDAR DADOS DO ESTOQUE
foreach ($dataEstoqueWS as $itemWS) {//TRATANDO AS INFORMAÇÕES DO HORUS
    $itensSaldoHorus[$itemWS['COD_ITEM']]['COD_ITEM'] = $itemWS['COD_ITEM'];
    $itensSaldoHorus[$itemWS['COD_ITEM']]['SALDO_TOTAL'] = $itemWS['SALDO_TOTAL'];
}


$caracter = [":", " ", "-", ".", "(", ")"];
$nameFile = str_replace($caracter, "", date('Y-m-d h:i:s')) . '.txt'; //GUARDANDO NOME DO ARQUIVO

$c = 0;
foreach ($estoquesBD as $item) {//CRIANDO O ARQUIVO TXT
    $codigoItem = $item['idHorus'];
    $titulo = $item['titulo'];
    $qtd = 0;

    if (isset($itensSaldoHorus[$codigoItem])) {
        $qtd = intval($itensSaldoHorus[$codigoItem]['SALDO_TOTAL']);
    }

    $line = $codigoItem . ";" . $titulo . ";" . $qtd . "\n";

    //echo htmlspecialchars($line) . "<br>";

    if ($c == 0) {
        file_put_contents($nameFile, $line); // Resultado: 26
    } else {
        file_put_contents($nameFile, $line, FILE_APPEND);
    }

    $c ++;
}
//echo htmlspecialchars("9" . $c) . "<br>";
file_put_contents($nameFile, "9" . $c, FILE_APPEND);

$fileOrigem = Rotas::get_SiteRaiz() . '/' . $nameFile;
$fileDestino = Rotas::get_DirFileEstoque() . '/' . $nameFile;

if (!copy($fileOrigem, $fileDestino)) {//SE NAO COPIOU O ARQUIVO NA PASTA FILE
    echo Sistema::msgDanger('Erro ao copiar o arquivo!');
    //unlink($fileOrigem);
} else {
    //DIRETORIO ONDE SERA SALVO OS ARQUIVOS NO FTP
    $fileDestinoFTP = "/RetornoEstoque/" . $nameFile;
    if ($ftp->conect()) {

        if ($ftp->uploadFile($fileOrigem, $fileDestinoFTP)) {//se copiou com sucesso
            echo Sistema::msgSucess('Arquivo copiado e enviado para o FTP com sucesso!');
            unlink($fileOrigem);
        }else{
            echo Sistema::msgDanger('Erro ao copiar o arquivo para o FTP');
        }
    } else {
        echo Sistema::msgDanger('Erro ao conectar no FTP!');
    }
}



//var_dump($fileOrigem, $fileDestino);
