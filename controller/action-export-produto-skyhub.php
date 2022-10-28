<?php

require '../lib/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet; //classe responsável pela manipulação da planilha
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; //classe que salvará a planilha em .xlsx


$spreadsheet = new Spreadsheet(); //instanciando uma nova planilha
$sheet = $spreadsheet->getActiveSheet(); //retornando a aba ativa
//CABECALHO DAS COLUNAS

$sheet->setCellValue('A1', 'isbn'); //Definindo a célula A1
$sheet->setCellValue('B1', 'quantidade'); //Definindo a célula B1
$sheet->setCellValue('C1', 'preco'); //Definindo a célula C1
$sheet->setCellValue('D1', 'preco_promocional'); //Definindo a célula C1
$sheet->setCellValue('E1', 'editora'); //Definindo a célula D1
$sheet->setCellValue('F1', 'assunto'); //Definindo a célula E1



$status = isset($_GET['status']) ? $_GET['status'] : false;

$validaStatus = [
    "enabled", "disabled", 'noSend', 'all'
];



if ($status && in_array($status, $validaStatus)) {//SE O STATUS É VERDADEIRO E SE TEM NA VALIDACAO O TIPO DE INFORMAÇÃO VALIDA
    $produtos = new ProdutosExcel();
    $produtos->getProductsStatus($status);

    $dataProdutos = $produtos->getDatas();
    


    $c = 2;
    foreach ($dataProdutos as $item) {
        $sheet->setCellValue("A$c", $item['sku']);
        $sheet->setCellValue("B$c", $item['qty']);
        $sheet->setCellValue("C$c", $item['price']);
        $sheet->setCellValue("D$c", $item['promotional_price']);
        $sheet->setCellValue("E$c", $item['brand']);
        $sheet->setCellValue("F$c", $item['assunto']);
        $c++;
    }


    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Relacao-de-Itens-'.$status.'.xlsx"');
    header('Cache-Control: max-age=0');  
    
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    $writer->save('php://output');
    
//    $writer->save('RelacaoDeItensExportada.xlsx'); //salvando a planilha na extensão definida
} else {
    echo 'Status inválido!';
    Rotas::redirecionar(3, Rotas::pagina_ProdutosGestao());
    die;
}
