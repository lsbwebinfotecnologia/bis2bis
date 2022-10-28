<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventosCronus
 *
 * @author horusweb
 */
class EventosCronus extends Conexao {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function updateTable($table, $dataSet = array(), $dataWhere = array()) {
        $query = "UPDATE {$table} SET ";
        $params = [];
        $rowsS = count($dataSet); //QUANTIDADE DE SETS 
        $c = 1;

        if ($dataSet) {
            foreach ($dataSet as $keyS => $set) {
                if ($c == $rowsS) {
                    $query .= " {$keyS} = :{$keyS} ";
                } else {
                    $query .= " {$keyS} = :{$keyS}, ";
                }
                $params[":{$keyS}"] = $set;
                $c ++;
            }
        }

        function deleteTable($table, $dataWhere = array()) {

            $query = "DELETE FROM {$table} ";

            $c2 = 1; //CLAUSUAL WHERE
            $query .= " WHERE ";
            foreach ($dataWhere as $keyW => $where) {
                if ($c2 == 1) {
                    $query .= " {$keyW} = :{$keyW} ";
                } else {
                    $query .= " AND {$keyW} = :{$keyW} ";
                }
                $params[":{$keyW}"] = $where;
                $c2 ++;
            }

            $this->executeSQL($query, $params);
        }

        if ($dataWhere) {
            //$rowsW = count($dataWhere);
            $c2 = 1; //CLAUSUAL WHERE
            $query .= " WHERE ";
            foreach ($dataWhere as $keyW => $where) {
                if ($c2 == 1) {
                    $query .= " {$keyW} = :{$keyW} ";
                } else {
                    $query .= " AND {$keyW} = :{$keyW} ";
                }
                $params[":{$keyW}"] = $where;
                $c2 ++;
            }

            $this->executeSQL($query, $params);
        }
    }

    function insertTable($table, $columnsInserts = array()) {
        $query = "INSERT INTO {$table} ";
        if ($columnsInserts) {
            $qtdColumns = count($columnsInserts);
            $columns = "(";
            $values = "(";
            $params = [];
            $c = 1;
            //FOREACH DAS COLUNAS
            foreach ($columnsInserts as $key => $value) {
                if ($c == $qtdColumns) {
                    $columns .= "{$key}) ";
                    $values .= ":{$key}) ";
                } else {
                    $columns .= "{$key}, ";
                    $values .= ":{$key},  ";
                }
                $params[":{$key}"] = $value;

                $c ++;
            }
            $query .= $columns . " VALUES " . $values;

            if ($this->executeSQL($query, $params)) {
                return true;
            } else {
                return false;
            }
        } else {
            var_dump("informe a array com as colunas e valores a serem inseridas");
        }
    }

    function selectTable($table, $where = array()) {
        
    }

}
