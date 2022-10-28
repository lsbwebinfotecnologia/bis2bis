<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClientesDadosEnderecosAdmin
 *
 * @author licivando
 */
class ClientesDadosEnderecosAdmin extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getEnderecosCliente($idCliente = false, $idEndereco = false, $principal = false) {
        $query = "
            SELECT 
                *,
                (select id_cliente_erp from c_clientes c where c.id_cli = cc.id_cli and c.id_loja = :id_loja) as id_cliente_erp,
                (select uf from c_estados ce where ce.id = cc.estado ) as nomeUF,
                (select nome from c_estados ce where ce.id = cc.estado) as descricaoUF,
                (select nome from c_cidades cci where cci.id = cc.cidade limit 1) as nomeCidade
            FROM c_enderecos cc WHERE  id_loja = :id_loja 
        ";
        $params = [
            ":id_loja" => Config::ID_LOJA,
            ":id_cli" => $idCliente
        ];

        if ($idCliente) {
            $query .= " and id_cli = :id_cli ";
            $params[":id_cli"] = $idCliente;
        }

        if ($principal) {
            $query .= " and principal = :principal ";
            $params[":principal"] = '1';
        }

        if ($idEndereco) {
            $query .= " and id_e = :id_e ";
            $params[":id_e"] = $idEndereco;
        }
      
        $query .= " order by principal desc ";
        
        $this->executeSQL($query, $params);

        if ($principal) {
            return $this->listDatas();
        } else {
            $this->getListaDeEnderecos();
        }
    }

    public function getDadosCliente($idCliente) {
        $query = "select * from c_clientes where id_cli = :id_cli and id_loja = :id_loja ";
        $params = [
            ":id_loja" => Config::ID_LOJA,
            ":id_cli" => $idCliente
        ];
        $this->executeSQL($query, $params);
        return $this->listDatas();
    }

    function getUF($idUF) {
        $query = "select uf from c_estados where id = :id";
        $params = [
            ":id" => $idUF
        ];

        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {
            return $this->listDatas()['uf'];
        } else {
            return false;
        }
    }

    function getMunicipio($idMunicipio, $idUF) {
        $query = "select nome from c_cidades where estado = :estado and id = :id ";
        $params = [
            ":estado" => $idUF,
            ":id" => $idMunicipio
        ];

        $this->executeSQL($query, $params);

        if ($this->totalDatas() > 0) {
            return $this->listDatas()['nome'];
        } else {
            return false;
        }
    }

    private function getListaDeEnderecos() {
        $i = 1;

        while ($list = $this->listDatas()) :

            $this->datas[$i] = array(
                'id_e' => $list['id_e'],
                'id_cli' => $list['id_cli'],
                'nome_end' => $list['nome_end'],
                'tipo' => $list['tipo'],
                'id_cliente_erp' => $list['id_cliente_erp'],
                'logradouro' => $list['logradouro'],
                'bairro' => $list['bairro'],
                'numero' => empty($list['numero']) || Sistema::somenteNumeros($list['numero']) == '' ? 0 : Sistema::somenteNumeros($list['numero']),
                'complemento' => $list['numero'] . ' ' . $list['complemento'],
                'nomeCidade' => $list['nomeCidade'],
                'nomeUF' => $list['nomeUF'],
                'descricaoUF' => $list['descricaoUF'],
                'nomeCidade' => $list['nomeCidade'],
                'cep' => $list['cep'],
                'cidade_estado' => $list['nomeCidade'] . ' - ' . $list['nomeUF'],
                'principal' => $list['principal'],
                'ativo' => $list['ativo']
            );

            $i ++;
        endwhile;
    }

}
