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
$uploaddir = Rotas::get_UrlFilesSkyhub() . '/produtos/';
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
            'A1:C2000', // The worksheet range that we want to retrieve
            NULL, // Value that should be returned for empty cells
            TRUE, // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
            TRUE, // Should values be formatted (the equivalent of getFormattedValue() for each cell)
            TRUE         // Should the array be indexed by cell row and cell column
    );

    //VARIAVEIAS CONTROLADORAS
    $count = 1;
    $produtoValido = 0;
//    $precoPromoInvalido = 0;
    $ISBNNaoLocalizado = 0;
    $edition = false;
    $query = "";
    $statusSkyhub = $_POST['statusSkyhub'];
    

    foreach ($dataPlanilha as $value) {
        
        if ($count == 1) {//VERIFICAR OS DADOS DA COLUNAS
            if ($value['A'] == 'isbn' && $value['B'] == 'quantidade' && $value['C'] == 'estoque_minimo_skyhub') {
                $edition = true;
                $sheet->setCellValue("A$count", 'ISBN');
                $sheet->setCellValue("B$count", 'STATUS');
                $sheet->setCellValue("C$count", 'DETALHES');
            } else {
                die('Formato da planilha inválido, baixe o modelo e prencha corretamente!');
            }
        }

        if ($count > 1 && $edition == true) {
            $isbn = preg_replace('/[^0-9]/', '', $value['A']);
            //var_dump($isbn, $value['B']);
            
            $estoque = $value['B'] === null ? false : true; //CONDICAO PARA VALIDAR SE O ESTOQUE ESTA ZERADO OU SE ESTA VAZIO (VAZIO ELE IRÁ IGNORAR NA ATUALIZACAO)
            $estqueMinimoSkyhub =  $value['C'] === null ? false : true;
            $idLoja = Config::ID_LOJA;           

            if ($isbn != "") {
                $produtoValido ++;
                $query .= "UPDATE p_produtos SET statusSkyhub = '{$statusSkyhub}'";
                
                if($estoque){//SE A QTD FOR VERDADEIRA SERÁ CONSIDERADO QTD ZERADA
                    $qtd = $value['B'];
                    $query .= ", unidades = {$qtd}, updateSaldoSkyhub = 'S'";
                }
                
                if($estqueMinimoSkyhub){
                    $qtdEstoqueMinimo = $value['C'];
                    $query .= ", estoqueMinimoSkyhub = $qtdEstoqueMinimo, updateSaldoSkyhub = 'S'";
                }
                  
                $query .= " WHERE isbn = '{$isbn}' AND id_loja = {$idLoja};";


                $sheet->setCellValue("A$count", $isbn);
                $sheet->setCellValue("B$count", $statusSkyhub);
                $msgEstoque = "O estoque não sofreu alteração.";
                $msgEstoqueMinimo = "O estoque minimo não sofreu alteração.";
                
                if($estoque){
                    $msgEstoque = "O estoque foi atualizado para $qtd.";
                }
                
                if($estqueMinimoSkyhub){
                    $msgEstoqueMinimo = "O estoque minimo skyhub foi atualizado para $qtdEstoqueMinimo.";
                }
                
                $sheet->setCellValue("C$count", "o ISBN $isbn recebeu o status de $statusSkyhub! {$msgEstoque} $msgEstoqueMinimo");
            }
        }

        $count ++;
    }
    

    //atualiza no banco de dados
    $con = new Conexao();
    $con->executeSQL($query);


    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="DetalhesDaImportacoProdutoSkyhub.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheetSave, "Xlsx");
    $writer->save('php://output');
    

}