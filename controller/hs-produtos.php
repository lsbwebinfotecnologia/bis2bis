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

$hsApiHorus = new HSApiHorus();
$configuracao = new Configuracoes();

$queryUpdate = "";
$paramsUpdate = [];

$queryInsert = "";
$paramsInsert = [];

//var_dump($hsApiHorus);
$tipoSincronizacao = "hs-produtos";
$infoIntegrador = $configuracao->getInfoIntegrador($tipoSincronizacao);
$dataIni = date('d/m/Y', strtotime('-0 days', strtotime($infoIntegrador['data_sicronizacao'])));

$dadosConfiguracoes = $hsApiHorus->dadosAutenticacao;

$filtros = [
    "EDICAO" => 'SIM',
    "DATA_INI" => $dataIni,
    "DATA_FIM" => date('d/m/Y', strtotime('+1 days')),
    "AUTORES_GERAIS_TIPO" => 'SIM',
];


$deParaKeys = [
    "codEmpresa" => "SD_COD_EMPRESA",
    "codFilial" => "SD_COD_FILIAL",
    "codLocalEstoque" => "SD_LOCAL_ESTOQUE",
    "tipoSaldo" => "SD_TIPO_SALDO",
    "codTipoCaracteristica" => "COD_TPO_CARACT",
    "codCaracteristica" => "COD_CARACT",
    "c1" => "C1",
    "c2" => "C2",
    "c3" => "C3",
    "c4" => "C4",
    "c5" => "C5",
];

foreach ($dadosConfiguracoes as $k => $config) {
    if (isset($deParaKeys[$k]) && !empty($config)) {
        $filtros[$deParaKeys[$k]] = $config;
    }
}

$optionsKeyGet = ["DATA_INI", "COD_GRUPO_ITEM", "SITUACAO_ITEM", "COD_EDITORA"];
if (!empty($_GET)) {
    foreach ($_GET as $key => $get) {
        if (in_array($key, $optionsKeyGet)) {
            $filtros[$key] = $get;
        }
    }
}

if (isset($_GET['COD_ITEM']) && $_GET['COD_ITEM'] > 0) {
    $filtros = ["COD_ITEM" => $_GET['COD_ITEM']];
}

$filtroFila = [
    "integrar" => "S"
];
$filaIntegracao = new FilaIntegracao();
$dataFila = $filaIntegracao->getFilaIntegracao($filtroFila);


$limit = Config::BD_LIMIT_POR_PAG;
if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
}

$tipoFiltroFila = isset($dataFila['tipoIntegracao']) ? $dataFila['tipoIntegracao'] : false;
$valorTipoFila = isset($dataFila['valor']) ? $dataFila['valor'] : false;


if (in_array($tipoFiltroFila, $optionsKeyGet)) {
    $filtros[$tipoFiltroFila] = $valorTipoFila;
}




$produtosAPI = json_decode($hsApiHorus->getProdutosHorus($filtros)); //BUSCANDO PRODUTOS NA API


