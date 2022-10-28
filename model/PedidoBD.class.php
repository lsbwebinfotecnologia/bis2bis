<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidoERP
 *
 * @author licivando
 */
class PedidoBD extends Conexao{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    function getPedidoIntegrar($idStatusIntegrar) {

        $query = "select 
                lv.id_pedido_loja,
                lv.v_id,
                lv.id_cli,
                lv.tipoPagto, 
                (select id_cliente_erp from c_clientes where id_cli = lv.id_cli) as id_cliente_erp,
                (select cpf from c_clientes where id_cli = lv.id_cli) as cpf,
                (select celular from c_clientes where id_cli = lv.id_cli) as celular,
                (select nome from c_clientes where id_cli = lv.id_cli) as nome,
                (select email from c_clientes where id_cli = lv.id_cli) as email,
                (select tipo from c_clientes where id_cli = lv.id_cli) as tipo,
                (select cnpj from c_clientes where id_cli = lv.id_cli) as cnpj,
                (select logradouro from c_enderecos where id_cli = lv.id_cli and id_e = lv.id_endereco) as logradouro,
                (select bairro from c_enderecos where id_cli = lv.id_cli and id_e = lv.id_endereco) as bairro,
                (select numero from c_enderecos where id_cli = lv.id_cli and id_e = lv.id_endereco) as numero,
                (select complemento from c_enderecos where id_cli = lv.id_cli and id_e = lv.id_endereco) as complemento,
                (select cep from c_enderecos where id_cli = lv.id_cli and id_e = lv.id_endereco) as cep,
                (select uf from c_estados where id = ce.estado) as uf,
                (select nome from c_estados where id = ce.estado) as nome_uf,
                (select nome from c_cidades where id = ce.cidade) as cidade,
                lv.freteMode,
                lv.tipo_pedido,
                lv.frete,
                lv.total
              from l_vendas lv 
                inner join c_enderecos ce on ce.id_e = lv.id_endereco  
              where lv.id_loja = :id_loja 
                and lv.id_status_prod = :id 
                and ce.id_e = lv.id_endereco 
                and lv.pedido_exportado_erp not in ('1');";
        //var_dump($query);
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":id"=> $idStatusIntegrar            
        );

