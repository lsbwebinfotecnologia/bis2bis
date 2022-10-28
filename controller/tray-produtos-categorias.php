<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$config = new TrayConfig();
$dataConfig = $config->getConfigs('teste');
$access_token = $dataConfig['access_token']; //TOKEN QUE É ATUALIZADO DE TEMPO EM TEMPO



$categoriasTray = new TrayCategorias();
$dataCategoriaTray = $categoriasTray->getCategoriasTray($access_token);
$dataCategoriaCronuz = $categoriasTray->getCategoriasCronuz();


if (isset($dataCategoriaTray->Category)) {
    $c = 0;
    foreach ($dataCategoriaTray->Category as $key => $categoria) {//NIVEL 1
        unset($categoria->Category->link);
        unset($categoria->Category->images);

        if ($categoria->Category->children) {

            foreach ($categoria->Category->children as $subCategoria) {//NIVEL 2
                unset($subCategoria->Category->link);
                unset($subCategoria->Category->images);
                unset($categoria->Category->children);

                if ($subCategoria->Category->children) {
                    foreach ($subCategoria->Category->children as $subCategoria2) {//NIVEL 3
                        unset($subCategoria2->Category->link);
                        unset($subCategoria2->Category->images);
                        unset($subCategoria->Category->children);
                    }
//                    var_dump($subCategoria2);
                    if (!isset($dataCategoriaCronuz[$subCategoria2->Category->id])) {//INSERINDO A CATEGORIA NIVEL 3 SE NÃO EXISTIR NO CRONUZ
                        $subCategoria2->Category->id_loja = Config::ID_LOJA;
                        $categoriasTray->insertTable('p_tray_categorias', (array) $subCategoria2->Category);
                        $c ++;
                    }
                }
//                    var_dump($subCategoria);
                if (!isset($dataCategoriaCronuz[$subCategoria->Category->id])) {//INSERINDO A CATEGORIA NIVEL 2 SE NÃO EXISTIR NO CRONUZ
                    $subCategoria->Category->id_loja = Config::ID_LOJA;
                    $categoriasTray->insertTable('p_tray_categorias', (array) $subCategoria->Category);
                    $c ++;
                }
            }
        }

        if (!isset($dataCategoriaCronuz[$categoria->Category->id])) {//INSERINDO A CATEGORIA NIVEL 1 SE NÃO EXISTIR NO CRONUZ
            $categoria->Category->id_loja = Config::ID_LOJA;
            $categoriasTray->insertTable('p_tray_categorias', (array) $categoria->Category);
            $c ++;
        }
    }
} else {
    echo Sistema::msgAlert("Nenhuma categoria encontrada!");
}








