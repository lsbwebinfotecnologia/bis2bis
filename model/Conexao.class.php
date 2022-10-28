<?php

class Conexao extends Config
{

    protected $dbhost, $dbname, $dbuser, $dbpass;
    protected $condb, $paginacao_links, $totalPaginas, $limite, $inicio;
    protected $obj, $datas = array();

    function __construct()
    {
        $this->dbhost = self::BD_HOST;
        $this->dbuser = self::BD_USER;
        $this->dbpass = base64_encode(self::BD_PASS);
        $this->dbname = self::BD_NAME;


        try {
            if ($this->conectar() == null) {
                $this->conectar();
            }
        } catch (Exception $e) {
            exit($e->getMessage() . '<h2>Erro ao conectar com o banco de dados</h2>');
        }
    }

    function updateTable($table, $dataSet = array(), $dataWhere = array())
    {
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
                $c++;
            }
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
                $c2++;
            }

            $this->executeSQL($query, $params);
        }
    }

    function gerarQueryInsertSQL($table = "", $columnsInserts = [])
    {
        $query = "INSERT INTO {$table} ";
        if (!empty($columnsInserts)) {
            $qtdColumns = count($columnsInserts);
            $columns = "(";
            $values = "(";
            $params = [];
            $c = 1;
            //FOREACH DAS COLUNAS
            foreach ($columnsInserts as $key => $value) {
                $value = $value ?? $key;
                $nameKey = md5(uniqid(date($value)));
                if ($c == $qtdColumns) {
                    $columns .= "{$key}) ";
                    $values .= ":{$nameKey}) ";
                } else {
                    $columns .= "{$key}, ";
                    $values .= ":{$nameKey},  ";
                }
                $params[":{$nameKey}"] = $value;

                $c++;
            }
            $query .= $columns . " VALUES " . $values . ";";
        }
        $retorno = [
            "query" => $query,
            "params" => $params
        ];

        return $retorno;
    }

    function gerarQueryUpdateSQL($table = "", $dataSet = [], $dataWhere = [])
    {

        $params = [];
        $query = "";
        $caracter = ["'", "/", "-", ".", ";", "%"];
        if (!empty($dataSet) && !empty($table)) {

            $query .= "update {$table} set ";

            $qtdDataSet = count($dataSet);
            $qtdDataWhere = count($dataWhere);
            $c = 1;
            foreach ($dataSet as $d => $dado) {

                $nameKey = md5(uniqid(date($dado)));

                $query .= " {$d} = :{$nameKey}";
                if ($c == $qtdDataSet && $qtdDataWhere <= 0) {
                    $query .= ";";
                } elseif ($c < $qtdDataSet) {
                    $query .= ",";
                }
                $c++;
                $params[":{$nameKey}"] = $dado;
            }

            if (!empty($dataWhere)) {
                $query .= " where ";
                $cw = 1;
                foreach ($dataWhere as $w => $where) {

                    $nameKey = md5(uniqid(date($where)));
                    if ($cw == 1 && $cw == $qtdDataWhere) {
                        $query .= " {$w} = :{$nameKey};";
                    } elseif ($cw == 1) {
                        $query .= " {$w} = :{$nameKey}";
                    } elseif ($cw == $qtdDataWhere) {
                        $query .= " and {$w} = :{$nameKey};";
                    } else {
                        $query .= " and {$w} = :{$nameKey} ";
                    }
                    $cw++;
                    $params[":{$nameKey}"] = $where;
                }
            }
        }

        $retorno = [
            "query" => $query,
            "params" => $params
        ];

        return $retorno;
    }

    function insertTable($table, $columnsInserts = array())
    {
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

                $c++;
            }
            $query .= $columns . " VALUES " . $values;

            if ($this->executeSQL($query, $params)) {
                return $this->lastInsertID();
            } else {
                return false;
            }
        } else {
            var_dump("informe a array com as colunas e valores a serem inseridas");
        }
    }

    function deleteTable($table, $dataWhere = array())
    {

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
            $c2++;
        }

        $this->executeSQL($query, $params);
    }

    function conectar()
    {

        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        );
        $link = new PDO("mysql:host={$this->dbhost};dbname={$this->dbname}", $this->dbuser, $this->dbpass, $options);

        $this->condb = $link;

        return $link;
    }

    function executeSQL($query, array $params = NULL)
    {
//echo '<pre>';
        $this->obj = $this->conectar()->prepare($query);
//        print_r($query);
//        print_r($params);
//echo '</pre>';
        if (isset($params)) {
            if (count($params) > 0) {
                foreach ($params as $key => $value) {
                    $this->obj->bindValue($key, $value);
                }
            }
        }

        return $this->obj->execute();
    }

    function lastInsertID()
    {
        return $this->condb->lastInsertId();
    }

    function listDatas()
    {
        return $this->obj->fetch(PDO::FETCH_ASSOC);
    }

    function totalDatas()
    {
        return $this->obj->rowCount();
    }

    function getDatas()
    {
        return $this->datas;
    }

    function paginacaoLinks($campo, $tabela, $array = array())
    {

        $pagina = new Paginacao();
        if ($array) {
            $pagina->getPaginacao($campo, $tabela, $array);
        } else {
            $pagina->getPaginacao($campo, $tabela);
        }

        $this->paginacao_links = $pagina->link;

        $this->totalPaginas = $pagina->totalPaginas;
        $this->limite = $pagina->limite;
        $this->inicio = $pagina->inicio;

        if ($this->totalPaginas > 0) {
            return " limit {$this->inicio}, {$this->limite}";
        } else {
            return "";
        }
    }

    protected
    function paginacao($paginas = array())
    {
        if (isset($paginas)) {

            $concatenar = '?';
            $atualPagina = 1;
            $active = "active";
            unset($_GET['pagina']);

            //var_dump($paginas);
            if (isset($_GET['p'])) {
                $atualPagina = $_GET['p'];
            }
            if (isset($_GET)) {
                unset($_GET['p']);
                $concatenar .= http_build_query($_GET);
            }

            $pagina = '<ul>';

            if (isset($atualPagina) && $atualPagina > 1) {
                $pagina .= "<li class=''><a href='{$concatenar}&p=" . ($atualPagina - 1) . "'>Anterior</a></li>";
            } else {
                $pagina .= "<li class='disabled'><a href='#'>Anterior</a></li>";
                $pagina .= "<li class='{$active}'> <a href='{$concatenar}&p=1'>1</a> </li>";
            }

            foreach ($paginas as $p) {
                $pag = $p + 1;
                $active = "";
                if (isset($atualPagina) && $atualPagina == $pag) {
                    $active = "active";
                }

                $pagina .= "<li class='{$active}'><a href='{$concatenar}&p={$pag}'>{$pag}</a></li>";
            }

            if ($pag >= $atualPagina) {
                $pagina .= "<li class=''><a href='{$concatenar}&p=" . ($atualPagina + 1) . "'>Próxima</a></li>";
            }

            $pagina .= '</ul>';


            if ($this->totalPaginas > 1) {
                return $pagina;
            }
        }
    }

    function showPaginacao()
    {
        return $this->paginacao($this->paginacao_links);
    }

}
