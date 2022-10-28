<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_erros', 1);
//error_reporting(E_ALL);

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

$configuracao = new Configuracoes();

$categoriaPai = new Categorias();
$filtro = [
    "integrado" => "N"
];

$listaCategoriasPaiCronuz = $categoriaPai->getCategoriasPai($filtro);
$woocommerce = new Automattic\WooCommerce\Client(Config::WS_URL_LOJA, Config::WS_KEY_CONSUMER, Config::WS_SECRET_CONSUMER);

//INSERINDO CATEGORIAS NO WC
$c = 0;
$evento = new EventosCronus();
foreach ($listaCategoriasPaiCronuz as $categoria) {
    $nomeCategoria = $categoria['slogan'];
    $idPai = $categoria['idPai'];
    $data = [
        'name' => $nomeCategoria,
        'image' => [
            'src' => ''
        ]
    ];
    $retornoCategoriaWC = $woocommerce->post('products/categories', $data);
    $idTerceiro = isset($retornoCategoriaWC->id) ? $retornoCategoriaWC->id : false;
    $dataSet = [
        "integrado" => 'S',
        "idTerceiro" => $idTerceiro
    ];

    $dataWhere = [
        "idPai" => $idPai,
        "id_loja" => Config::ID_LOJA
    ];
    $evento->updateTable("p_categorias_pai", $dataSet, $dataWhere);

    $c ++;
}
echo Sistema::msgSucess("{$c} Categorias inseridas no WC");


$filtroProdutos = [
    "integrado" => 'N',
    "limit"=>20
];
$ftp = new FTPcs(Config::FTP_HOST, Config::FTP_USER, Config::FTP_PASS);
$produtoDados = new ProdutoDados();
$dataProdutos = $produtoDados->getDadosProdutos($filtroProdutos);

$p = 0;
$u = 0;
if (!empty($dataProdutos)) {
    foreach ($dataProdutos as $produto) {
        unset($produto["id"]); //IGNORADO NO INSERT
        $codItem = $produto['sku'];
        $filtroConsultarWC = [//FILTRO CONULTAR PRODUTO PELO SKU
            "sku" => $produto["sku"]
        ];
        $consulta = $woocommerce->get("products", $filtroConsultarWC);

        if (empty($consulta)) {//CONSULTA PARA SABER SE EXISTE NO WC
            if ($p == 20) {
                break;
            }
            
            //COPIAR CAPA NA URL DO CRONUZ VIA FTP
            $fileOrigem = $produto['images'][0]['src'];
            $fileDestinoFTP = "capes/" . $produto["isbn"] . ".jpg";

            if ($ftp->uploadFile($fileOrigem, $fileDestinoFTP)) {
                $produto['images'][0]['src'] = Config::URL_IMGS . "/" . $produto["isbn"] . ".jpg";
                unset($produto["isbn"]);
            } else {
                unset($produto["isbn"]);
                unset($produto['images']);
            }

            $retornoProdutoWC = $woocommerce->post('products', $produto);
            $idTerceiro = isset($retornoProdutoWC->id) ? $retornoProdutoWC->id : false;
            $url = isset($retornoProdutoWC->permalink) ? $retornoProdutoWC->permalink : false;
            $dataSet2 = [
                "integrado" => 'S',
                "resourceUri" => $url,
                "idTerceiro" => $idTerceiro
            ];

            $dataWhere2 = [
                "COD_ITEM" => $codItem,
                "id_loja" => Config::ID_LOJA
            ];

            $evento->updateTable("hs_produtos", $dataSet2, $dataWhere2);
            $p ++;
        } else {//ATUALIZA O ID NO CRONUZ SE JÁ EXISTIR O SKU NO WOOCOMMERCE
//        var_dump($consulta);
//        die;
            $dataSet2 = [
                "integrado" => 'S',
                "resourceUri" => $consulta[0]->permalink,
                "idTerceiro" => $consulta[0]->id
            ];

            $dataWhere2 = [
                "COD_ITEM" => $codItem,
                "id_loja" => Config::ID_LOJA
            ];
            $evento->updateTable("hs_produtos", $dataSet2, $dataWhere2);
            $u ++;
        }
    }
}
$configuracao->updateDateIntegrador('wc-produtos', 'Sincronização de produtos - WC');
echo Sistema::msgSucess("{$p} produtos inseridos no WC e {$u} com sku atualizado(s) no cronuz");

//PRODUTOS QUE SERÃO ATUALIZADOS
$filtroProdutos2 = [
    "integrado" => 'S',
    "atualizaDados" => 'S'
];
$produtoDados2 = new ProdutoDados();
$dataProdutos2 = $produtoDados2->getDadosProdutos($filtroProdutos2);

$a = 0;
$i = 0;
if (!empty($dataProdutos2)) {
    foreach ($dataProdutos2 as $produto2) {
        $id = $produto2["id"];
        unset($produto2["id"]); //IGNORADO NO INSERT
        if ($a == 25) {
            echo Sistema::msgAlert("próximo: " . $produto2["sku"]);
            break;
        }

        //COPIAR CAPA NA URL DO CRONUZ VIA FTP
        $fileOrigem = $produto2['images'][0]['src'];
        $fileDestinoFTP = "capes/" . $produto2["isbn"] . ".jpg";

        if ($ftp->uploadFile($fileOrigem, $fileDestinoFTP)) {
            $produto2['images'][0]['src'] = Config::URL_IMGS . "/" . $produto2["isbn"] . ".jpg";
            unset($produto2["isbn"]);
            $i ++;
        } else {
            unset($produto2["isbn"]);
            unset($produto2['images'][0]['src']);
        }

        $retornoProdutoWC2 = $woocommerce->put("products/{$id}", $produto2);

        $dataSet3 = [
            "atualizaDados" => 'N',
        ];

        $dataWhere3 = [
            "idTerceiro" => $id,
            "id_loja" => Config::ID_LOJA
        ];

        $evento->updateTable("hs_produtos", $dataSet3, $dataWhere3);

        $a ++;
    }
}
echo Sistema::msgSucess("{$a} produtos atualizado(s) e {$i} Imagens atualizadas no WC");

//var_dump($dataProdutos2);
