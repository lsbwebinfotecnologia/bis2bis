<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//echo '<pre>';
$sendAPI = new ProdutoManager();

$addForm = array(//ADICIONANDO O METHODO E O XML COM OS DADOS
    "Method" => "ReportView",
    "ObjectID" => "425"
);




$sendAPI->getForm($addForm);
$sendAPI->actionProdutcsAPI();
$retornoApi = $sendAPI->retorno;

var_dump($retornoApi);