        $this->executeSQL($query, $params);
        $this->getListPedidos();
                
    }
    
    function getPedidoAtualizarNota() {

        $query = "select 
                lv.id_pedido_loja,
                lv.cod_pedido_erp,
                lv.v_id,
                lv.id_cli,
                (select id_cliente_erp from c_clientes where id_cli = lv.id_cli) as id_cliente_erp, 
                lv.tipoPagto, 
                (select nome from l_vendas_status lvs where lvs.id_status = lv.id_status_prod and lvs.id_loja = lv.id_loja) as status 
              from l_vendas lv 
              where lv.id_loja = :id_loja 
                and lv.nro_nota_fiscal is null
                and lv.id_status_prod in (".$this->getIdStatusFaturado().") 
                and lv.pedido_exportado_erp in ('1')
                OR lv.codigo_rastreio is null
                and lv.id_status_prod in (".$this->getIdStatusFaturado().") 
                and lv.pedido_exportado_erp in ('1')
                ;";
                
        $params = array(
            ":id_loja"=> Config::ID_LOJA
        );
        
        $this->executeSQL($query, $params);
        $this->getListPedidosUpdate();
        
        //return $listPedidos;
        
    }
    
    function getPedidoAtualizar() {

        $query = "select 
                lv.id_pedido_loja,
                lv.cod_pedido_erp,
                lv.v_id,
                lv.id_cli,
                (select id_cliente_erp from c_clientes where id_cli = lv.id_cli) as id_cliente_erp, 
                lv.tipoPagto, 
                (select nome from l_vendas_status lvs where lvs.id_status = lv.id_status_prod and lvs.id_loja = lv.id_loja) as status 
              from l_vendas lv 
              where lv.id_loja = :id_loja 
                and lv.id_status_prod in (".$this->getIdStatusAtualizar().") 
                and lv.pedido_exportado_erp in ('1');";
                
        $params = array(
            ":id_loja"=> Config::ID_LOJA
        );

//        var_dump($params);
//        die;
        
        $this->executeSQL($query, $params);
        $this->getListPedidosUpdate();
        
        //return $listPedidos;
        
    }
    
    function getListPedidosAtualizarNaFast() {

        $query = "select 
                lv.id_pedido_loja,
                lv.cod_pedido_erp,
                lv.v_id,
                lv.id_cli,
                lv.chave_nfe,
                lv.codigo_rastreio, 
                (SELECT para FROM `a_conf_de_para` ac where ac.id_loja = lv.id_loja and ac.tipo_configuracao = 'id_status_Cronus_x_Fast' and ac.de = lv.id_status_prod) as id_status_prod 
              from l_vendas lv 
              where lv.id_loja = :id_loja 
                #and lv.v_id = 69 
                and lv.nro_nota_fiscal > 0 
                and lv.update_status_remetido != ('1') 
                and lv.pedido_exportado_erp in ('1');";
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA
        );

        $this->executeSQL($query, $params);
        $this->getListPedidosUpdateFAST();
        
        //return $listPedidos;
        
    }
    
    
    function getItensPedido($idPedido) {
        $query = "select distinct 
            lv.v_id,
            lv.id_cli,
            (select cod_item from hs_produtos where idProduto = iv.prod_id) as id_item_ws,
            iv.prod_id as id_item_eros,
            iv.quantidade,
            iv.val_unit,
            iv.desconto_cupom,
            iv.preco_bruto,
            iv.preco_liq
            from l_vendas lv 
            inner join l_itens_vendas iv on lv.v_id = iv.id_venda 
            inner join c_enderecos ce on ce.id_cli = lv.id_cli 
            where lv.id_loja = :id_loja 
            AND lv.v_id = :id_pedido;";
        
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":id_pedido"=> $idPedido
        );

        $this->executeSQL($query, $params);
        $this->getListItensPedidos();
        
    }
    
    function getIdStatusIntegrar() {
        $configuracao = new Configuracoes();
        return $configuracao->getDadosConfig('nomeStatPedidoEnvErp');
    }
    
    function getIdStatusAtualizar() {
        $configuracao = new Configuracoes();
//        var_dump($configuracao->getDadosConfig('nomeStatPedidoSincronizacaoERP'));
//        die;
        return $configuracao->getDadosConfig('nomeStatPedidoSincronizacaoERP');
    }
    
    function getIdStatusFaturado() {
        $configuracao = new Configuracoes();
        return $configuracao->getDadosConfig('nomeStatusFaturadoBuscaNfRastreio');
    }
    
    function idStatusProd($status) {
        $query = "SELECT id_status FROM l_vendas_status where nome = :nome AND id_loja = :id_loja limit 1";
        
        $params = array(
            ':nome' => $status,
            ':id_loja' => Config::ID_LOJA
        );        
        
        $this->executeSQL($query, $params);       
        
        $pedidoBD = $this->listDatas();
        
        return $pedidoBD['id_status'];
    }
    
    function updateRemetido($idPedidoLoja) {
        $query = "UPDATE `l_vendas` 
            SET `update_status_remetido` = '1'  
            WHERE `id_loja` = :id_loja 
            AND id_pedido_loja = :id_pedido_loja;";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":id_pedido_loja"=> $idPedidoLoja
        );
        $this->executeSQL($query, $params);
    }
    
    function updateIdPedidoErp($idPedidoBD, $idPedidoERP, $status) {
        $query = "UPDATE `l_vendas` 
            SET `pedido_exportado_erp` = :pedido_exportado_erp, 
            `cod_pedido_erp` = :cod_pedido_erp, 
            `id_status_prod` = :id_status_prod 
            WHERE `id_loja` = :id_loja 
            AND v_id = :v_id;";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":pedido_exportado_erp"=> 1,
            ":cod_pedido_erp"=> $idPedidoERP,
            ":id_status_prod"=> $status,
            ":v_id"=> $idPedidoBD
        );
        $this->executeSQL($query, $params);
    }
    
    function updateSatatusPedido($idPedidoERP, $status) {
        $query = "UPDATE `l_vendas` 
            SET `id_status_prod` = :id_status_prod 
            WHERE `id_loja` = :id_loja 
            AND `cod_pedido_erp` = :cod_pedido_erp ";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":cod_pedido_erp"=> $idPedidoERP,
            ":id_status_prod"=> $status
        );
        $this->executeSQL($query, $params);
    }
    
    function updateNFPedido($idPedidoERP, $chaveNF, $nroNf, $rastreio) {
        $query = "UPDATE `l_vendas` 
            SET `chave_nfe` = :chave_nfe, 
                `nro_nota_fiscal` = :nro_nota_fiscal, 
                codigo_rastreio = :codigo_rastreio 
            WHERE `id_loja` = :id_loja 
            AND `cod_pedido_erp` = :cod_pedido_erp ";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":cod_pedido_erp"=> $idPedidoERP,
            ":nro_nota_fiscal"=> $nroNf,
            ":chave_nfe"=> $chaveNF,
            ":codigo_rastreio" => $rastreio
        );
        $this->executeSQL($query, $params);
    }
    
   
    function getConfigIntegrador($name) {
        $query = "SELECT value FROM a_conf_integracao WHERE id_loja = :id_loja and name = :name;";
        $params = array(
            ":id_loja"=> Config::ID_LOJA,
            ":name"=> $name
        );
        $this->executeSQL($query, $params);
        return $this->listDatas()['value'];
    }
    
    private function getListPedidos() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
               
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'v_id' => $list['v_id'],
            'id_cli' => $list['id_cli'],
            'id_pedido_loja' => $list['id_pedido_loja'],
            'id_cliente_erp' => $list['id_cliente_erp'],
            'cpf' => $list['cpf'],
            'celular' => $list['celular'],
            'nome' => $list['nome'],
            'email' => $list['email'],
            'tipo' => $list['tipo'],
            'cnpj' => $list['cnpj'],
            'logradouro' => $list['logradouro'],
            'bairro' => $list['bairro'],
            'numero' => $list['numero'],
            'complemento' => $list['complemento'],
            'uf' => $list['uf'],
            'cep' => $list['cep'],
            'nome_uf' => $list['nome_uf'],
            'cidade' => $list['cidade'],
            'freteMode' => $list['freteMode'],
            'frete' => $list['frete'],
            'tipoPagto' => $list['tipoPagto'],
            'total' => $list['total'],
            'tipoPedido'=> $list['tipo_pedido']
                
        );
        
        $i ++;
        endwhile;
        
    }
    
    private function getListPedidosUpdate() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
              
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'v_id' => $list['v_id'],
            'id_cli' => $list['id_cli'],
            'id_pedido_loja' => $list['id_pedido_loja'],
            'cod_pedido_erp' => $list['cod_pedido_erp'],
            'id_cliente_erp' => $list['id_cliente_erp'],
            'tipoPagto' => $list['tipoPagto'],
            'status' => $list['status']
        );
        
        $i ++;
        endwhile;
        
    }
    
     private function getListPedidosUpdateFAST() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
              
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'NumPedido' => $list['id_pedido_loja'],
            'ObjSedex' => $list['codigo_rastreio'],
            'NumNFe' => $list['chave_nfe'],
            'Status' => $list['id_status_prod']
        );
        
        $i ++;
        endwhile;
        
    }
    
    private function getListPedidosUpdateAPI() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
              
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'v_id' => $list['v_id'],
            'id_cli' => $list['id_cli'],
            'id_pedido_loja' => $list['id_pedido_loja'],
            'cod_pedido_erp' => $list['cod_pedido_erp'],
            'id_cliente_erp' => $list['id_cliente_erp'],
            'tipoPagto' => $list['tipoPagto'],
            'status' => $list['status']
        );
        
        $i ++;
        endwhile;
        
    }
    
    
    private function getListItensPedidos() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
              
        $i = 1;        
        while ($list = $this->listDatas()) :
        $this->datas[$i] = array(
            'v_id' => $list['v_id'],
            'id_cli' => $list['id_cli'],
            'id_item_ws' => $list['id_item_ws'],
            'id_item_eros' => $list['id_item_eros'],
            'quantidade' => $list['quantidade'],
            'val_unit' => $list['val_unit'],
            'desconto_cupom' => $list['desconto_cupom'],
            'preco_bruto' => $list['preco_bruto'],
            'preco_liq' => $list['preco_liq']

        );
        
        $i ++;
        endwhile;
        
    }
}
