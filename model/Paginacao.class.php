<?php

class Paginacao extends Conexao{
    
    public $limite, $inicio, $totalPaginas, $link = array();
            
    function getPaginacao($campo, $tabela, $parametros=array()){
        
        $query = "SELECT {$campo} FROM {$tabela}";
        $params = array(
            ':id_loja' => Config::ID_LOJA
        );
        
        if($parametros){
            foreach ($parametros as $key => $value) {
                $params[$key] = $value;
            }
        }
        
        $this->executeSQL($query, $params);
        $total = $this->totalDatas();
        
        $this->limite = Config::BD_LIMIT_POR_PAG;
        $paginas = ceil($total / $this->limite); //CEIL ARREDONDA PARA CIMA O VALOR DA DIVISÃO
        $this->totalPaginas = $paginas;
        
        $pag = (int) isset($_GET['p']) ? $_GET['p'] : 1;
        if($pag > $paginas){
            $pag = $paginas;
        }
        
        $this->inicio = ($pag * $this->limite) - $this->limite;
        
        $tolerancia = 4;
        $mostrar = $pag + $tolerancia;
        if($mostrar > $paginas){
            $mostrar = $paginas;
        }
        
        for ($i = ($pag - $tolerancia); $i <= $mostrar; $i++):
            if($i < 1){
                $i = 1;
            }
            array_push($this->link, $i);
        endfor;
        
        
        
    }
}