if (isset($produtosAPI[0]->Falha)) {
    echo Sistema::msgDanger($produtosAPI[0]->Falha . " | " . $produtosAPI[0]->Mensagem);
} else {
    $listaIdsERP = []; //PARA BUSCAR APENAS OS PRODUTOS DO RETORNO DO API DO HORUS
    if ($produtosAPI) {
        foreach ($produtosAPI as $p) {// GUARDA OS ID DO RETORNO DA CHAMADA DO HORUS
            array_push($listaIdsERP, $p->COD_ITEM);
        }
    }

    //LISTA DE CATEGORIAS NO CRONUZ
    $categoriaHS = new HSCategorias();
    $listaCategoriasCronuz = $categoriaHS->getCategorias();
//    var_dump($listaCategoriasCronuz);
//    die;

    $gruposHS = new HSGrupoItem();
    $listaGruposCronuz = $gruposHS->getGruposItens();
    //LISTA DE EDITORAS NO CRONUZ
    $editoraHS = new HSEditoras();
    $listaEditorasCronuz = $editoraHS->getEditoras();
    //LISTA DE PRODUTOS NO CRONUZ
    $produtoHS = new HsProdutos();
    $listaItensCronuz = $produtoHS->getItensHorus($listaIdsERP); //BUSCA A LISTAGEM DE PRODUTOS DO CRONUZ COM BASE NO RETORNO DA CHAMADA
    //TRATAR CATEGORIA PAI
    $categoriaPai = new Categorias();
    $categoriaFilho = new Categorias();
    $listaCategoriasPaiCronuz = $categoriaPai->getCategoriasPai();
//    var_dump($listaCategoriasPaiCronuz);
    
    $listaCategoriasFilhoCronuz = $categoriaFilho->getCategoriasFilho();
//var_dump($listaCategoriasFilhoCronuz);
//    die;
    
    $caracteres = ['"',"'"];
    
    $c = 0;
    $a = 0;
    $e = 0;
    $img = 0;
    $cat = 0;
    $grp = 0;
    if (!empty($produtosAPI)) {
        foreach ($produtosAPI as $produto) {
            $downloadIMG = true;
            if ($c == $limit || $a == $limit) {
                break;
            }

            $dados = (array) $produto;

            $COD_ITEM = $produto->COD_ITEM;
            $DAT_ULT_ATL = $produto->DAT_ULT_ATL;
            $idCategoria = $dados['COD_GENERO'];
            $idGrupo = $dados['COD_GRUPO_ITEM'];
            $idEditora = $dados['COD_EDITORA'];
            //var_dump($COD_ITEM);

            $dados["id_loja"] = Config::ID_LOJA; //ACRESCENTANDO O ID DA LOJA
            $dados['VLR_CAPA'] = Sistema::formatNumberBanco($produto->VLR_CAPA);
            $dados['DESC_SINOPSE'] = str_replace($caracteres, "", $produto->DESC_SINOPSE);

            $dataCategoria = [//DADOS DA CATEGORIA
                "nome" => $dados['GENERO_NIVEL_1'],
                "id_loja" => Config::ID_LOJA,
                "id_categoria_externo" => $idCategoria,
            ];

            //CATEGORIA PAI E FILHO
            $categorias = explode('/', $dados['GENERO_NIVEL_1']);
            $nomeCategoriaPai = isset($categorias[0]) ? mb_strtoupper(trim($categorias[0])) : false;
            $nomeCategoriaFilho = isset($categorias[1]) ? trim($categorias[1]) : false;

            $dataCategoriaPai = [
                "id_loja" => Config::ID_LOJA,
                "nome" => $nomeCategoriaPai,
                "idArvore" => $idCategoria,
                "arvore" => mb_strtoupper($dados['GENERO_NIVEL_1'])
            ];
            $idPai = false;
            if (!isset($listaCategoriasPaiCronuz[$nomeCategoriaPai])) {

                $idPai = $categoriaPai->insertTable('p_categorias_pai', $dataCategoriaPai);

                if ($idPai) {
                    $dataCategoriaPai['idPai'] = $idPai;
                    $listaCategoriasPaiCronuz[$nomeCategoriaPai] = $dataCategoriaPai;
                }
            } else {
                $idPai = $listaCategoriasPaiCronuz[$nomeCategoriaPai]['idPai'];
            }

            $filhoExisteParaPai = false;
            if ($listaCategoriasFilhoCronuz) {
                foreach ($listaCategoriasFilhoCronuz as $filho) {
                    if ($filho['nome'] == $nomeCategoriaFilho && $filho['idPai'] == $idPai) {
                        $filhoExisteParaPai = true;
                        break;
                    }
                }
            }
            if (!$filhoExisteParaPai && $nomeCategoriaFilho) {
                $dataCategoriaFilho = [
                    "id_loja" => Config::ID_LOJA,
                    "idPai" => $idPai,
                    "nome" => $nomeCategoriaFilho,
                ];
                $idFilho = $categoriaFilho->insertTable('p_categorias_filho', $dataCategoriaFilho);
                if ($idFilho) {
                    $dataCategoriaFilho["idFilho"] = $idFilho;
                    $listaCategoriasFilhoCronuz[$idFilho] = $dataCategoriaFilho;
                }
            }

            if (!isset($listaCategoriasCronuz[$idCategoria])) {
                $categoriaHS->insertTable('p_categorias', $dataCategoria);
                $listaCategoriasCronuz[$idCategoria] = $dataCategoria;
                $cat ++;
            }

            $dataGrupo = [
                "id_loja" => Config::ID_LOJA,
                "nome" => $dados['NOM_GRUPO_ITEM'],
                "status" => '1',
                "id_grupo_externo" => $idGrupo,
            ];

            if (!isset($listaGruposCronuz[$idGrupo])) {
                $gruposHS->insertTable('p_grupo_item', $dataGrupo);
                $listaGruposCronuz[$idGrupo] = $dataGrupo;
                $grp ++;
            }

            $dataEditora = [//DADOS DA EDITORA
                "id_loja" => Config::ID_LOJA,
                "nome" => $dados['NOM_EDITORA'],
                "id_editora_externo" => $idEditora,
                "nom_fantasia" => $dados['NOM_EDITORA']
            ];

            if (!isset($listaEditorasCronuz[$idEditora])) {
                $editoraHS->insertTable('p_editoras', $dataEditora);
                $listaEditorasCronuz [$idEditora] = $dataEditora;
                $e ++;
            }
//            var_dump($dados);

            if (isset($listaItensCronuz[$COD_ITEM])) {
                $dataAtualizacaoCronuz = $listaItensCronuz[$COD_ITEM]['DAT_ULT_ATL'];
//            var_dump($dataAtualizacaoCronuz, $DAT_ULT_ATL);
                if ($dataAtualizacaoCronuz != $DAT_ULT_ATL || isset($_GET['COD_ITEM'])) {
                    $dataWhere = [
                        "COD_ITEM" => $COD_ITEM,
                        "id_loja" => Config::ID_LOJA
                    ];
                    $dados['atualizaDados'] = "S";
                    $comand = $produtoHS->gerarQueryUpdateSQL("hs_produtos", $dados, $dataWhere);

                    foreach ($comand["params"] as $k => $cmd) {
                        $paramsUpdate[$k] = $cmd;
                    }
                    $queryUpdate .= $comand["query"];
//                $produtoHS->updateTable('hs_produtos', $dados, $dataWhere);
                    $downloadIMG = true;
                    $a ++;
                }
            } else {

                $produtoNovo = new ProdutoDados();

                $filterNovo = [
                    "COD_ITEM" => $COD_ITEM
                ];

                $novo = $produtoNovo->getDadosProdutos($filterNovo);
//                var_dump($dados);
//                die;

                if (!$novo) {

                    $comand2 = $produtoHS->gerarQueryInsertSQL("hs_produtos", $dados);

                    foreach ($comand2["params"] as $k2 => $cmd2) {
                        $paramsInsert[$k2] = $cmd2;
                    }

                    $queryInsert .= $comand2["query"];
                    //$produtoHS->insertTable('hs_produtos', $dados);
                    $downloadIMG = true;
                    $c ++;
                }
            }


            if ($downloadIMG) {
                //VERIFICANDO A IMAGEM
                $fileOrigem = Config::DIR_IMGS . '/' . $produto->COD_BARRA_ITEM . '.jpg';
//                var_dump($fileOrigem);
                
//                var_dump($fileOrigem);
                $imagemExiste = Sistema::url_exists($fileOrigem);
//                var_dump($imagemExiste);

                if ($imagemExiste) {
                    $fileDestino = Rotas::get_DirImagesCapas() . "/" . $produto->COD_BARRA_ITEM . ".jpg";
//                    var_dump($fileDestino);
                    if (copy($fileOrigem, $fileDestino)) {
                        $img ++;
                    }
                }
            }
        }
    }

    if ($c == 0) {
        $dataSet = [
            "integrar" => "N",
        ];
        $dataWhere = [
            'id_loja' => Config::ID_LOJA,
            "tipoIntegracao" => $tipoFiltroFila,
            "valor" => $valorTipoFila
        ];
        echo Sistema::msgDanger("Não existe mais dados para buscar na fila {$tipoFiltroFila} | valor: {$valorTipoFila}");
        $filaIntegracao->updateTable("f_fila_integracao", $dataSet, $dataWhere);
    }


    if (!empty($queryInsert)) {//PEGANDO A QUERY E INSERINDO DE UMA UNICA CONSULTA NO BANCO

        $produtoHS->executeSQL($queryInsert, $paramsInsert);
    }

    if (!empty($queryUpdate)) {//PEGANDO A QUERY E INSERINDO DE UMA UNICA CONSULTA NO BANCO
        $produtoHS->executeSQL($queryUpdate, $paramsUpdate);
    }

    $configuracao->updateDateIntegrador($tipoSincronizacao, 'Sincronização de produtos - API');

    echo Sistema::msgSucess("$e editora(s) | $cat categoria(s) cadastrada(s) | $c produto(s) inseridos e $a produto(s) atualizados com sucesso!");
}

