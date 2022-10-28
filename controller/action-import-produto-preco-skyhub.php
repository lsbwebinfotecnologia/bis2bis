<?php

require '../lib/autoload.php';

//    $inputFileType = 'Xlsx';
//    $inputFileType = 'Xml';
//    $inputFileType = 'Ods';
//    $inputFileType = 'Slk';
//    $inputFileType = 'Gnumeric';
//    $inputFileType = 'Csv';
//MODELO DA PLANILHA É APENAS 3 COLUNAS ISBN, CUSTO, PRECO CHEIO E PRECO PROMOCIONAL
/** Create a new Spreadsheet Object * */
//DIRETORIO QUE SALVOU A PLANILHA COM OS DADOS
$uploaddir = Rotas::get_UrlFilesSkyhub() . '/produtos-preco/';
$inputFileName = $uploaddir . date('Y-m-d') . '.xlsx';

//CRIANDO A PLANILHA DE LOGS SUCESSO OU ERRO NA MANIPULACAO
/** Create a new Spreadsheet Object * */
$spreadsheetSave = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheetSave->getActiveSheet(); //retornando a aba ativa


if (move_uploaded_file($_FILES['file']['tmp_name'], $inputFileName)) {//COPIA A PLANILHA PARA A PASTA DO CRONUS E DEIXA UMA COPIA
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($inputFileName);

    $dataPlanilha = $spreadsheet->getActiveSheet() //LIMITANDO OS DADOS DE ACESSO DA PLANILHA
            ->rangeToArray(
            'A1:D1000', // The worksheet range that we want to retrieve
            NULL, // Value that should be returned for empty cells
            TRUE, // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
            TRUE, // Should values be formatted (the equivalent of getFormattedValue() for each cell)
            TRUE         // Should the array be indexed by cell row and cell column
    );

    //VARIAVEIAS CONTROLADORAS
    $count = 1;
    $precoValido = 0;
    $precoPromoInvalido = 0;
    $ISBNNaoLocalizado = 0;
    $edition = false;
    $query = "";


    foreach ($dataPlanilha as $value) {

        if ($count == 1) {//VERIFICAR OS DADOS DA COLUNAS
            if ($value['A'] == 'isbn' && $value['B'] == 'custo' && $value['C'] == 'preco_cheio' && $value['D'] == 'preco_promo') {
                $edition = true;
                $sheet->setCellValue("A$count", 'ISBN');
                $sheet->setCellValue("B$count", 'STATUS');
                $sheet->setCellValue("C$count", 'DETALHES');
            } else {
                die('Formato da planilha inválido, baixe o modelo e prencha corretamente!');
            }
        }

        if ($count > 1 && $edition == true) {
            $isbn = $value['A'];
            $custo = (float) $value['B'];
            $precoCheio = (float) $value['C'];
            $precoPromo = (float) $value['D'];
            $idLoja = Config::ID_LOJA;


            if ($isbn != "" && $precoPromo < $precoCheio) {//SE O PRECO PROMOCIONAL FOR MENOR QUE O PRECO CHEIO
                $precoValido ++;
                $query .= "
                    UPDATE p_produtos 
                    SET priceSkyhub = {$precoCheio}, 
                        promotionalPriceSkyhub = {$precoPromo}, 
                        custoAtual = {$custo},
                        updatePriceSkyhub = 'S'    
                    WHERE isbn = '{$isbn}' 
                    AND id_loja = {$idLoja};";

                $sheet->setCellValue("A$count", $isbn);
                $sheet->setCellValue("B$count", "SUCESSO");
                $sheet->setCellValue("C$count", "o ISBN $isbn recebeu o preco de cheio de R$ $precoCheio, preco promocional de R$ $precoPromo e custo de $custo");
            } elseif($isbn != "" && $precoCheio < $precoPromo) {//SE O PRECO PROMO FOR MAIOR QUE O PRECO CHEIO
                $precoPromoInvalido ++;
                $sheet->setCellValue("A$count", $isbn);
                $sheet->setCellValue("B$count", "ERROR");
                $sheet->setCellValue("C$count", "o ISBN $isbn não pode ter o preço promocional (R$ $precoPromo) maior que o preco cheio (R$ $precoCheio)");
            }
        }

        $count ++;
    }

    //atualiza no banco de dados
    $con = new Conexao();
    $con->executeSQL($query);
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="DetalhesDaImportacaoDePrecosSkyhub.xlsx"');
    header('Cache-Control: max-age=0');  
    
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheetSave, "Xlsx");
    $writer->save('php://output');

    

    echo "Total de $precoValido produtos com o(s) preço(s) válido(s) <br>";
    echo "Total de $precoPromoInvalido produtos com o(s) preço(s) inválido(s) <br>";
}