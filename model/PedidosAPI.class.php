<?php

//  1	Novo
//  2	Cancelado
//  3 	Em aprovação
//  4	Pendente
//  5	Aprovado
//  6	Liberado
//  7	Remetido

/**
 * Description of PedidosAPI
 *
 * @author licivando
 */
class PedidosAPI extends Conexao{
    //put your code here
    public $metodo, $acao, $form = array(), $retorno;
    
    function __construct() {
        parent::__construct();
    }
    
    function actionPedidosAPI() { 
        $validacao = $this->form;
        if(!$validacao['Method']){
            echo 'Precisa Informar o método desejado!';            
        }elseif($validacao['Method'] == 'ReportView' && !$validacao['ObjectID']){
            echo 'Precisa Informar o ObjetctID!';    
        }else{
            $apiFast = new ApiFastCommerce();
            $this->retorno = json_decode(utf8_encode($apiFast->chamadaApi($this->getLink(), $this->form)));
            
        }
        
    }
        
    function getLink() {
        return "https://www.rumo.com.br/sistema/adm/APILogon.asp";
    }

    function getMetodo() {
        return $this->metodo;
    }

    function getAcao() {
        return $this->acao;
    }

    function getForm() {//O FORMULARIO ADICIONA ATRAVES DO ARRAY OS CAMPOS ADICIONAIS COMO POR EXEMPLO O METHODO ENTRE OUTROS
        return $this->form;
    }
    
    function getPedidosAPI() {
        //DADOS DOS PEDIDOS APROVADOS
//        echo '<pre>';
//        var_dump($this->retorno);
//        die;
        $parentese = array('(', ')', 'Encomenda');
        $retornoApi = $this->retorno;
        $dadosPedido = array();        
        foreach ($retornoApi->data as $pedido){//MANIPULANDO ARRAY PARA MONTARGEM DO PEDIDO  
            
            $dadosPedido[$pedido[0]]['idPedLoja'] = $pedido[0];
            $dadosPedido[$pedido[0]]['nomeCli'] = $pedido[1];
            $dadosPedido[$pedido[0]]['email'] = $pedido[2];
            $dadosPedido[$pedido[0]]['tipoCli'] = $pedido[3];
            $dadosPedido[$pedido[0]]['cpfCnpj'] = $pedido[4];
            $dadosPedido[$pedido[0]]['logradouro'] = $pedido[5];
            $dadosPedido[$pedido[0]]['numero'] = $pedido[6];
            $dadosPedido[$pedido[0]]['complemento'] = $pedido[7];
            $dadosPedido[$pedido[0]]['bairro'] = $pedido[8];
            $dadosPedido[$pedido[0]]['cidade'] = $pedido[9];
            $dadosPedido[$pedido[0]]['uf'] = $pedido[10];
            $dadosPedido[$pedido[0]]['cep'] = $pedido[11];
            $dadosPedido[$pedido[0]]['total'] = $pedido[12];
            $dadosPedido[$pedido[0]]['frete'] = $pedido[13];
            $dadosPedido[$pedido[0]]['pagamento'] = $pedido[14];
            $dadosPedido[$pedido[0]]['status'] = $pedido[15];
            preg_match("/\(.*\)/", $pedido[19], $tipoFrete);
            $dadosPedido[$pedido[0]]['tipoFrete'] = ltrim(str_replace($parentese, '', $tipoFrete[0]));
            $dadosPedido[$pedido[0]]['vlrCupom'] = $pedido[21];
            $dadosPedido[$pedido[0]]['itens'][$pedido[20]]['prodRef'] = $pedido[16];
            $dadosPedido[$pedido[0]]['itens'][$pedido[20]]['qtd'] = $pedido[17];
            $dadosPedido[$pedido[0]]['itens'][$pedido[20]]['precoUnit'] = $pedido[18];

        }
        
        return $dadosPedido;
    }
    
    function getXml($dadosRecord = array()) {//GERAR O ARQUIVO XML PARA ENVIO DOS PEDIDOS
        $xml = new DOMDocument('1.0', 'ISO-8859-1');
        $xml->formatOutput = true;
        $records = $xml->createElement('Records');       
        
        foreach ($dadosRecord as $dado) {//CRIANDO O XML COM OS PRODUTOS A SEREM INSERIDOS VIA API FAST   
            $record = $xml->createElement("Record");   
            foreach ($dado as $key => $value) {
                 $field = $xml->createElement('Field');
                 $field->setAttribute("Name", $key);
                 $field->setAttribute("Value", $value);
                 $record->appendChild($field);   
            }                     
            $records->appendChild($record);    
        }
        $xml->appendChild($records);
        return $xml->saveXML();
    }

    function setAcao($acao) {
        $this->acao = $acao;
    }

    function setForm($addForm = array()) {
        $configuracao = new Configuracoes();
        $dadosForm = $configuracao->getdadosLojaApi();    
        
        if($addForm){
            foreach ($addForm as $key => $value){
                $dadosForm[$key] = $value;
            }
        }
        $this->form = $dadosForm;
        return $this->form;
    }
    
    function getRetorno() {
        return $this->retorno;
    }

    function setRetorno($retorno) {
        $this->retorno = $retorno;
    }
    
}
