<?php

class DadosAdmin extends Conexao {

    function __construct() {
        parent::__construct();
    }

    function getConfigAdmin($type) {
        $query = "SELECT value FROM a_lojas_dados WHERE id_loja = :id_loja AND name = :name";
        $params = array(
            ":id_loja" => Config::ID_LOJA,
            ":name" => $type
        );

        $this->executeSQL($query, $params);
        $dataReturn = $this->listDatas();
        return $dataReturn['value'];
    }
    
    function getDadosDePara($type, $value) {
        $query = "SELECT para FROM a_conf_de_para WHERE id_loja = :id_loja and tipo_configuracao = :type and de = :valor limit 1";
        $params = array(
            ":id_loja" => Config::ID_LOJA,
            ":valor"=>$value,
            ":type"=>$type
        );        
        $this->executeSQL($query, $params);
        
        if($this->totalDatas() > 0){
            return $this->listDatas()['para'];
        }else{
            return false;
        }
        
    }
    
    
    function getDadosDeParaGerais($filter = []) {
        $query = "SELECT * FROM a_conf_de_para WHERE id_loja = :id_loja ";
        $params = array(
            ":id_loja" => Config::ID_LOJA,
        );

        $this->executeSQL($query, $params);
        $data = [];
        
        
        
        while ($list = $this->listDatas()) :
            $data[$list['tipo_configuracao']][$list['de']] = $list['para'];
        endwhile;
        return $data;
    }
    

    function getDadosAdmin($filter = []) {
        $query = "SELECT * FROM a_lojas_dados WHERE id_loja = :id_loja ";
        $params = array(
            ":id_loja" => Config::ID_LOJA,
        );

        $this->executeSQL($query, $params);
        $data = [];
        while ($list = $this->listDatas()) :
            $data[$list['name']] = $list['value'];
        endwhile;
        return $data;
    }

    function getDadosCielo() {
        $query = "SELECT MerchantId, MerchantKey FROM a_lojas_cielo WHERE id_loja = :id_loja";
        $params = array(
            ":id_loja" => Config::ID_LOJA
        );
        $this->executeSQL($query, $params);

        return $this->listDatas();
    }

    function getDadosRede() {
        $query = "SELECT `AffiliationPV` as pv, `Token` as token FROM a_lojas_rede WHERE id_loja = :id_loja";
        $params = array(
            ":id_loja" => Config::ID_LOJA
        );
        $this->executeSQL($query, $params);

        return $this->listDatas();
    }
    
    function getDadosPagarMe() {
        $query = "SELECT `keyPagarme`, `keyCriptoPagarme` FROM a_lojas_pagarme WHERE id_loja = :id_loja";
        $params = array(
            ":id_loja" => Config::ID_LOJA
        );        
        $this->executeSQL($query, $params);
        
        return $this->listDatas();
        
    }

    function getMenusURL($filter = []) {
        $query = "SELECT * FROM a_pages_front WHERE id_loja = :id_loja";
        $params = array(
            ":id_loja" => Config::ID_LOJA
        );
        $this->executeSQL($query, $params);
        $data = [];
        if ($this->totalDatas() > 0) {
            $i = 1;
            while ($list = $this->listDatas()) :
                $data[$i] = array(
                    'nome' => $list['nome'],
                    'url' => $list['url'],
                    'icon' => $list['icon'],
                    'blank' => $list['blank']
                );

                $i ++;
            endwhile;
        }
        return  $data;
    }

    function getSubMenus() {

        $query = "SELECT tipoinfomenu, value FROM a_pages_front WHERE id_loja = :id_loja";
        $params = array(
            ":id_loja" => Config::ID_LOJA
        );
        $this->executeSQL($query, $params);
        $this->listSubMenus();

        if ($this->totalDatas() > 0) {
            $subMenus = $this->getDatas();
//            var_dump($subMenus);
//            die;
            $arrayReturn = array();

            foreach ($subMenus as $subMenu) {
                $k = substr($subMenu['tipoinfomenu'], -1);
                if (preg_match('/namemenuTopo/', $subMenu['tipoinfomenu'])) {
                    $arrayReturn[$k]['menu'] = $subMenu['value'];
                } elseif (preg_match('/linkmenuTopo/', $subMenu['tipoinfomenu'])) {
                    $arrayReturn[$k]['link'] = $subMenu['value'];
                }
            }
        } else {

            $arrayReturn = [
                "1" => [
                    "menu" => "Home",
                    "link" => Rotas::get_SiteHome()
                ],
                "2" => [
                    "menu" => "Sobre nós",
                    "link" => Rotas::get_SiteHome() . '/sobre'
                ],
                "3" => [
                    "menu" => "Contato",
                    "link" => Rotas::get_SiteHome() . '/contato'
                ],
                "4" => [
                    "menu" => "Doação",
                    "link" => Rotas::get_SiteHome() . '/doacao'
                ]
            ];
        }

        return $arrayReturn;
    }

    private function listSubMenus() {//ESTRUTURA DO BANCO DE DADOS DA TABELA P_CATEGORIAS
        $i = 1;
        while ($list = $this->listDatas()) :
            $this->datas[$i] = array(
                'tipoinfomenu' => $list['tipoinfomenu'],
                'value' => $list['value']
            );

            $i ++;
        endwhile;
    }

}
