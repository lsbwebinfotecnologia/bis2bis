<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produto
 *
 * @author licivando
 */
class Produto extends Conexao{
    //put your code here
    
    public $titulo, $sinopse, $idCategoriaBd, $ativo, $isbn, $idEditoraBd, $paginas, $dimensoes, $peso, $unidades, $deletado, $idSeloBd, $estoqueMinimo, $idTipoProdutoBd, $situacaoItem, $dataAtualizacaoWs;
    public $idCategoriaWs, $idEditoraWs, $idSeloWs, $idTipoProdutoWs, $idProdutoWs, $idGrupoWs, $statusItemWs, $dataLanctoWs;
            
    function __construct() {
        parent::__construct();
    }
    
    function insertProduto() {
        
        $query = "INSERT INTO `p_produtos` 
                (`id_loja`, `titulo`, `full_desc`, `id_cat`, `ativo`, `isbn`, `id_editora`, `lanc_data`, `paginas`, `dimensoes`, `peso`, `deleted`, `id_tipo_produto`,
                `id_item_externo`, `situacao_item`, `data_atualizacao`, `id_categoria_externo`, `id_editora_externo`, `id_tipo_produto_externo`, `unidades`, `estoq_min`, `id_selo_externo`, `id_grupo_externo`, `status_item_erp`) 
                VALUES( :id_loja, :titulo, :full_desc, :id_cat, :ativo, :isbn, :id_editora, :lanc_data, :paginas, :dimensoes, :peso, :deleted, :id_tipo_produto, 
                :id_item_externo, :situacao_item, :data_atualizacao, :id_categoria_externo, :id_editora_externo, :id_tipo_produto_externo, :unidades, :estoq_min, :id_selo_externo, :id_grupo_externo, :status_item_erp );";
        $params = array(
            ":id_loja" => Config::ID_LOJA,
            ":titulo" => $this->getTitulo(),
            ":full_desc" => $this->getSinopse(),
            ":id_cat"=> $this->getIdCategoriaBd(),
            ":ativo" => $this->getAtivo(),
            ":isbn"=> $this->getIsbn(),
            ":id_editora"=> $this->getIdEditoraBd(),
            ":paginas"=> $this->getPaginas(),
            ":dimensoes"=> $this->getDimensoes(),
            ":peso"=> $this->getPeso(),
            ":deleted"=> 0,
            ":id_tipo_produto"=> $this->getIdTipoProdutoBd(),
            ":id_item_externo"=> $this->getIdProdutoWs(),
            ":situacao_item"=> $this->getSituacaoItem(),
            ":data_atualizacao"=> $this->getDataAtualizacaoWs(),
            ":id_categoria_externo"=> $this->getIdCategoriaWs(),
            ":id_editora_externo"=> $this->getIdProdutoWs(),
            ":id_tipo_produto_externo"=> $this->getIdTipoProdutoWs(),
            ":unidades"=> 0,
            ":estoq_min"=> 0,                 
            ":lanc_data"=> $this->getDataLanctoWs(), 
            ":id_selo_externo"=> $this->getIdSeloWs(),
            ":id_grupo_externo"=> $this->getIdGrupoWs(),
            ":status_item_erp"=> $this->getStatusItemWs()
        );
        
        $this->executeSQL($query, $params);
    }
    
