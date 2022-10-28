<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClienteDadosEnderecos
 *
 * @author licivando
 */
class ClienteDadosEnderecosSkyhub extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getDadosEnderecoClienteSkyhub($idCliente = null, $idEndereco=null) {
        $query = "select * from c_enderecos where id_loja = :id_loja ";
        $params = [
            ":id_loja" => Config::ID_LOJA
        ];

        if ($idCliente && $idEndereco) {
            $query .= " and id_cli = :id_cli and id_e = :id_e ";
            $params[":id_cli"] = $idCliente;
            $params[":id_e"] = $idEndereco;
            
            $this->executeSQL($query, $params);
            return $this->listDatas();
            
        } else {
            $this->executeSQL($query, $params);
            $this->getLisEnderecos();
            return $this->getDatas();
        }
    }

    

   

    private function getLisEnderecos() {

        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$i] = array(
                'id_e' => $list['id_e'],
                'id_cli' => $list['id_cli'],
                'logradouro' => $list['logradouro'],
                'bairro' => $list['bairro'],
                'numero' => $list['numero'],
                'complemento' => $list['complemento'],
                'cep' => $list['cep'],
                'estado' => $list['estado'],
                'cidade' => $list['cidade'],
            );

            $i ++;
        endwhile;
    }

}

//
