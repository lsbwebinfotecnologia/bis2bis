<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutosUpdateSkyhub
 *
 * @author licivando
 */
class ProdutosUpdateSkyhub extends Conexao{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function getProductsUpdateSkyhub($tipoUpdate=null, $idProduto = null) {
        $query = "
            SELECT
                pp.p_id as id_produto,
                pp.id_item_externo as sku,
                pp.titulo as name,
                pp.full_desc as description,
                pp.statusSkyhub as status,
                if(pp.unidades <= pp.estoqueMinimoSkyhub, pp.estoqueMinimoSkyhub, pp.unidades) as qty,
                pp.priceSkyhub as price,
                pp.promotionalPriceSkyhub as promotional_price,
                0.00 as cost,
                pp.peso as weight,
                pp.dimensoes,	
                (select pe.nome from p_editoras pe where pp.id_editora = pe.id_editora and pp.id_loja = pe.id_loja) as brand,
                pp.isbn as ean,
                '49019900' as nbm,
                #'M' as Tamanho,
                pp.id_tipo_produto as code_category, 
                '' as categories,                
                (select pt.nome from p_tipo_produto pt where pp.id_tipo_produto = pt.id_tipo_produto and pp.id_loja = pt.id_loja) as name_category,
                (select pc.nome from p_categorias pc where pp.id_cat = pc.id_cat and pp.id_loja = pc.id_loja) as name_specification,
                (select pi.dir_name from p_images pi where pp.p_id = pi.id_produto and pp.id_loja = pi.id_loja order by id_img desc limit 1) as images 
            FROM p_produtos pp 
            WHERE pp.id_loja = :id_loja 
            AND pp.statusSkyhub = 'enabled' 
            AND pp.skyhub = '1'
        ";
        
        if($tipoUpdate){
            $query .= " AND $tipoUpdate = 'S' ";
        }
        
        $query .= " limit 50 ";
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA
        );
        if($idProduto){
            $query .= " AND pp.p_id = :p_id ";
            $params[":p_id"] = $idProduto;
        }
        
        $this->executeSQL($query, $params);
        $this->getListItens();
    }

    
    private function getListItens() {   
        
        $i = 1;
       
        while ($list = $this->listDatas()) :
            
            $dimensoes = explode('x', $list['dimensoes']);
            
            $height = $dimensoes[0];
            $width = $dimensoes[1];
            $length = $dimensoes[2];
            
            $this->datas[$i] = array(
                'id_produto' => $list['id_produto'],
                'sku' => $list['sku'],
                'name' => $list['name'],
                'description' => $list['description'],
                'status' => $list['status'],
                'qty' => (int)$list['qty'],
                'price' => $list['price'],
                'promotional_price' => $list['promotional_price'],
                'cost' => $list['cost'],
                'weight' => $list['weight'],
                'height' => $height,
                'width' => $width,
                'length' => $length,
                'brand' => $list['brand'],
                'ean' => $list['ean'],
                'nbm' => $list['nbm'],
                'code_category' => $list['code_category'],
                'categories' => $list['categories'],
                'name_category' => $list['name_category'],
                'assunto' => $list['name_specification'],
                'images' => $list['images']
            );
            
            $i ++;
        endwhile;
        
    }
}