    function updateProduto() {
        $query = "UPDATE `p_produtos`
                 SET `titulo` = :titulo, `full_desc` = :full_desc, `id_cat` = :id_cat,  `ativo` = :ativo,  `isbn` = :isbn, `id_editora` = :id_editora, `lanc_data` = :lanc_data,                	
                     `paginas` = :paginas, `dimensoes` = :dimensoes, `peso` = :peso, `id_tipo_produto` = :id_tipo_produto, `situacao_item` = :situacao_item,
                     `data_atualizacao` = :data_atualizacao, `id_categoria_externo` = :id_categoria_externo, `id_editora_externo` = :id_editora_externo, `id_tipo_produto_externo` = :id_tipo_produto_externo, 
                     `id_selo_externo` = :id_selo_externo, `id_grupo_externo` = :id_grupo_externo, `status_item_erp` = :status_item_erp  
                WHERE `id_loja` = :id_loja AND id_item_externo = :id_item_externo;";
        
        $params = array(
            ":id_loja" => Config::ID_LOJA,
            ":titulo" => $this->getTitulo(),
            ":full_desc" => $this->getSinopse(),
            ":id_cat"=> $this->getIdCategoriaBd(),
            ":ativo" => $this->getAtivo(),
            ":isbn"=> $this->getIsbn(),
            ":id_editora"=> $this->getIdEditoraBd(),
            ":paginas"=> $this->getPaginas(),
            ":dimensoes"=> $this->getDimensoes(),
            ":peso"=> $this->getPeso(),
            ":id_tipo_produto"=> $this->getIdTipoProdutoBd(),
            ":id_item_externo"=> $this->getIdProdutoWs(),
            ":situacao_item"=> $this->getSituacaoItem(),
            ":data_atualizacao"=> $this->getDataAtualizacaoWs(),
            ":id_categoria_externo"=> $this->getIdCategoriaWs(),
            ":id_editora_externo"=> $this->getIdProdutoWs(),
            ":id_tipo_produto_externo"=> $this->getIdTipoProdutoWs(),
            ":lanc_data"=> $this->getDataLanctoWs(), 
            ":id_selo_externo"=> $this->getIdSeloWs(),
            ":id_grupo_externo"=> $this->getIdGrupoWs(),
            ":status_item_erp"=> $this->getStatusItemWs()
        );
        
        $this->executeSQL($query, $params);
    }
    
    function getProdutos() {
        $query = "SELECT id_item_externo, data_atualizacao FROM p_produtos WHERE id_loja = :id_loja;";
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA
        );

        $this->executeSQL($query, $params);
        
        $this->getListProduto();
        $consultaBD = $this->getDatas();
        
        $produtosBD = array();   
        
        foreach ($consultaBD as $key => $consulta) { 
            $produtosBD[$consulta['id_item_externo']] = $consulta['data_atualizacao'];        
        }
        
