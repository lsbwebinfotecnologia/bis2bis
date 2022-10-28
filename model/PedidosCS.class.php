<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PedidosCS
 *
 * @author licivando
 */
class PedidosCS extends Conexao {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function header($dataLine, $nameFile) {//SE O TIPO DE ARQUIVO FOR 1
        
        if (is_string($dataLine) && substr($dataLine, 0, 1) == 1) {//POR SEGURANCA CONFIRMA O TIPO DE INFORMAÇÃO NA COLUNA 1

            $evento = new EventosCronus();

            $data = substr($dataLine, 1, 19);
            
            $columnsInserts = [
                "nameFile"=> $nameFile,
                "sitFile"=> 'avaliar',
                "dataFileCS" => $data,
                "id_loja"=> Config::ID_LOJA
            ];
            
            if(!$evento->insertTable('a_file_log_cs', $columnsInserts)){
                echo 'Erro ao inserir o nome do arquivo no banco! Nome já existe<br>';
                die;
            }
            
        } else {
            echo '#error não é uma string<br>';
        }
    }


    function finalizando($dataLine) {
        
    }
    
    function pedidoCSExiste($idPedido) {//VERIFICAR SE O PEDIDO JA EXISTE
        $query = "select id_pedido_loja from l_vendas where id_loja = :id_loja and id_pedido_loja = :id_pedido_loja";
        $params = [
            ":id_loja"=> Config::ID_LOJA,
            ":id_pedido_loja"=>$idPedido
        ];
        $this->executeSQL($query, $params);
        
        if($this->totalDatas() > 0){
            return true;
        }else{
            return false;
        }
    }
    
    function fileExist($nameFile) {//VERIFICAR SE O ARQUIVO JÁ FOI LIDO
        $query = "select * from a_file_log_cs where id_loja = :id_loja and nameFile = :nameFile";
        $params = [
            ":id_loja"=> Config::ID_LOJA,
            ":nameFile"=>$nameFile
        ];
        
        $this->executeSQL($query, $params);
        
        if($this->totalDatas() > 0){
            return true;
        }else{
            return false;
        }
    }

}
