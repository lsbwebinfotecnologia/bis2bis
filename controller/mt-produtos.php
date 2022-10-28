<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

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


//var_dump(phpinfo());
//die;
/**
 * Magento REST API v2 - Category Tree
 * The users and roles should be created under System -> Webservices -> REST ...
 * @author Ricardo Martins - www.magenteiro.com/backend
 * @link http://www.magentocommerce.com/api/soap/catalog/catalogCategory/catalog_category.tree.html
 *
 *
 * Some performance hints
 * - Enable zlib.output_compression on .htaccess
 * - Enable APC and configure it in magento config.xml
 * - Optimize my.cnf (see http://www.magentocommerce.com/boards/viewthread/36225/) 
 * */
### CONFIG AREA ###
ini_set("soap.wsdl_cache_enabled", 0);  //desabilita cache do wsdl do php - recomendavel qdo houver alteracao no wsdl

$path = 'https://editoraculturacrista.bisws.com.br'; //api/v2_soap/?wsdl=1
$apiUser = 'lsbwebinfo';
$apiKey = 'mudar@123';
$produtoBis2Bis = new ProdutoBis2Bis($apiKey, $apiUser, $path);
$adapter = new \Smalot\Magento\RemoteAdapter($path, $apiUser, $apiKey);
//var_dump($adapter);
//die;

$dadosAdmin = new DadosAdmin();
$dadosDePara = $dadosAdmin->getDadosDeParaGerais();

$configuracao = new Configuracoes();
$tipoSincronizacao = "mt-produtos";
$infoIntegrador = $configuracao->getInfoIntegrador($tipoSincronizacao);

if (isset($infoIntegrador['data_sicronizacao'])) {
    $dataIni = date('d/m/Y', strtotime($infoIntegrador['data_sicronizacao']));
} else {
    $configuracao->updateDateIntegrador($tipoSincronizacao, 'Sincronização de produtos - Magento');
}

$dadosConfig = $configuracao->getTodosDadosConfig();
$atualizarCategorias = isset($dadosConfig['atualizarCategoriaMagento']) ? $dadosConfig['atualizarCategoriaMagento'] : false;
$atualizarImagem = isset($dadosConfig['atualizarImagemMagento']) ? $dadosConfig['atualizarImagemMagento'] : false;


//INSERINDO MARCAS NO MAGENTO QUE NÃO FORAM INSERIDIAS AINDA
$produtoEditora = new ProdutoEditora();
$filterEditora = [
    "integrado" => "N"
];
$dataEditoras = $produtoEditora->getEditoras($filterEditora);
$queryMarca = "";
$paramsMarca = [];
$m = 0;
if (!empty($dataEditoras)) {
    foreach ($dataEditoras as $edt) {
        if ($m == 25) {
            break;
        }
        $paramsOption = [
            "nome" => $edt['nome'],
            "attributeId" => 129 //Id do atributo marca no cliente
        ];
        $retorno = $produtoBis2Bis->insertOptionAttr($paramsOption);
        if (isset($retorno->result)) {
            $dataSet2 = [
                "integrado" => "S",
                "idLojaIntegrada" => $retorno->result,
            ];
            $dataWhere2 = [
                "id_loja" => Config::ID_LOJA,
                "id_editora" => $edt['idEditora']
            ];
            $comand2 = $produtoEditora->gerarQueryUpdateSQL("p_editoras", $dataSet2, $dataWhere2);
            foreach ($comand2["params"] as $k2 => $cmd2) {
                $paramsMarca[$k2] = $cmd2;
            }
            $queryMarca .= $comand2["query"];
            $m ++;
        }
    }
}
if (!empty($queryMarca)) {
    $produtoEditora->executeSQL($queryMarca, $paramsMarca);
}
echo Sistema::msgSucess("{$m} marcas(s) inseridas no Magento!");
die;