        return $produtosBD;
    }
    
    function updateInfoIdFastBD($idProdutoBd, $idProdutoLoja) {
        
        $query = "UPDATE p_produtos 
                  SET idProdutoLoja = :idProdutoLoja, 
                      integradoLoja = :integradoLoja 
                  WHERE p_id = :p_id AND id_loja = :id_loja";
        
        $params = array (
            ":id_loja"=> Config::ID_LOJA,
            ":idProdutoLoja"=> $idProdutoLoja,
            ":integradoLoja"=> 1,
            ":p_id" => $idProdutoBd
        );
        $this->executeSQL($query, $params);
        
    }
        
    function getProdutosSendLoja() {
        $query = "SELECT
                id_item_externo, 
                titulo,
                full_desc,
                peso as Peso,
                isbn,
                true as Disponivel,
                unidades as Estoque,
                (SELECT nome FROM p_editoras pe WHERE id_loja = :id_loja AND pe.id_editora = pp.id_editora) AS editora,
                (SELECT valor FROM p_precos ppr WHERE ppr.id_loja = :id_loja and ppr.id_produto = pp.p_id ORDER BY ppr.id_preco DESC LIMIT 1) AS Preco,
                (SELECT nome FROM p_categorias pc WHERE id_loja = :id_loja AND pc.id_cat = pp.id_cat) AS NomeCat,
                concat(isbn, '.jpg') as ImagemProd 
                #(SELECT nome_autor FROM p_autores pa WHERE id_loja = :id_loja AND pa.id_autor = pp.id_autor AND pa.ativo = '1') AS autor                 
            FROM p_produtos pp
            WHERE pp.id_loja = :id_loja AND pp.ativo = '1' AND pp.deleted = '0' and integradoLoja != '1' ";
        
        //$query .= " ORDER BY pp.titulo DESC";
        $query .= $this->paginacaoLinks("p_id", "p_produtos");
        
        $params = array(
            ':id_loja' => Config::ID_LOJA
        );
        
        $this->executeSQL($query, $params);        
        $this->getListProductsLoja(); 
        $dados = $this->getDatas();
        return $dados;
    }
    
    function getProdutosUpdateSaldo() {//BUSCA QUEM PRECISA ATUALIZAR SALDO VERIFICAR AS TRIGGERS DO BANCO
        $query = "select 
                    id_produto_loja, 
                    (select unidades from p_produtos pp where pp.p_id = ppf.id_produto_bd) as Estoque 
                 from p_produtos_fast  ppf
                 where id_loja = :id_loja and update_saldo = '0' and id_produto_loja > 0";
        $params = array(
            ":id_loja"=> Config::ID_LOJA
        );
        $this->executeSQL($query, $params);
        $this->getListProdutosUpdateSaldo();
        
        return $this->getDatas();
        
    }
    
    function getProdutosUpdateLoja() {
         $query = "SELECT
                ppf.id_produto_loja as IDProduto, 
                id_item_externo, 
                titulo,
                full_desc,
                peso as Peso,
                isbn,
                true as Disponivel,
                unidades as Estoque,
                (SELECT nome FROM p_editoras pe WHERE id_loja = :id_loja AND pe.id_editora = pp.id_editora) AS editora,
                (SELECT valor FROM p_precos ppr WHERE ppr.id_loja = :id_loja and ppr.id_produto = pp.p_id ORDER BY ppr.id_preco DESC LIMIT 1) AS Preco,
                (SELECT nome FROM p_categorias pc WHERE id_loja = :id_loja AND pc.id_cat = pp.id_cat) AS NomeCat,
                concat(isbn, '.jpg') as ImagemProd 
                #(SELECT nome_autor FROM p_autores pa WHERE id_loja = :id_loja AND pa.id_autor = pp.id_autor AND pa.ativo = '1') AS autor                 
            FROM p_produtos pp
            inner join p_produtos_fast ppf on ppf.id_produto_bd = pp.p_id 
            WHERE pp.id_loja = :id_loja 
            AND pp.ativo = '1' 
            AND pp.deleted = '0' 
            AND ppf.id_produto_loja > 0  
            AND ppf.update_dados = '0' 
            AND pp.integradoLoja = '1' ";
        
        //$query .= " ORDER BY pp.titulo DESC";
        $query .= $this->paginacaoLinks("p_id", "p_produtos");
        
        $params = array(
            ':id_loja' => Config::ID_LOJA
        );
        
        $this->executeSQL($query, $params);        
        $this->getListProductsUpdadeLoja(); 
        $dados = $this->getDatas();
        return $dados;
    }
    
    function getProdutosUpdatePrecos() {//BUSCA QUEM PRECISA ATUALIZAR SALDO VERIFICAR AS TRIGGERS DO BANCO
        $query = "select 
                    id_produto_loja, 
                    (select valor from p_precos ppr where ppr.id_produto = ppf.id_produto_bd) as Preco 
                 from p_produtos_fast  ppf
                 where id_loja = :id_loja and update_preco = '0' and id_produto_loja > 0";
        $params = array(
            ":id_loja"=> Config::ID_LOJA
        );
        $this->executeSQL($query, $params);
        $this->getListProdutosUpdatePrecos();
        
        return $this->getDatas();
        
    }
        
        
    function getTitulo() {
        return $this->titulo;
    }

    function getSinopse() {
        return $this->sinopse;
    }

    function getIdCategoriaBd() {        
        $query = "SELECT id_cat FROM p_categorias WHERE id_loja = :id_loja and id_categoria_externo = :id_categoria_externo order by id_cat desc limit 1";
        
        $params = array (
            "id_loja"=> Config::ID_LOJA,
            "id_categoria_externo" => $this->getIdCategoriaWs()
        );
        $this->executeSQL($query, $params);
        
        $this->idCategoriaBd = $this->listDatas();
        
        return $this->idCategoriaBd['id_cat'];
    }
    
    function getAtivo() {
        return $this->ativo;
    }

    function getIsbn() {
        return $this->isbn;
    }

    function getIdEditoraBd() {
        
        $query = "SELECT id_editora FROM p_editoras WHERE id_loja = :id_loja and id_editora_externo = :id_editora_externo order by id_editora desc limit 1";
        
        $params = array (
            "id_loja"=> Config::ID_LOJA,
            "id_editora_externo" => $this->getIdEditoraWs()
        );
        $this->executeSQL($query, $params);
        
        $this->idEditoraBd = $this->listDatas();
        
        return $this->idEditoraBd['id_editora'];
    }
    
    function getDataAtualizacaoWs() {
        return $this->dataAtualizacaoWs;
    }

    function setDataAtualizacaoWs($dataAtualizacaoWs) {
        $this->dataAtualizacaoWs = $dataAtualizacaoWs;
    }

        function getPaginas() {
        return $this->paginas;
    }

    function getDimensoes() {
        return $this->dimensoes;
    }

    function getPeso() {
        return $this->peso;
    }

    function getIdTipoProdutoBd() {
        
        $query = "SELECT id_tipo_produto FROM p_tipo_produto WHERE id_loja = :id_loja and id_tipo_externo = :id_tipo_externo order by id_tipo_produto desc limit 1";
        
        $params = array (
            ":id_loja"=> Config::ID_LOJA,
            ":id_tipo_externo" => $this->getIdTipoProdutoWs()
        );
        $this->executeSQL($query, $params);
        
        $this->idTipoProdutoBd = $this->listDatas();
        
        return $this->idTipoProdutoBd['id_tipo_produto'];
    }

    function getSituacaoItem() {
        return $this->situacaoItem;
    }

    function getIdSeloBd() {
        
        $query = "SELECT id_selo FROM p_selos WHERE id_loja = :id_loja and id_selo_externo = :id_selo_externo order by id_selo desc limit 1";
        
        $params = array (
            ":id_loja"=> Config::ID_LOJA,
            ":id_selo_externo" => $this->getIdSeloWs()
        );
        $this->executeSQL($query, $params);
        
        $this->idSeloBd = $this->listDatas();
        
        return $this->idSeloBd['id_selo'];
        
    }

    function setIdSeloBd($idSeloBd) {
        $this->idSeloBd = $idSeloBd;
    }

    function getIdCategoriaWs() {
        return $this->idCategoriaWs;
    }

    function getIdEditoraWs() {
        return $this->idEditoraWs;
    }

    function getIdSeloWs() {
        return $this->idSeloWs;
    }

    function getIdTipoProdutoWs() {
        return $this->idTipoProdutoWs;
    }

    function getIdProdutoWs() {
        return $this->idProdutoWs;
    }

    function getIdGrupoWs() {
        return $this->idGrupoWs;
    }

    function getStatusItemWs() {
        return $this->statusItemWs;
    }

    function getDataLanctoWs() {
        return $this->dataLanctoWs;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setSinopse($sinopse) {
        $this->sinopse = $sinopse;
    }

    function setIdCategoriaBd($idCategoriaBd) {
        $this->idCategoriaBd = $idCategoriaBd;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    function setIdEditoraBd($idEditoraBd) {
        $this->idEditoraBd = $idEditoraBd;
    }

    function setPaginas($paginas) {
        $this->paginas = $paginas;
    }

    function setDimensoes($dimensoes) {
        $this->dimensoes = $dimensoes;
    }

    function setPeso($peso) {
        $this->peso = $peso;
    }

    function setIdTipoProdutoBd($idTipoProdutoBd) {
        $this->idTipoProdutoBd = $idTipoProdutoBd;
    }

    function setSituacaoItem($situacaoItem) {
        $this->situacaoItem = $situacaoItem;
    }

    function setIdCategoriaWs($idCategoriaWs) {
        $this->idCategoriaWs = $idCategoriaWs;
    }

    function setIdEditoraWs($idEditoraWs) {
        $this->idEditoraWs = $idEditoraWs;
    }

    function setIdSeloWs($idSeloWs) {
        $this->idSeloWs = $idSeloWs;
    }

    function setIdTipoProdutoWs($idTipoProdutoWs) {
        $this->idTipoProdutoWs = $idTipoProdutoWs;
    }

    function setIdProdutoWs($idProdutoWs) {
        $this->idProdutoWs = $idProdutoWs;
    }

    function setIdGrupoWs($idGrupoWs) {
        $this->idGrupoWs = $idGrupoWs;
    }

    function setStatusItemWs($statusItemWs) {
        $this->statusItemWs = $statusItemWs;
    }

    function setDataLanctoWs($dataLanctoWs) {
        $this->dataLanctoWs = $dataLanctoWs;
    }
    function getUnidades() {
        return $this->unidades;
    }

    function getDeletado() {
        return $this->deletado;
    }

    function setUnidades($unidades) {
        $this->unidades = $unidades;
    }

    function setDeletado($deletado) {
        $this->deletado = $deletado;
    }
    function getEstoqueMinimo() {
        return $this->estoqueMinimo;
    }

    function setEstoqueMinimo($estoqueMinimo) {
        $this->estoqueMinimo = $estoqueMinimo;
    }

            
    private function getListProduto() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
              
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'id_item_externo' => $list['id_item_externo'],
            'data_atualizacao' => $list['data_atualizacao']
        );
        
        $i ++;
        endwhile;
        
    }
    
    private function getListProductsBD() {   
        
        $i = 1;
       
        while ($list = $this->listDatas()) :
            
            $this->datas[$i] = array(
                'p_id' => $list['p_id'],
                'titulo' => $list['titulo'],
                'id_cat' => $list['id_cat'],
                'isbn' => $list['isbn'],
                'id_loja' => $list['id_loja'],
                'preco_db' => $list['preco_db'],
                //'preco_dbBR' => Sistema::MoedaBR($list['preco_db']),
                'full_desc'=> $list['full_desc'],
                'autor'=> $list['autor'],
                'categoria'=> $list['categoria'],
                'editora'=> $list['editora'],
                'paginas'=> $list['paginas'],
                'ano'=> $list['ano'],
                'peso'=> $list['peso'],
                'dimensoes'=> $list['dimensoes'],
                'image'=> $list['image']
            );
            
            $i ++;
        endwhile;
        
    }
    
    private function getListProductsLoja() {   
        
        $i = 1;
       
        while ($list = $this->listDatas()) :
            
            $this->datas[$i] = array(
                'CodProd' => $list['id_item_externo'],
                'NomeProd' => $list['titulo'],
                'CodBarrasProd' => $list['isbn'],
                'Preco' => $list['Preco'],
                'DescrLonga'=> $list['full_desc'],
                'NomeCat'=> $list['NomeCat'],
                'Peso'=> $list['Peso'],
                'Disponivel'=> $list['Disponivel'],
                'Estoque'=> $list['Estoque'],
                'ImagemProd'=> $list['ImagemProd'],
                'ImagemDet'=> $list['ImagemProd'],
                'ImagemAmp'=> $list['ImagemProd']
            );
            
            $i ++;
        endwhile;
        
    }
    
    private function getListProductsUpdadeLoja() {   
        
        $i = 1;
       
        while ($list = $this->listDatas()) :
            
            $this->datas[$i] = array(
                'IDProduto' => $list['IDProduto'],
                'CodProd' => $list['id_item_externo'],
                'NomeProd' => $list['titulo'],
                'CodBarrasProd' => $list['isbn'],
                'Preco' => $list['Preco'],
                'DescrLonga'=> $list['full_desc'],
                'NomeCat'=> $list['NomeCat'],
                'Peso'=> $list['Peso'],
                'Disponivel'=> $list['Disponivel'],
                'Estoque'=> $list['Estoque'],
                'ImagemProd'=> $list['ImagemProd'],
                'ImagemDet'=> $list['ImagemProd'],
                'ImagemAmp'=> $list['ImagemProd'],
                'ChangeFlagProdAPI'=> '1',
                
            );
            
            $i ++;
        endwhile;
        
    }

    private function getListProdutosUpdateSaldo() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
              
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'IDProduto' => $list['id_produto_loja'],
            'Estoque' => $list['Estoque']            
                
        );
        
        $i ++;
        endwhile;
        
    }
    
    private function getListProdutosUpdatePrecos() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
              
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'IDProduto' => $list['id_produto_loja'],
            'Preco' => $list['Preco']            
                
        );
        
        $i ++;
        endwhile;
        
    }
    
    
}
