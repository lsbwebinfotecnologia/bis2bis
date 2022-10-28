<?php
if(!isset($_GET['front'])){
	require '../lib/autoload.php';
}

$wsHorus = new WSHorus();
$configuracao = new Configuracoes();

$linkEstoque = $wsHorus->getLinkWSProduto().'/V_MostraSaldoItensGeral'; //OLHAR DOCUMENTACAO DO LINKS DO ERP
$dateBD = $configuracao->getInfoIntegrador('integrador-estoque');


$paramsEstoque = array (
    "Cod_Empresa"=> $configuracao->getDadosConfig('codEmpresa'),
    "Cod_Filial"=> $configuracao->getDadosConfig('codFilial'),
    "Cod_Item" => "",
    "Data_Ini"=> date("d/m/Y", strtotime("-1000 days", strtotime(str_replace("-", "/", substr($dateBD['data_sicronizacao'], 0, -9))))), //SUBTRAINDO 5 ANOS PARA BUSCA
    "Data_Fim"=> date('d/m/Y', strtotime('+2 days'))
);
//var_dump($paramsEstoque);

//DEFININDO ALGUMAS VARIÁVEIS
$tipoDeSaldo = $configuracao->getDadosConfig("estoqueEm"); //PERCENTUAL OU QUANTIDADE -> CONFIGURADO NO PAINEL DO ADM
$estoqueMinimo = $configuracao->getDadosConfig("percentualEstoqueDisponivel"); //VALOR MINIMO DISPONIVEL PODE SER PERCENTUAL OU QUANTIDADE

//FAZENDO A CHAMADA DO WS
$estoquesWS = $wsHorus->connectWebService($linkEstoque, $paramsEstoque);

//echo '<pre>';
//print_r($estoquesWS);
////die;


if($estoquesWS){//SE VEIO INFORMACAO DO WS
    
    $estoque = new Estoque();
    $estoquesBD = $estoque->getSaldoItens();
    
    $dataEstoqueWS = isset($estoquesWS['Table'][0]) ? $estoquesWS['Table'] : $estoquesWS;
    
 
    
    foreach ($dataEstoqueWS as $estoqueWS) {
        //DEFININDO ALGUMAS VARIAVES VINDA DO WS
        $idProdutoWs = $estoqueWS['COD_ITEM'];
        $dataAtualizacaoWS = $estoqueWS['DAT_ULT_ATL'];
        $saldoVendavelWS = $estoqueWS['SALDO_VENDAVEL'];
        $saldoReservadolWS = $estoqueWS['SALDO_RESERVADO_VENDA'];
        
        $saldoWS = ($saldoVendavelWS + $estoqueWS['SALDO_ARMAZENAGEM']) - $saldoReservadolWS; // SUBTRAINDO O VENDAVEL - AS RESERVAS DO WS
        
        $estoque->setIdProdutoWs($idProdutoWs);
        $estoque->setDataAtualizacao($dataAtualizacaoWS);
        
        if(isset($estoquesBD[$idProdutoWs])){//SE ECONTROU O PRODUTO DO BD NO WS
            //DEFININDO VARIAVEL DATA ATUALIZACAO DO BD
            $dataAtualizacaoBD = $estoquesBD[$idProdutoWs]['dat_ult_atl_saldo'];            
            $unidades = 0;
            
            if($dataAtualizacaoBD != $dataAtualizacaoWS){//SE A DATA FOR DIFERENTE ATUALIZA                
                if($tipoDeSaldo == 'percentual'){
                    //CALCULANDO ESTQOUE EM PERCENTUAL
                    $unidades = intval(($estoqueMinimo / 100) * $saldoWS);
                }elseif ($tipoDeSaldo == 'quantidade') {
                    //CALCULANDO ESTOQUE EM QUANTIDADE
                    if($saldoWS >= $estoqueMinimo){
                        $unidades = $saldoWS - ($estoqueMinimo - 1);
                    }
                }                
                $estoque->setUnidades($unidades);// EXECUTANDO A ATAULIZACAO DO ESTOQUE NO BD
                $estoque->updateSaldoItem();
                echo 'Estoque do produto <strong>' . $idProdutoWs . '</strong> atualizado para <em style="color: red">' . $unidades . '</em><br>';
            }
            
        }
        
        

    }
    $configuracao->updateDateIntegrador('integrador-estoque');
    
}

//Rotas::redirecionar(5, Rotas::pagina_Integradores());





