<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClienteDados
 *
 * @author licivando
 */
class ClienteDadosSkyhub extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getDadosClienteSkyhub($idCliente = null) {
        $query = "select * from c_clientes where id_loja = :id_loja ";
        $params = [
            ":id_loja" => Config::ID_LOJA
        ];

        if ($idCliente) {
            $query .= " and id_cli = :id_cli";
            $params[":id_cli"] = $idCliente;
            $this->executeSQL($query, $params);
            return $this->listDatas();
            
        } else {
            $this->executeSQL($query, $params);
            $this->getLisClientes();
            return $this->getDatas();
        }
    }

    private function getLisClientes() {

        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$i] = array(
                'id_cli' => $list['id_cli'],
                'id_cliente_erp' => $list['id_cliente_erp'],
                'cpf' => $list['cpf'],
                'celular' => $list['celular'],
                'nome' => $list['nome'],
                'email' => $list['email'],
                'tipo' => $list['tipo'],
                'cnpj' => $list['cnpj']                
            );

            $i ++;
        endwhile;
    }

}
