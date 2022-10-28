<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosCronuz
 *
 * @author licivando
 */
class PedidosCronuz extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function getPedidos($filter = []) {
        $query = "
            select distinct  
                *,
                (select id_cliente_erp from c_clientes cc where cc.id_cli = lv.id_cli) as id_cliente_erp,
                (select cpf from c_clientes cc where cc.id_cli = lv.id_cli) as cpf,
                (select celular from c_clientes cc where cc.id_cli = lv.id_cli) as celular,
                (select nome from c_clientes cc where cc.id_cli = lv.id_cli) as nome,
                (select email from c_clientes cc where cc.id_cli = lv.id_cli) as email,
                (select tipo from c_clientes cc where cc.id_cli = lv.id_cli) as tipo,
                (select cnpj from c_clientes cc where cc.id_cli = lv.id_cli) as cnpj,
                (select logradouro from c_enderecos ce where ce.id_e = lv.id_endereco) as logradouro,
                (select bairro from c_enderecos ce where ce.id_e = lv.id_endereco) as bairro,
                (select numero from c_enderecos ce where ce.id_e = lv.id_endereco) as numero,
                (select complemento from c_enderecos ce where ce.id_e = lv.id_endereco) as complemento,
                (select cep from c_enderecos ce where ce.id_e = lv.id_endereco) as cep,
                (select cidade from c_enderecos ce where ce.id_e = lv.id_endereco) as cidade,
                (select estado from c_enderecos ce where ce.id_e = lv.id_endereco) as uf,
                (select sum(PESO_ITEM) from hs_produtos hp where hp.idProduto in (select prod_id from l_itens_vendas li where li.id_venda = lv.v_id)) as peso
                
            from l_vendas lv where id_loja = :id_loja ";
        $params = [
            ":id_loja" => Config::ID_LOJA
        ];

        if (isset($filter['v_id']) && $filter['v_id'] != FALSE) {
            $query .= " and v_id = :v_id ";
            $params[":v_id"] = $filter["v_id"];
        }
        
        if (isset($filter['semIDHorus'])) {
            $query .= " and cod_ped = :v_id ";
            $params[":v_id"] = $filter["v_id"];
        }

        if (isset($filter['wcConcluido'])) {
            $query .= " and wcConcluido = :wcConcluido ";
            $params[":wcConcluido"] = $filter["wcConcluido"];
        }

        if (isset($filter['id_pedido_loja'])) {
            $query .= " and id_pedido_loja = :id_pedido_loja ";
            $params[":id_pedido_loja"] = $filter["id_pedido_loja"];
        }

        if (isset($filter['status_pag'])) {
            $query .= " and status_pag = :status_pag ";
            $params[":status_pag"] = $filter["status_pag"];
        }

        if (isset($filter['id_status_prod'])) {
            $query .= " and id_status_prod = :id_status_prod ";
            $params[":id_status_prod"] = $filter["id_status_prod"];
        }

        if (isset($filter['pedido_exportado_erp'])) {
            $query .= " and pedido_exportado_erp = :pedido_exportado_erp ";
            $params[":pedido_exportado_erp"] = $filter["pedido_exportado_erp"];
        }
//        var_dump($params);
//        echo '<pre>';
//        print_r($query);

        $this->executeSQL($query, $params);


        if ($this->totalDatas() > 0) {
            $this->getListaDePedidos();
            return $this->getDatas();
        } else {
            return false;
        }
    }


    
    private function getListaDePedidos() {//ESTRUTURA DO BANCO DE DADOS DA TABELA
        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$i] = array(
                'v_id' => $list['v_id'],
                'id_cli' => $list['id_cli'],
                'id_status_prod' => $list['id_status_prod'],
                'id_pedido_loja' => $list['id_pedido_loja'],
                'cod_pedido_erp' => $list['cod_pedido_erp'],
                'id_endereco' => $list['id_endereco'],
                'tipoPagto' => $list['tipoPagto'],
                'status' => $list['status_pag'],
                'frete' => $list['frete'],
                'total' => $list['total'],
                'prazo' => $list['prazo'],
                'freteMode' => $list['freteMode'],
                'parcelas' => $list['parcelas'],
                'id_cliente_erp' => $list['id_cliente_erp'],
                'cpf' => $list['cpf'],
                'celular' => $list['celular'],
                'nome' => $list['nome'],
                'qtdParcelas' => $list['parcelas'],
                'email' => $list['email'],
                'tipo' => $list['tipo'],
                'cnpj' => $list['cnpj'],
                'total_desc' => $list['total_desc'],
                'logradouro' => $list['logradouro'],
                'bairro' => $list['bairro'],
                'numero' => $list['numero'],
                'complemento' => $list['complemento'],
                'cep' => $list['cep'],
                'cidade' => $list['cidade'],
                'uf' => $list['uf'],
                'peso' => $list['peso']
            );

            $i ++;
        endwhile;
    }

}