//VALIDANDO AS CATEGORIAS
//$categoryManager = new \Smalot\Magento\Catalog\Category($adapter);
//$listCategory = $categoryManager->getTree()->execute();
//$categoriasMagento = isset($listCategory['children'][0]['children']) ? $listCategory['children'][0]['children'] : false;
//$dataCategoriaMagento = [];
//if ($categoriasMagento) {//MONTANDO LISTA DE CATEGORIAS PARA FAZER O DE/PARA COM O HORUS
//    foreach ($categoriasMagento as $cat) {
//        if ($cat['name'] == 'Livros') {//fixando
//            $listCategoryChildren = $cat['children'];
//            $dataCategoriaMagento['Livros']["category_id"] = $cat['category_id'];
//            foreach ($listCategoryChildren as $children) {
//                $dataCategoriaMagento['Livros'][$children['name']] = $children['category_id'];
//            }
//        }
//        if ($cat['name'] == 'Papelaria') {//fixando
//            $listCategoryChildren = $cat['children'];
//            $dataCategoriaMagento['Papelaria']["category_id"] = $cat['category_id'];
//            foreach ($listCategoryChildren as $children) {
//                $dataCategoriaMagento['Papelaria'][$children['name']] = $children['category_id'];
//            }
//        }
//        if ($cat['name'] == 'Jogos e Brinquedos') {//fixando
//            $listCategoryChildren = $cat['children'];
//            $dataCategoriaMagento['Jogos e Brinquedos']["category_id"] = $cat['category_id'];
//            foreach ($listCategoryChildren as $children) {
//                $dataCategoriaMagento['Jogos e Brinquedos'][$children['name']] = $children['category_id'];
//            }
//        }
//    }
//}

//var_dump($dataCategoriaMagento);
// Call any module's class
$produtuctManager = new \Smalot\Magento\Catalog\Product($adapter);


//INICIO PRODUTOS QUE SERÃO INSERIDOS
//$filter = [//FILTRO DE PRODUTSO QUE SERAO ATUALIZADOS
//    "integrado" => "N",
//];
//
//if (isset($_GET['COD_ITEM'])) {
//    $filter = ["COD_ITEM" => $_GET['COD_ITEM']];
//}
//
//$produtosCronuz = new ProdutoDados();
//$dataProdutos = $produtosCronuz->getDadosProdutos($filter);
////var_dump($dataProdutos);
////die;
//$c = 0;
//$cimg = 0;
//$limit = 1; //Config::BD_LIMIT_POR_PAG;
//if (isset($_GET['limit'])) {
//    $limit = $_GET['limit'];
//}
//if (!empty($dataProdutos)) {
//    foreach ($dataProdutos as $productData) {
////        echo '<pre>';
////        print_r($productData);
////        echo '</pre>';
//
//        if ($c == $limit) {
//            break;
//        }
//
//        $sku = $productData['sku'];
//        $type = "simple";
//        $file = Rotas::get_DirImagesCapas() . '/' . $sku . '.jpg';
//        
//        if (file_exists($file)) {//VERIFICANDO SE A FOTO EXISTE PARA TRABALHAR SÓ COM ITENS COM CAPA
//            $dataSet = [];
//
//            //CATEGORIAS DO MAGENTO
//            $nomeCategoria = $productData["group"];
//            $categoriaDePara = isset($dadosDePara['categoriaMagento'][$nomeCategoria]) ? $dadosDePara['categoriaMagento'][$nomeCategoria] : false;
//            $tipoProduto = $productData['typeProduct'];
//            if ($categoriaDePara) {
//                $productData["categories"] = [];
//                $i = 0;
//                for ($i = 0; $i <= 1; $i++) {
//                    if ($i == 0) {
//                        $id = isset($dataCategoriaMagento[$tipoProduto]["category_id"]) ? $dataCategoriaMagento[$tipoProduto]["category_id"] : false;
//                        array_push($productData["categories"], $id);
//                    }
//
//                    if ($i == 1) {
//                        $id = isset($dataCategoriaMagento[$tipoProduto][$categoriaDePara]) ? $dataCategoriaMagento[$tipoProduto][$categoriaDePara] : false;
//                        array_push($productData["categories"], $id);
//                    }
//                }
//            }
//
//
//            unset($productData['id']);
//
//            try {
//                $idMagento = $produtuctManager->create($type, 4, $sku, $productData)->execute();
//            } catch (Exception $ex) {
//                $idMagento = false;
//                echo Sistema::msgAlert("Já existe um produto com SKU $sku");
//            }
//            
//            var_dump($idMagento);
//
//            if ($idMagento > 0) {
//                $paramsImg = [
//                    "name" => $productData['name'],
//                    "idMagento" => $idMagento,
//                    "sku" => $sku
//                ];
//
//                if ($produtoBis2Bis->insertImage($paramsImg)) {
//                    $dataSet["enviouImage"] = "1";
//                    $cimg ++;
//                }
//                $paramEstoque = [
//                    "idMagento" => $idMagento,
//                    "qty" => $productData['qty']
//                ];
//                $produtoBis2Bis->enviarEstoque($paramEstoque);
//
//                $dataSet["integrado"] = "S";
//                $dataSet["idTerceiro"] = $idMagento;
//                $dataSet["atualizaDados"] = 'N';
//
//                $dataWhere = [
//                    "id_loja" => Config::ID_LOJA,
//                    "COD_BARRA_ITEM" => $sku
//                ];
//
//                $dadosAdmin->updateTable("hs_produtos", $dataSet, $dataWhere);
//                $c ++;
//            }
//        }
//        
//    }
//}
//echo Sistema::msgSucess("{$c} produto(s) enviado(s) | {$cimg} imagem(ns) enviada(s) para o magento");

