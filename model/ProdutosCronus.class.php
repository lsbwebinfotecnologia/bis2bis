<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produtos
 *
 * @author Licivando Brito
 */
class ProdutosCronus extends Conexao {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    function getProducts($idProduto = null) {
        //QUERY ESPECIFICA PARA BUSCAR PRODUTOS
        $query = "
            SELECT
                p_id, 
                titulo,
                id_item_externo,
                full_desc,
                isbn,
                id_loja,
                id_autor,
                paginas,
                edicao,
                idioma,
                peso,
                dimensoes, 
                id_cat,
                id_tipo_produto,
                unidades,
                estoqueMinimoSkyhub,
                skyhub,
                custoAtual,
                statusSkyhub,
                situacao_item,
                #DATE_FORMAT(lanc_data,'%d/%m/%Y') as lanc_data,
                id_editora,
                concat(id_loja, '/', isbn, '.jpg') as image,
                pp.priceSkyhub AS precoCheio, 
                pp.promotionalPriceSkyhub as precoPromo      
            FROM p_produtos pp
            WHERE pp.id_loja = :id_loja AND pp.ativo = '1' AND pp.deleted = '0' "
        ;


        $params = array(
            ':id_loja' => Config::ID_LOJA
        );

        if ($idProduto) {
            $query .= ' AND pp.p_id = :id_produto ';
            $params[':id_produto'] = $idProduto;
            $this->executeSQL($query, $params);
            return $this->listDatas();
        } else {
            $query .= $this->paginacaoLinks("p_id", "p_produtos");

            $this->executeSQL($query, $params);
            $this->getListProducts();
        }
    }

    function setView($idProduto, $sid) {
        $query = "INSERT IGNORE INTO `p_views` (`id_loja`, `id_produto`, `data`, `deleted`, `sid`)
                  VALUES (:id_loja, :id_produto, NOW(),	'0', :sid)";
        $params = array(
            ':id_loja' => Config::ID_LOJA,
            ':id_produto' => $idProduto,
            ':sid' => $sid
        );
        $this->executeSQL($query, $params);
    }

    private function getListProducts() {

        $i = 1;

        while ($list = $this->listDatas()) :

            $this->datas[$i] = array(
                'p_id' => $list['p_id'],
                'titulo' => $list['titulo'],
                'id_cat' => $list['id_cat'],
                'unidades' => $list['unidades'],
                'isbn' => $list['isbn'],
                'id_loja' => $list['id_loja'],
                'precoCheio' => $list['precoCheio'],
                'precoCheioBR' => Sistema::MoedaBR($list['precoCheio']),
                'precoPromo' => $list['precoPromo'],
                'precoPromoBR' => Sistema::MoedaBR($list['precoPromo']),
                'full_desc' => $list['full_desc'],
                'id_autor' => $list['id_autor'],
                'skyhub' => $list['skyhub'],
                'statusSkyhub' => $list['statusSkyhub'],
                'id_editora' => $list['id_editora'],
                'id_item_externo' => $list['id_item_externo'],
                'paginas' => $list['paginas'],
                'situacao_item' => $list['situacao_item'],
                'peso' => $list['peso'],
                'dimensoes' => $list['dimensoes'],
                'image' => $list['image'],
                'id_tipo_produto' => $list['id_tipo_produto']
            );

            $i ++;
        endwhile;
    }

}
