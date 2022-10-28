<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CronusProdutosSkyHub
 *
 * @author licivando
 */
class CronusProdutosSkyHub extends Conexao {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    public function getListProductSkyhub($status = null, $dataFilter=array()) {
        $query = "
            SELECT
                pp.p_id as id_produto,
                pp.id_item_externo, 
                pp.isbn as sku,
                pp.titulo as name,
                pp.full_desc as description,
                pp.statusSkyhub as status,
                pp.unidades as qty,
                if(pp.promotionalPriceSkyhub > 0.00, pp.promotionalPriceSkyhub, NULL) as promotional_price, 
                pp.priceSkyhub as price,
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
                #(select pi.dir_name from p_images pi where pp.p_id = pi.id_produto and pp.id_loja = pi.id_loja order by id_img desc limit 1) as images 
                concat(id_loja, '/', isbn, '.jpg' )as images
            FROM p_produtos pp 
            WHERE pp.id_loja = :id_loja 
            #AND pp.skyhub = '1' 
        ";

        $params = array(
            ":id_loja" => Config::ID_LOJA
        );
        
        $complementPaginacao = " WHERE id_loja = :id_loja ";
        
        
        if($status){
            $query .= " and statusSkyhub = :status ";
            $complementPaginacao .= " and statusSkyhub = :status ";
            $params[":status"] = $status;
            
            
        }
        
        if (isset($dataFilter['status']) && $dataFilter['status'] != '0') {
            $query .= " and statusSkyhub = :status ";
            $complementPaginacao .= " and statusSkyhub = :status ";
            $params[":status"] = $dataFilter['status'];
        }
        
        if ($dataFilter['editora']) {
            $query .= " and id_editora = :id_editora ";
            $complementPaginacao .= " and id_editora = :id_editora ";
            $params[":id_editora"] = $dataFilter['editora'];
        }
        
        if ($dataFilter['sku']) {
            $sku = $dataFilter['sku'];
            $query .= " and p_id = :sku or isbn = :sku or id_item_externo = :sku ";
            $complementPaginacao .= " and p_id = :sku or isbn = :sku or id_item_externo = :sku ";
            $params[":sku"] = $sku;
        }
        
        if ($dataFilter['titulo']) {
            $titulo = $dataFilter['titulo'];
            $query .= " and titulo like :titulo ";
            $complementPaginacao .= " and titulo like :titulo ";
            $params[":titulo"] = "%$titulo%";
        }
        $query .= " order by p_id desc ";
        $query .= $this->paginacaoLinks('p_id', "p_produtos $complementPaginacao ", $params);
        

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
                'id_item_externo' => $list['id_item_externo'],
                'sku' => $list['sku'],
                'name' => $list['name'],
                'description' => $list['description'],
                'status' => $list['status'],
                'qty' => $list['qty'],
                'price' => Sistema::MoedaBR($list['price']),
                'promotional_price' => Sistema::MoedaBR($list['promotional_price']),
                'cost' => $list['cost'],
                'weight' => $list['weight'],
                'height' => $height,
                'width' => $width,
                'length' => $length,
                'brand' => $list['brand'],
                //'Tamanho' => $list['Tamanho'],
                'ean' => $list['ean'],
                'nbm' => $list['nbm'],
                'code_category' => $list['code_category'],
                'categories' => $list['categories'],
                'name_category' => $list['name_category'],
                'assunto' => $list['name_specification'],
                'images' => Config::ID_LOJA .'/'. Sistema::imgExist($list['ean'])
            );
            
            $i ++;
        endwhile;
        
    }

}