//var_dump('aqui');
//die;

//INICIO DOS PRODUTOS QUE SERÃO ATUALIZADOS NO MAGENTO
$filterUpdate = [
    "integrado" => "S",
    "atualizaDados" => "S",
    'COD_BARRA_ITEM'=>"9786555355529"
];
if (isset($_GET['COD_ITEM_UP'])) {
    $filterUpdate = ["COD_ITEM" => $_GET['COD_ITEM_UP']];
}

$produtosCronuz2 = new ProdutoDados();
$dataProdutos2 = $produtosCronuz2->getDadosProdutos($filterUpdate);

$limit = 1;
$dadosUpdate = [];
$queryUpdate = "";
$paramsUpdate = [];
$u = 0;
if (!empty($dataProdutos2)) {
    foreach ($dataProdutos2 as $productData2) {
//        var_dump($productData2);
        if ($u == $limit) {
            break;
        }
        $productID = $productData2['id'];

        if ($productID > 0) {
            $sku = $productData2['sku'];

            //CATEGORIAS DO MAGENTO
            if ($atualizarCategorias == '1') {
                $nomeCategoria = $productData2["group"];
                $categoriaDePara = isset($dadosDePara['categoriaMagento'][$nomeCategoria]) ? $dadosDePara['categoriaMagento'][$nomeCategoria] : false;
                $tipoProduto = $productData2['typeProduct'];
                if ($categoriaDePara) {
                    $productData2["categories"] = [];
                    $i = 0;
                    for ($i = 0; $i <= 1; $i++) {
                        if ($i == 0) {
                            $id = isset($dataCategoriaMagento[$tipoProduto]["category_id"]) ? $dataCategoriaMagento[$tipoProduto]["category_id"] : false;
                            array_push($productData2["categories"], $id);
                        }

                        if ($i == 1) {
                            $id = isset($dataCategoriaMagento[$tipoProduto][$categoriaDePara]) ? $dataCategoriaMagento[$tipoProduto][$categoriaDePara] : false;
                            array_push($productData2["categories"], $id);
                        }
                    }
                }
            }
            unset($productData2['id']);
            
            $produtoBis2Bis = new ProdutoBis2Bis($apiKey, $apiUser, $path);
            $dadosUpdate = [
                "productId"=>$productID,
                "dados"=>$productData2
            ];
            $retorno = $produtoBis2Bis->updateDadosProduto($dadosUpdate);
            
            
            var_dump($retorno);
            die;
            
            
            var_dump($produtuctManager->getInfo($productID));
            die;
            $retorno = $produtuctManager->update($productID, $productData2)->execute();
            
            var_dump($retorno);
            die;
            if ($retorno == true) {

                $dataSet2 = [
                    "atualizaDados" => 'N',
                ];

                //ATUALZIANDO A IMG
                $paramsImg = [
                    "name" => $productData2['name'],
                    "idMagento" => $productID,
                    "sku" => $sku
                ];
                if ($atualizarImagem == '1') {
                    $produtoBis2Bis->removeImage($paramsImg);
                    if ($produtoBis2Bis->insertImage($paramsImg)) {
                        $dataSet2['enviouImage'] = '1';
                    }
                }

                //ATUALIZANDO ESTOQUE
                $paramEstoque = [
                    "idMagento" => $productID,
                    "qty" => $productData2['qty']
                ];
                $produtoBis2Bis->enviarEstoque($paramEstoque);

                $dataWhere2 = [
                    "id_loja" => Config::ID_LOJA,
                    "idTerceiro" => $productID
                ];
                $comand2 = $produtosCronuz2->gerarQueryUpdateSQL("hs_produtos", $dataSet2, $dataWhere2);
                foreach ($comand2["params"] as $k2 => $cmd2) {
                    $paramsUpdate[$k2] = $cmd2;
                }
                $queryUpdate .= $comand2["query"];

                $u ++;
            }
        }
    }
}

if (!empty($queryUpdate)) {
    $produtosCronuz2->executeSQL($queryUpdate, $paramsUpdate);
}
echo Sistema::msgSucess("{$u} produto(s) atualizado no Magento!");


$configuracao->updateDateIntegrador($tipoSincronizacao, 'Sincronização de produtos - Magento');

